<?php

use App\Http\Controllers\ArrivalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\SubPekerjaanController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingController;

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
Route::get('pengguna/{id_user?}/list/staff', [PenggunaController::class, 'getPenggunaStaff']);
Route::get('pengguna/position/{id_position?}', [PenggunaController::class, 'getPenggunaByIdPosition']);
Route::post('pengguna/foto/upload', [PenggunaController::class, 'uploadFotoPengguna']);
Route::get('pengguna/foto/{id_user?}', [PenggunaController::class, 'getFotoPengguna']);

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
Route::get('chart/tim/{idUser?}/tanggal/{dateFrom?}/{dateTo?}', [SubPekerjaanController::class, 'getDataTotalDurasiTimByTanggal']);
Route::get('chart/tim/{idUser?}/tanggal/{dateFrom?}/{dateTo?}/hari', [SubPekerjaanController::class, 'getDataTotalDurasiTim1Hari']);
Route::get('pengguna/{idUser?}/persetujuan/subpekerjaan/valid/{dateFrom?}/{dateTo?}/download', [SubPekerjaanController::class, 'exportToExcel']);

Route::get('chart/tim/all/{idPengguna?}/tanggal/{dateFrom?}/{dateTo?}/hari', [SubPekerjaanController::class, 'getDataTotalDurasiAllTimStaff1Hari']);
Route::get('chart/tim/all/{idPengguna?}/tanggal/{dateFrom?}/{dateTo?}', [SubPekerjaanController::class, 'getDataTotalDurasiAllTimStaffByTanggal']);
Route::get('chart/tim/{idPosition?}/{idPengguna?}/tanggal/{dateFrom?}/{dateTo?}', [SubPekerjaanController::class, 'getDataTotalDurasiTimStaffByTanggal']);
Route::get('chart/tim/{idPosition?}/{idPengguna?}/tanggal/{dateFrom?}/{dateTo?}/hari', [SubPekerjaanController::class, 'getDataTotalDurasiTimStaff1Hari']);

Route::post('position/store', [PositionController::class, 'store']);
Route::get('position', [PositionController::class, 'index']);
Route::get('position/{id?}', [PositionController::class, 'show']);
Route::post('position/update', [PositionController::class, 'update']);
Route::delete('position/{id?}', [PositionController::class, 'destroy']);

Route::post('presence/store', [PresenceController::class, 'store']);
Route::get('presence', [PresenceController::class, 'index']);
Route::get('presence/{id?}', [PresenceController::class, 'show']);
Route::post('presence/update', [PresenceController::class, 'update']);
Route::delete('presence/{id?}', [PresenceController::class, 'destroy']);
Route::get('presence/{id_user?}/{date?}', [PresenceController::class, 'getTodayPresenceByIdUser']);
Route::get('presence/tim/{id_user?}/{dateFrom?}/{dateTo?}', [PresenceController::class, 'getDataPresenceTim']);
Route::get('presence/tim/staff/{id_user?}/{dateFrom?}/{dateTo?}', [PresenceController::class, 'getDataPresenceTimStaff']);
Route::get('presence/list/{id_user?}/{dateFrom?}/{dateTo?}', [PresenceController::class, 'getPresenceUserByTanggal']);

Route::post('city/store', [CityController::class, 'store']);
Route::get('city', [CityController::class, 'index']);
Route::get('city/{id?}', [CityController::class, 'show']);
Route::post('city/update', [CityController::class, 'update']);
Route::delete('city/{id?}', [CityController::class, 'destroy']);

Route::get('arrival/checkin/{username?}/{latitude?}/{longitude?}', [ArrivalController::class, 'checkIn']);
Route::get('arrival/checkout/{username?}', [ArrivalController::class, 'checkOut']);

Route::get('pengguna/{idUser?}/persetujuan/subpekerjaan/submit', [SubPekerjaanController::class, 'getSubmittedPersetujuan']);
Route::get('pengguna/{idUser?}/persetujuan/subpekerjaan/reject', [SubPekerjaanController::class, 'getRejectedPersetujuan']);
Route::get('pengguna/{idUser?}/persetujuan/subpekerjaan/valid/{dateFrom?}/{dateTo?}', [SubPekerjaanController::class, 'getValidPersetujuan']);

Route::post('notification/store', [NotificationController::class, 'store']);
Route::get('notification', [NotificationController::class, 'index']);
Route::get('notification/{id?}', [NotificationController::class, 'show']);
Route::post('notification/update', [NotificationController::class, 'update']);
Route::delete('notification/{id?}', [NotificationController::class, 'destroy']);
Route::get('notification/pengguna/{id?}', [NotificationController::class, 'getNotificationByReceiverId']);
Route::get('notification/{id?}/read', [NotificationController::class, 'updateNotificationRead']);
Route::get('notification/pengguna/{id?}/count', [NotificationController::class, 'getNotificationUnreadByReceiverId']);

Route::get('setting', [SettingController::class, 'index']);
