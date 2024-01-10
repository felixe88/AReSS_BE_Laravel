<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;

class FiltriController extends Controller
{

    // public function riceviFiltri(Request $request)
    // {
    //     try {
    //         // Ottieni i dati JSON dalla richiesta
    //         $datiFiltri = $request->json()->all();
    
    //         // Aggiungi un log
    //         // \Log::info('Dati filtri ricevuti: ' . json_encode($datiFiltri));
            
    //         // return response()->json($datiFiltri);
    //         $stringaDatiRicevuti = "Questi sono i dati ricevuti: " . json_encode($datiFiltri);

    //         return response()->json(['message' => $stringaDatiRicevuti]);
    //     } catch (\Exception $e) {
    //         // Aggiungi un log per eventuali errori
    //         \Log::error('Errore nella gestione dei filtri: ' . $e->getMessage());
    //         // Restituisci una risposta di errore
    //         return response()->json(['error' => 'Errore nella gestione dei filtri'], 500);
    //     }
    //     $datiFiltri.patologia //voglio visualizzare i dati presenti in $datifiltri
    // }
    
    public function riceviFiltri(Request $request)
{
    try {
        // Ottieni i dati JSON dalla richiesta
        $datiFiltri = $request->json()->all();

        // Aggiungi un log
        // \Log::info('Dati filtri ricevuti: ' . json_encode($datiFiltri));

        if (isset($datiFiltri['Patologia'])) {
            $patologia = $datiFiltri['Patologia'];
            \Log::info('Patologia ricevuta: ' . $patologia);
        } else {
            \Log::warning('Campo "patologia" non presente nei dati ricevuti.');
        }

        $stringaDatiRicevuti = "Questi sono i dati ricevuti: " . json_encode($datiFiltri);

        return response()->json(['message' => $stringaDatiRicevuti]);
    } catch (\Exception $e) {
        // Aggiungi un log per eventuali errori
        \Log::error('Errore nella gestione dei filtri: ' . $e->getMessage());
        // Restituisci una risposta di errore
        return response()->json(['error' => 'Errore nella gestione dei filtri'], 500);
    }
}

    // public function riceviFiltri(Request $request)
    // {
    //     try {
    //         // Ottieni i dati JSON dalla richiesta
    //         $datiFiltri = $request->json()->all();

    //         // Fai qualcosa con i dati (es. applica filtri al tuo modello, ecc.)

    //         // Aggiungi un log
    //         // \Log::info('Dati filtri ricevuti:', $datiFiltri);
    //         \Log::info('Dati filtri ricevuti: ' . json_encode($datiFiltri, JSON_PRETTY_PRINT));

    //         // Restituisci una risposta
    //         return response()->json($datiFiltri);
    //     } catch (\Exception $e) {
    //         // Aggiungi un log per eventuali errori
    //         \Log::error('Errore nella gestione dei filtri: ' . $e->getMessage());


    //         // Restituisci una risposta di errore
    //         return response()->json(['error' => 'Errore nella gestione dei filtri'], 500);
    //     }
    // }

}
