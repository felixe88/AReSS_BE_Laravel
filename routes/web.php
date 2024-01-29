<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FiltriController;
use App\Http\Controllers\AslController;
use App\Http\Controllers\ComunePopolazioneTumoriTestController;
use App\Http\Controllers\ClassiController;
use App\Http\Controllers\ComuniController;
use App\Http\Controllers\CronicitaBpcoCasiController;
use App\Http\Controllers\CronicitaDiabeteCasiController;
use App\Http\Controllers\CronicitaIpertensioneCasiController;
use App\Http\Controllers\CronicitaScompensoCasiController;
use App\Http\Controllers\DistrettiController;
use App\Http\Controllers\PatologieController;
use App\Http\Controllers\RegioniController;
use App\Http\Controllers\TumoriColonRettoCasiController;
use App\Http\Controllers\TumoriEncefaloCasiController;
use App\Http\Controllers\TumoriFegatoCasiController;
use App\Http\Controllers\TumoriLeucemiaLinfaticaAcutaCasiController;
use App\Http\Controllers\TumoriLeucemiaLinfaticaCronicaCasiController;
use App\Http\Controllers\TumoriLeucemiaMieloideAcutaCasiController;
use App\Http\Controllers\TumoriLeucemiaMieloideCronicaCasiController;
use App\Http\Controllers\TumoriLinfomaHodgkinCasiController;
use App\Http\Controllers\TumoriLinfomaNonHodgkinCasiController;
use App\Http\Controllers\TumoriMammellaCasiController;
use App\Http\Controllers\TumoriMelanomaCuteCasiController;
use App\Http\Controllers\TumoriMesoteliomaCasiController;
use App\Http\Controllers\TumoriMielomaCasiController;
use App\Http\Controllers\TumoriOvaioCasiController;
use App\Http\Controllers\TumoriPancreasCasiController;
use App\Http\Controllers\TumoriPolmoneCasiController;
use App\Http\Controllers\TumoriProstataCasiController;
use App\Http\Controllers\TumoriReneCasiController;
use App\Http\Controllers\TumoriStomacoCasiController;
use App\Http\Controllers\TumoriTestaColloCasiController;
use App\Http\Controllers\TumoriTesticoloCasiController;
use App\Http\Controllers\TumoriTiroideCasiController;
use App\Http\Controllers\TumoriUteroColloCasiController;
use App\Http\Controllers\TumoriUteroCorpoCasiController;
use App\Http\Controllers\TumoriVescicaCasiController;
use App\Http\Controllers\TumoriCasiController;
use App\Http\Controllers\Chart1Controller;
use App\Http\Controllers\tumoriPolmoneController;

use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::post('api/ricevi-filtri', [FiltriController::class, 'riceviFiltri']);

Route::any('ricevi-filtri', [PatologieController::class, 'getFilters']);

//*************************************************************************************************
Route::apiResource('asl', AslController::class);
Route::apiResource('classi', ClassiController::class);
Route::apiResource('comune_popolazione_tumori_test', ComunePopolazioneTumoriTestController::class);
Route::apiResource('comuni', ComuniController::class);
Route::apiResource('distretti',DistrettiController::class);
Route::apiResource('patologie',PatologieController::class);
Route::apiResource('regioni',RegioniController::class);
Route::apiResource('tumori_casi',TumoriCasiController::class);
Route::apiResource('Chart1',Chart1Controller::class);
Route::apiResource('tumori_polmone',tumoriPolmoneController::class);
//*************************************************************************************************

Route::get('comune_popolazione_tumori_test_query', [ComunePopolazioneTumoriTestController::class, 'query']);
Route::any('query-patologie', [PatologieController::class, 'query']);
Route::any('query-peso-eu', [PatologieController::class, 'queryPesoEu']);
Route::get('visualizza-risultato', [Chart1Controller::class, 'chart1Results']);




//*************************************************************************************************

Route::get('/', function () {
    return view('welcome');
});
