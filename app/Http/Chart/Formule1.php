<?php

namespace App\Helpers;

//composer require php-ai/php-ml   *****per installarlo********
use Phpml\Math\Statistic\Distribution\ChiSquare;
//****************** */
// use MathPHP\Probability\Distribution\ChiSquare;
class Calcolatore
{
    private static $risultato;

    public static function estraiTotale($colonna, $riferimenti, $data)
    {
        $container = [];

        foreach ($riferimenti as $el) {
            $somma = 0;
            $dataset = array_filter($data, function ($d) use ($el) {
                return $d['riferimento'] === $el;
            });

            foreach ($dataset as $row) {
                $somma += $row[$colonna];
            }

            $container[$el] = $somma;
        }

        self::$risultato = $container;

        return $container;
    }

    public static function calcoloWi($riferimenti, $data)
    {
        $container = self::estraiTotale("peso_eu", $riferimenti, $data);
        $dataset = [];

        foreach ($riferimenti as $riferimento) {
            $obj = [];
            $dataset = array_filter($data, function ($d) use ($riferimento) {
                return $d['riferimento'] === $riferimento;
            });

            foreach ($dataset as $riga) {
                $obj[$riga['classe_eta']] = $riga['peso_eu'] / self::$risultato[$riferimento];
            }

            $container[$riferimento] = $obj;
        }

        return $container;
    }

    public static function tassoStandard($riferimenti, $data, $k = 100000)
    {
        $wi = self::calcoloWi($riferimenti, $data);
        $ti = 0;
        $tassi = [];

        foreach ($riferimenti as $el) {
            $sommatoria = [
                'numeratore' => 0,
                'denominatore' => 0,
            ];

            $dataset = array_filter($data, function ($d) use ($el) {
                return $d['riferimento'] === $el;
            });

            foreach ($dataset as $riga) {
                $righeClasse = array_filter($dataset, function ($r) use ($riga) {
                    return $r['classe_eta'] === $riga['classe_eta'];
                });

                $casiTot = array_reduce($righeClasse, function ($sum, $e) {
                    return $sum + $e['casi'];
                }, 0);

                $popTot = array_reduce($righeClasse, function ($sum, $e) {
                    return $sum + $e['popolazione'];
                }, 0);

                $ti = $popTot !== 0 ? $casiTot / $popTot : 0;

                $sommatoria['numeratore'] += $wi[$el][$riga['classe_eta']] * $ti;
                $sommatoria['denominatore'] += $wi[$el][$riga['classe_eta']];
            }

            $tassi[$el] = $sommatoria['numeratore'] / $sommatoria['denominatore'];

            if ($k !== 100000) {
                $tassi[$el] = $tassi[$el] * $k;
            } else {
                $tassi[$el] = round($tassi[$el] * $k, 2);
            }
        }

        return $tassi;
    }

    public static function calcoloEsLogTs($data, $riferimenti)
    {
        $wi = self::calcoloWi($riferimenti, $data);
        $tassi = self::tassoStandard($riferimenti, $data, 1);
        $es = [];

        foreach ($riferimenti as $el) {
            $dataset = array_filter($data, function ($d) use ($el) {
                return $d['riferimento'] === $el;
            });

            $sommatoria = 0;

            foreach ($dataset as $riga) {
                $valore = $riga['casi'] / pow($riga['popolazione'], 2);
                $sommatoria += pow($wi[$el][$riga['classe_eta']], 2) * $valore;
            }

            $sommatoria = sqrt($sommatoria);

            if ($sommatoria === 0 || $tassi[$el] === 0) {
                $es[$el] = 0;
            } else {
                $es[$el] = $sommatoria / $tassi[$el];
            }
        }

        return $es;
    }

    public static function intervalloTs($riferimenti, $data)
    {
        $tassi = self::tassoStandard($riferimenti, $data, 1);
        $esLog = self::calcoloEsLogTs($data, $riferimenti);
        $container = [];
        $valore = 0;

        foreach ($riferimenti as $el) {
            $obj = [
                'tasso' => 0,
                'lcl' => 0,
                'ucl' => 0,
            ];

            $valore = 1.96 * $esLog[$el];
            $obj['lcl'] = +(exp(log($tassi[$el]) - $valore) * 100000);
            $obj['ucl'] = +(exp(log($tassi[$el]) + $valore) * 100000);
            $obj['tasso'] = +(round($tassi[$el] * 100000, 2));

            $container[$el] = $obj;
        }

        return $container;
    }

