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

    public function getFilters(Request $request)
{
    $filtri = $request->all();
    return response()->json($filtri);
}

public function query(Request $request)
{
    try {
        $filtri = $request->all();
        $patologyFilter = $filtri['patology'] ?? '';
        $sessoFilter = $filtri['filters']['sex'] ?? '';
        $annoFilter = $filtri['filters']['years'] ?? '';
        $etaFilter = $filtri['filters']['age'] ?? '';

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
        ->join('tumori_casi', 'patologie.IDPatologia', '=', 'tumori_casi.IDPatologia')
        ->join('comune_popolazione_tumori_test', function ($join) use ($sessoFilter, $annoFilter) {
            $join->on('tumori_casi.IDComunePop', '=', 'comune_popolazione_tumori_test.ID');
            if ($sessoFilter && in_array($sessoFilter, ['Maschi', 'Femmine'])) {
                $join->where('comune_popolazione_tumori_test.sesso', $sessoFilter);
            }
            if (!empty($annoFilter)) {
                $anniFilter = explode(',', $annoFilter);
                $join->whereIn('comune_popolazione_tumori_test.anno', $anniFilter);
            }
            if (!empty($etaFilter)) {
                $rangeArray = explode(',', $etaFilter);
                $join->where(function ($query) use ($rangeArray) {
                    foreach ($rangeArray as $range) {
                        list($start, $end) = explode('-', $range);
                        $query->orWhereBetween('classi.classe_eta', [$start, $end]);
                    }
                });
            }
        })
        ->leftJoin('comuni', 'comune_popolazione_tumori_test.IDComune', '=', 'comuni.IDComune')
        ->leftJoin('distretti', 'comuni.IDDistretto', '=', 'distretti.IDDistretto')
        ->leftJoin('asl', 'distretti.IDAsl', '=', 'asl.IDAsl')
        ->leftJoin('classi', 'comune_popolazione_tumori_test.IDClasse', '=', 'classi.IDClasse')
        ->where('patologie.IDPatologia', '15')
        ->get();
        $result = [$queryResult];
        // echo '<pre>';
        // print_r($result);
        // echo '</pre>';
        // echo '<pre>' . json_encode($result, JSON_PRETTY_PRINT) . '</pre>';
        // var_dump($result);
        return response()->json($result);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Errore nella query'], 500);
    }
}
}
