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

Route::any('ricevi-filtri', [FiltriController::class, 'riceviFiltri']);

//*************************************************************************************************
Route::apiResource('asl', AslController::class);
Route::apiResource('classi', ClassiController::class);
Route::apiResource('comune_popolazione_tumori_test', ComunePopolazioneTumoriTestController::class);
Route::apiResource('comuni', ComuniController::class);
Route::apiResource('cronicita_bpco_casi', CronicitaBpcoCasiController::class);
Route::apiResource('cronicita_diabete_casi', CronicitaDiabeteCasiController::class);
Route::apiResource('cronicita_ipertensione_casi', CronicitaIpertensioneCasiController::class);
Route::apiResource('cronicita_scompenso_casi', CronicitaScompensoCasiController::class);
Route::apiResource('distretti',DistrettiController::class);
Route::apiResource('patologie',PatologieController::class);
Route::apiResource('regioni',RegioniController::class);
Route::apiResource('tumori_colon_retto_casi',TumoriColonRettoCasiController::class);
Route::apiResource('tumori_encefalo_casi',TumoriEncefaloCasiController::class);
Route::apiResource('tumori_fegato_casi',TumoriFegatoCasiController::class);
Route::apiResource('leucemia_linfatica_acuta',TumoriLeucemiaLinfaticaAcutaCasiController::class);
Route::apiResource('leucemia_linfatica_cronica',TumoriLeucemiaLinfaticaCronicaCasiController::class);
Route::apiResource('leucemia_mieloide_acuta',TumoriLeucemiaMieloideAcutaCasiController::class);
Route::apiResource('leucemia_mieloide_cronica',TumoriLeucemiaMieloideCronicaCasiController::class);
Route::apiResource('tumori_linfoma_hodgkin',TumoriLinfomaHodgkinCasiController::class);
Route::apiResource('tumori_linfoma_non_hodgkin',TumoriLinfomaNonHodgkinCasiController::class);
Route::apiResource('tumori_mammella_casi',TumoriMammellaCasiController::class);
Route::apiResource('tumori_melanoma_cute_casi',TumoriMelanomaCuteCasiController::class);
Route::apiResource('tumori_mesotelioma_casi',TumoriMesoteliomaCasiController::class);
Route::apiResource('tumori_mieloma_casi',TumoriMielomaCasiController::class);
Route::apiResource('tumori_ovaio_casi',TumoriOvaioCasiController::class);
Route::apiResource('tumori_pancreas_casi',TumoriPancreasCasiController::class);
Route::apiResource('tumori_polmone_casi',TumoriPolmoneCasiController::class);
Route::apiResource('tumori_prostata_casi',TumoriProstataCasiController::class);
Route::apiResource('tumori_rene_casi',TumoriReneCasiController::class);
Route::apiResource('tumori_stomaco_casi',TumoriStomacoCasiController::class);
Route::apiResource('tumori_testa_collo_casi',TumoriTestaColloCasiController::class);
Route::apiResource('tumori_testicolo_casi',TumoriTesticoloCasiController::class);
Route::apiResource('tumori_tiroide_casi',TumoriTiroideCasiController::class);
Route::apiResource('tumori_utero_collo_casi',TumoriUteroColloCasiController::class);
Route::apiResource('tumori_utero_corpo_casi',TumoriUteroCorpoCasiController::class);
Route::apiResource('tumori_vescica_casi',TumoriVescicaCasiController::class);
//*************************************************************************************************

Route::get('comune_popolazione_tumori_test_query', [ComunePopolazioneTumoriTestController::class, 'query']);
Route::get('query-distretti', [DistrettiController::class, 'query']);
Route::get('query-patologie', [PatologieController::class, 'query']);


//*************************************************************************************************

Route::get('/', function () {
    return view('welcome');
});
