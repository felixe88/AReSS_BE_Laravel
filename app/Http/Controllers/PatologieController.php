<?php

namespace App\Http\Controllers;

use App\Models\patologie;
use Illuminate\Http\Request;
use App\Model\tumori_colon_retto_casi;
use App\Models\comuni;
use App\Models\distretti;
use App\Models\asl;
use App\Models\classi;
use App\Models\comune_popolazione_tumori_test;
use App\Models\regioni;

class PatologieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patologie = patologie::all();

        return response()->json(['patologie' => $patologie]);
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
        $queryResult = patologie::select([
                'patologie.patologia',
                'tumori_colon_retto_casi.casi',
                'comune_popolazione_tumori_test.anno',
                'comune_popolazione_tumori_test.sesso',
                'comune_popolazione_tumori_test.popolazione', 
                'comuni.Descrizione',
                // 'distretti.Descrizione',
                // 'asl.Descrizione',
                'classi.classe_eta',
                'classi.peso_eu',
            ])
            ->leftJoin('tumori_colon_retto_casi', 'patologie.IDPatologia', '=', 'tumori_colon_retto_casi.IDPatologia')
            ->leftJoin('comune_popolazione_tumori_test', 'tumori_colon_retto_casi.IDComunePop', '=', 'comune_popolazione_tumori_test.ID')
            ->leftJoin('comuni', 'comune_popolazione_tumori_test.IDComune', '=', 'comuni.IDComune')
            ->leftJoin('distretti', 'comuni.IDDistretto', '=', 'distretti.IDDistretto')
            ->leftJoin('asl', 'distretti.IDAsl', '=', 'asl.IDAsl')
            ->leftJoin('classi', 'comune_popolazione_tumori_test.IDClasse', '=', 'classi.IDClasse')
            // ->where('comune_popolazione_tumori_test.anno', '=', 2020)
            ->where('comune_popolazione_tumori_test.IDComune', '=', 71001)
            ->get();
    
            info($queryResult);
        return response()->json(['query' => $queryResult]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Errore nella query'], 500);
        }
    }
}
