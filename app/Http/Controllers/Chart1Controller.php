<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PatologieController;
use Illuminate\Http\Request;
use App\Http\Controllers\Functions;

class Chart1Controller extends Controller
{
    // public function chart1Results()
    // {
    //     $patologieController = new PatologieController();
    //     $resultFromQuery = $patologieController->query(request());
    //     $data2 = $resultFromQuery->getData(); // Estrai i dati dalla JsonResponse
    //     dd($data2);

    //     $data = $data2->query;
    //     $k = 1000;
    //     // $riferimenti = ['riferimento1', 'riferimento2'];
    //     $riferimenti = ['Bari','Accadia'];
    //     $aslData = array_filter($data, function ($row) {
    //         return isset($row['Asl']) && !empty($row['Asl']);
    //     });
    //     // $tassiStandard = Functions::tassoStandard($riferimenti, $data, $k);
    //     // $intervalloTs = Functions::intervalloTs($aslData, $data);
    //     $tassoGrezzo = Functions::tassoGrezzo($riferimenti, $data, $k);
    //     $intervalloTg = Functions::intervalloTg($aslData, $data);
    //     $sirRegionale = Functions::sirRegionale($riferimenti, $data);
    //     $intervalloSir = Functions::intervalloSir($aslData, $data);

    //             $risultatoSalvato = Functions::getRisultato();
    //             dd($tassoGrezzo, $intervalloTg, $sirRegionale, $intervalloSir);

    //     return view('ricevi_filtri', compact('risultatoSalvato'));
    // //    return $risultatoSalvato;
    // }
    public function chart1Results()
{
    // Utilizza l'iniezione delle dipendenze per ottenere l'istanza di PatologieController
    $patologieController = app(PatologieController::class);

    $resultFromQuery = $patologieController->query(request());
    $data2 = $resultFromQuery->getData(); // Estrai i dati dalla JsonResponse
    // dd($data2);

    $data = $data2->query;
    $k = 1000;
    $riferimenti = ['Bari', 'Accadia'];
    $aslData = array_filter($data, function ($row) {
        return isset($row['Asl']) && !empty($row['Asl']);
    });
    dd(request()->all());

    // $tassiStandard = Functions::tassoStandard($riferimenti, $data, $k);
    // $intervalloTs = Functions::intervalloTs($aslData, $data);
    $tassoGrezzo = Functions::tassoGrezzo($riferimenti, $data, $k);
    $intervalloTg = Functions::intervalloTg($aslData, $data);
    $sirRegionale = Functions::sirRegionale($riferimenti, $data);
    $intervalloSir = Functions::intervalloSir($aslData, $data);

    $risultatoSalvato = Functions::getRisultato();
    dd($tassoGrezzo, $intervalloTg, $sirRegionale, $intervalloSir);

    return view('ricevi_filtri', compact('risultatoSalvato'));
}
}
