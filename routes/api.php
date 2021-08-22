<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\SubPekerjaanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('pengguna/store', [PenggunaController::class, 'store']);
Route::get('pengguna', [PenggunaController::class, 'index']);
Route::get('pengguna/{id?}', [PenggunaController::class, 'show']);
Route::post('pengguna/update', [PenggunaController::class, 'update']);
Route::delete('pengguna/{id?}', [PenggunaController::class, 'destroy']);
Route::post('pengguna/login', [PenggunaController::class, 'login']);
Route::get('pengguna/list/staff', [PenggunaController::class, 'getPenggunaStaff']);

Route::post('pekerjaan/store', [PekerjaanController::class, 'store']);
Route::get('pekerjaan', [PekerjaanController::class, 'index']);
Route::get('pekerjaan/{id?}', [PekerjaanController::class, 'show']);
Route::post('pekerjaan/update', [PekerjaanController::class, 'update']);
Route::delete('pekerjaan/{id?}', [PekerjaanController::class, 'destroy']);
Route::get('pekerjaan/pengguna/{id?}', [PekerjaanController::class, 'getPekerjaanByIdUser']);
Route::get('pekerjaan/pengguna/{id?}/tanggal/{dateFrom?}/{dateTo?}', [PekerjaanController::class, 'getPekerjaanByUserIdAndTanggal']);

Route::post('subpekerjaan/store', [SubPekerjaanController::class, 'store']);
Route::get('subpekerjaan', [SubPekerjaanController::class, 'index']);
Route::get('subpekerjaan/{id?}', [SubPekerjaanController::class, 'show']);
Route::post('subpekerjaan/update', [SubPekerjaanController::class, 'update']);
Route::delete('subpekerjaan/{id?}', [SubPekerjaanController::class, 'destroy']);
Route::get('pengguna/{id?}/subpekerjaan/submit', [SubPekerjaanController::class, 'getSubmittedSubPekerjaan']);
Route::get('pengguna/{id?}/subpekerjaan/reject', [SubPekerjaanController::class, 'getRejectedSubPekerjaan']);
Route::get('pengguna/{id?}/subpekerjaan/valid', [SubPekerjaanController::class, 'getValidSubPekerjaan']);
Route::get('pengguna/{id?}/pekerjaan/subpekerjaan/submit', [SubPekerjaanController::class, 'getSubmittedSubPekerjaanByIdPengguna']);
Route::get('pengguna/{id?}/subpekerjaan/{dateFrom?}/{dateTo?}/valid/count', [SubPekerjaanController::class, 'getValidSubPekerjaanCount']);
Route::get('chart/pengguna/{idPengguna?}/tanggal/{dateFrom?}/{dateTo?}', [SubPekerjaanController::class, 'getDataTotalDurasiByTanggal']);
