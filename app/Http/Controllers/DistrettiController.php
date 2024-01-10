<?php

namespace App\Http\Controllers;

use App\Models\distretti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistrettiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $distretti = distretti::all();

        return response()->json(['distretti' => $distretti]);
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
            $distretti = DB::table('distretti')->get();

            info($distretti);

            return response()->json(['distretti' => $distretti]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Errore nella query'], 500);
        }
    }
}
