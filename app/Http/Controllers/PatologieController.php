<?php

namespace App\Http\Controllers;

use App\Models\patologie;
use Illuminate\Http\Request;
use App\Model\tumori_casi;
use App\Models\comuni;
use App\Models\distretti;
use App\Models\asl;
use App\Models\classi;
use App\Models\comune_popolazione_tumori_test;
use App\Models\regioni;
use App\Models\filtri;
use Illuminate\Support\Facades\Cache;


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
    // public function getFilters(Request $request)
    // {
    //     $filtri=$request->json()->all();
    //     // dd($filtri);
    //     Cache::put('filtri_key', $filtri,60);
    //     return response()->json([
    //         "code" => 200,
    //         "message" => "Filters added successfully",
    //         'filtri' => $filtri
    //     ]);
    // }
    public function getFilters(Request $request)
{
    $filtri = $request->all();
    return response()->json($filtri);
    // Cache::put('filtri',$filtri, 60);
}

    // public function query()
    // {
    //     try {
    //     $queryResult = patologie::select([
    //             'patologie.patologia',
    //             'tumori_casi.casi',
    //             'comune_popolazione_tumori_test.anno',
    //             'comune_popolazione_tumori_test.sesso',
    //             'comune_popolazione_tumori_test.popolazione', 
    //             'comuni.Comune',
    //             'distretti.Distretto',
    //             'asl.Asl',
    //             'classi.classe_eta',
    //             'classi.peso_eu',
    //         ])
    //         ->leftJoin('tumori_casi', 'patologie.IDPatologia', '=', 'tumori_casi.IDPatologia')
    //         ->leftJoin('comune_popolazione_tumori_test', 'tumori_casi.IDComunePop', '=', 'comune_popolazione_tumori_test.ID')
    //         ->leftJoin('comuni', 'comune_popolazione_tumori_test.IDComune', '=', 'comuni.IDComune')
    //         ->leftJoin('distretti', 'comuni.IDDistretto', '=', 'distretti.IDDistretto')
    //         ->leftJoin('asl', 'distretti.IDAsl', '=', 'asl.IDAsl')
    //         ->leftJoin('classi', 'comune_popolazione_tumori_test.IDClasse', '=', 'classi.IDClasse')
    //         ->where('patologie.patologia','=', 'Rene')
    //         ->get();
    //         $result = ['query' => $queryResult];
    //         return $result;
    // } catch (\Exception $e) {
    //     return response()->json(['error' => 'Errore nella query'], 500);
    //     }
    // }
    public function query(Request $request)
{
    try {
        $filtri = $request->all();
        $patologyFilter = $filtri['patology'] ?? '';
        $sessoFilter = $filtri['filters']['sex'] ?? '';
        // if ($sessoFilter === 'Maschi e Femmine') {
        //     $sessoFilter = ['Maschi', 'Femmine'];
        // }
        $queryResult = patologie::select([
            'patologie.patologia',
            'tumori_casi.casi',
            'comune_popolazione_tumori_test.anno',
            'comune_popolazione_tumori_test.sesso',
            'comune_popolazione_tumori_test.popolazione', 
            'comuni.Comune',
            'distretti.Distretto',
            'asl.Asl',
            'classi.classe_eta',
            'classi.peso_eu',
        ])
        ->leftJoin('tumori_casi', 'patologie.IDPatologia', '=', 'tumori_casi.IDPatologia')
        ->leftJoin('comune_popolazione_tumori_test', 'tumori_casi.IDComunePop', '=', 'comune_popolazione_tumori_test.ID')
        ->leftJoin('comuni', 'comune_popolazione_tumori_test.IDComune', '=', 'comuni.IDComune')
        ->leftJoin('distretti', 'comuni.IDDistretto', '=', 'distretti.IDDistretto')
        ->leftJoin('asl', 'distretti.IDAsl', '=', 'asl.IDAsl')
        ->leftJoin('classi', 'comune_popolazione_tumori_test.IDClasse', '=', 'classi.IDClasse')
        // ->where('patologie.patologia', '=', $filtri['patologia']);
        ->where('patologie.patologia', $patologyFilter);
        if ($sessoFilter == 'Maschi e Femmine') {
            //Nothing happened because get everithing
        } elseif ($sessoFilter == 'Maschi') {
            $queryResult->where('comune_popolazione_tumori_test.sesso', '=' ,'Maschi');
        } elseif ($sessoFilter == 'Femmine') {
            $queryResult->where('comune_popolazione_tumori_test.sesso', 'Femmine');
        }
        $queryResult = $queryResult->get();
        
        $result = ['query' => $queryResult];
        return response()->json($result);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Errore nella query'], 500);
    }
}
}
