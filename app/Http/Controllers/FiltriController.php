<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Session;


class FiltriController extends Controller
{
    // public function riceviFiltri(Request $request)
    // {
    //     try {
    //         $datiFiltri = $request->json()->all();
    //         return response()->json($datiFiltri);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Errore nella gestione dei filtri'], 500);
    //     }
    // }

    public function riceviFiltri(Request $request)
    {
        try {
            $datiFiltri = $request->json()->all();

            // Salva i dati nella sessione per un breve periodo
            $request->session()->put('datiFiltri', $datiFiltri);

            // Restituisci i dati come risposta
            return response()->json($datiFiltri);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Errore nella gestione dei filtri'], 500);
        }
    }
    // public function riceviFiltri(Request $request)
    // {
    //     try {
    //         $datiFiltri = $request->json()->all();

    //         // Salva i dati nella sessione per un breve periodo
    //         Session::put('filter', $datiFiltri);
    //         // Restituisci i dati come risposta
    //         return response()->json(['message' => 'Filters received successfully']);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Errore nella gestione dei filtri'], 500);
    //     }
    // }
    // public function viewTemporaryData(Request $request)
    // {
    //     // Recupera i dati dalla sessione
    //     $datiFiltri = $request->session()->get('datiFiltri');

    //     // Visualizza i dati nel backend
    //     dd($datiFiltri);
    // }
    // public function viewTemporaryData(Request $request)
    // {
    //     $datiFiltri = $request->session()->get('datiFiltri');

    //     if ($datiFiltri) {
    //         dd($datiFiltri);
    //     } else {
    //         dd('Nessun dato nella sessione.');
    //     }
    // }
    public function viewTemporaryData(Request $request)
    {
        $filter = $request->session()->get('datiFiltri');
        // dd(Session::get('filter'));


        return response()->json(['filter' => $filter]);

    }
}