    public static function tassoGrezzo($riferimenti, $data, $k = 100000)
    {
        $casi = self::estraiTotale("casi", $riferimenti, $data);
        $popolazione = self::estraiTotale("popolazione", $riferimenti, $data);
        $tasso = [];

        foreach ($riferimenti as $el) {
            if ($casi[$el] === 0) {
                $tasso[$el] = 0;
            } else {
                $tasso[$el] = $casi[$el] / $popolazione[$el];

                if ($k !== 100000) {
                    $tasso[$el] = $tasso[$el] * $k;
                } else {
                    $tasso[$el] = round($tasso[$el] * $k, 2);
                }
            }
        }

        return $tasso;
    }

    public static function intervalloTg($riferimenti, $data)
    {
        $tassi = self::tassoGrezzo($riferimenti, $data, 1);
        $popolazione = self::estraiTotale("popolazione", $riferimenti, $data);
        $sqrt = 0;
        $container = [];

        foreach ($riferimenti as $el) {
            $obj = [
                'tasso' => 0,
                'lcl' => 0,
                'ucl' => 0,
            ];

            if ($tassi[$el] === 0 || $popolazione[$el] === 0) {
                $sqrt = 0;
            } else {
                $sqrt = sqrt($tassi[$el] / $popolazione[$el]);
            }

            $obj['lcl'] = +(max(0, $tassi[$el] - 1.96 * $sqrt) * 100000);
            $obj['ucl'] = +(min(1, $tassi[$el] + 1.96 * $sqrt) * 100000);
            $obj['tasso'] = +(round($tassi[$el] * 100000, 2));

            $container[$el] = $obj;
        }

        return $container;
    }

    public static function sirRegionale($riferimenti, $data)
    {
        $casiTotale = self::estraiTotale("casi", $riferimenti, $data);
        $classiEta = array_values(array_unique(array_column($data, 'classe_eta')));
        $container = [];

        foreach ($riferimenti as $riferimento) {
            $sommaAttesi = 0;

            foreach ($classiEta as $classe) {
                $tasso = 0;

                $datasetPuglia = array_filter($data, function ($d) use ($classe) {
                    return $d['riferimento'] === 'Puglia' && $d['classe_eta'] === $classe;
                });

                $casiPuglia = array_reduce($datasetPuglia, function ($sum, $e) {
                    return $sum + $e['casi'];
                }, 0);

                $popPuglia = array_reduce($datasetPuglia, function ($sum, $e) {
                    return $sum + $e['popolazione'];
                }, 0);

                if ($casiPuglia !== 0 && $popPuglia !== 0) {
                    $tasso += $casiPuglia / $popPuglia;
                }

                $dataset = array_filter($data, function ($d) use ($riferimento, $classe) {
                    return $d['riferimento'] === $riferimento && $d['classe_eta'] === $classe;
                });

                $popRif = array_reduce($dataset, function ($sum, $e) {
                    return $sum + $e['popolazione'];
                }, 0);

                $attesi = $tasso * $popRif;
                $sommaAttesi += $attesi;
            }

            $sir = ($sommaAttesi === 0 || $casiTotale[$riferimento] === 0)
                ? 0
                : round(($casiTotale[$riferimento] / $sommaAttesi), 2);

            $container[$riferimento] = [
                'sir' => $sir,
                'sommaAttesi' => $sommaAttesi,
            ];
        }

        return $container;
    }

    public static function intervalloSir($riferimenti, $data)
    {
        $casiTotale = self::estraiTotale("casi", $riferimenti, $data);
        $sir = self::sirRegionale($riferimenti, $data);
        $container = [];

        foreach ($riferimenti as $riferimento) {
            $denominatore = $sir[$riferimento]["sommaAttesi"] * 2;

            $chiSquare = new ChiSquare();
            $chiSquare->setDegreesOfFreedom($denominatore);

            $lclNum = $chiSquare->inverseCDF(0.025);
            $uclNum = $chiSquare->inverseCDF(0.975);

            $lcl = ($denominatore === 0 || $lclNum === 0) ? 0 : round($lclNum, 2);
            $ucl = ($denominatore === 0 || $uclNum === 0) ? 0 : round($uclNum, 2);

            $container[$riferimento] = [
                'tasso' => $sir[$riferimento]["sir"],
                'lcl' => $lcl,
                'ucl' => $ucl,
            ];
        }

        return $container;
    }

    public static function getRisultato()
    {
        return self::$risultato;
    }
}