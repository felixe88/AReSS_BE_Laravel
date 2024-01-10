<?php

namespace App\Http\Controllers;

use App\Models\tumori_melanoma_cute_casi;
use Illuminate\Http\Request;

class TumoriMelanomaCuteCasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tumori_melanoma_cute_casi = tumori_melanoma_cute_casi::all();

        return response()->json(['tumori_melanoma_cute_casi' => $tumori_melanoma_cute_casi]);
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
}
