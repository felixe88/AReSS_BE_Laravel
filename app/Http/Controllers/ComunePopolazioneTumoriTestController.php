<?php

namespace App\Http\Controllers;

use App\Models\comune_popolazione_tumori_test;
use Illuminate\Http\Request;
use App\Models\comuni;
use App\Models\distretti;
use App\Models\asl;
use App\Models\classi;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;



class ComunePopolazioneTumoriTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tumori = comune_popolazione_tumori_test::all();

        return response()->json(['comune_popolazione_tumori_test' => $tumori]);
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
    public function query()
{
    try {
    $queryResult = comune_popolazione_tumori_test::select([
            'comune_popolazione_tumori_test.anno',
            'comune_popolazione_tumori_test.sesso',
            'comune_popolazione_tumori_test.popolazione', 
            'comuni.Descrizione',
            'distretti.Descrizione',
            'asl.Descrizione',
            'classi.classe_eta',
            'classi.peso_eu',
        ])
        ->leftJoin('comuni', 'comune_popolazione_tumori_test.IDComune', '=', 'comuni.IDComune')
        ->leftJoin('distretti', 'comuni.IDDistretto', '=', 'distretti.IDDistretto')
        ->leftJoin('asl', 'distretti.IDAsl', '=', 'asl.IDAsl')
        ->leftJoin('classi', 'comune_popolazione_tumori_test.IDClasse', '=', 'classi.IDClasse')
        ->where('comune_popolazione_tumori_test.anno', '=', 2020)
        ->get();
        info($queryResult);
    return response()->json(['query' => $queryResult]);
} catch (\Exception $e) {
    return response()->json(['error' => 'Errore nella query'], 500);
    }
}
}