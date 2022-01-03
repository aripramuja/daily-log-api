<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubPekerjaanController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('pengguna/{idUser?}/persetujuan/subpekerjaan/valid/{dateFrom?}/{dateTo?}', [SubPekerjaanController::class, 'exportToExcel']);
