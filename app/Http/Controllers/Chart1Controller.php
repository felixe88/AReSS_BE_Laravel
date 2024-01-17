<?php

// app/Http/Controllers/IlTuoController.php

namespace App\Http\Controllers;

use App\Http\Chart\Formule1;
use App\Http\Controllers\PatologieController;


class Chart1Controller extends Controller
{
    public function index()
    {

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function chart1Results()
    {

        $patologieController = new PatologieController();
        $resultFromQuery = $patologieController->query(request());
        $data2 = $resultFromQuery['query'];
        $data = $data2->query;
        $k = 1000;
        // $riferimenti = ['riferimento1', 'riferimento2'];

        $aslData = array_filter($data, function ($row) {
            return isset($row['Asl']) && !empty($row['Asl']);
        });

        

      
        $tassiStandard = Formule1::tassoStandard($riferimenti, $data, $k);
        $intervalloTs = Formule1::intervalloTs($aslData, $data);
        $tassoGrezzo = Formule1::tassoGrezzo($riferimenti, $data, $k);
        $intervalloTg = Formule1::intervalloTg($aslData, $data);
        $sirRegionale = Formule1::sirRegionale($riferimenti, $data);
        $intervalloSir = Formule1::intervalloSir($aslData, $data);

                $risultatoSalvato = Formule1::getRisultato();

        return view('ricevi_filtri', compact('risultatoSalvato'));
       // return $risultatoSalvato;
    }
}
