<?php
namespace App\Repositories;

use App\Models\SubPekerjaan;
use Illuminate\Support\Facades\DB;

class SubPekerjaanRepository {
    public function getAllSubPekerjaan() {
        return SubPekerjaan::all();
    }

    public function getSubPekerjaanById($id) {
        return SubPekerjaan::find($id);
    }

    public function createSubPekerjaan($data) {
        return SubPekerjaan::create([
            'nama' => $data->nama,
            'durasi' => $data->durasi,
            'tanggal' => $data->tanggal,
            'status' => $data->status,
            'saran' => $data->saran,
            'id_pekerjaan' => $data->id_pekerjaan,
            'id_user' => $data->id_user
        ]);
    }

    public function updateSubPekerjaan($data) {
        return SubPekerjaan::find($data->id)->update([
            'nama' => $data->nama,
            'durasi' => $data->durasi,
            'tanggal' => $data->tanggal,
            'status' => $data->status,
            'saran' => $data->saran,
            'id_pekerjaan' => $data->id_pekerjaan,
            'id_user' => $data->id_user
        ]);
    }

    public function deleteSubPekerjaan($id) {
        return SubPekerjaan::find($id)->delete();
    }

    public function getSubmitSubPekerjaan($id_pekerjaan) {
        return SubPekerjaan::where('status', 'submit')->
            where('id_pekerjaan', $id_pekerjaan)->get();
    }

    public function getRejectSubPekerjaan($id_pekerjaan) {
        return SubPekerjaan::where('status', 'reject')->
            where('id_pekerjaan', $id_pekerjaan)->get();
    }

    public function getValidSubPekerjaan($id_pekerjaan) {
        return SubPekerjaan::where('status', 'valid')->
            where('id_pekerjaan', $id_pekerjaan)->get();
    }

    public function getValidSubPekerjaanCount($id_pekerjaan) {
        return SubPekerjaan::where('status', 'valid')->
            where('id_pekerjaan', $id_pekerjaan)->count();
    }

    public function getDataTotalDurasiByTanggal($idUser, $dateFrom, $dateTo) {
        return SubPekerjaan::where('id_user', $idUser)->where('status', 'valid')->
            whereBetween('tanggal', [$dateFrom, $dateTo . ' 23:59:59'])->selectRaw("SUM(durasi) as durasi, DATE(tanggal) as tanggal")->
            groupBy(\DB::raw('DATE(tanggal)'))->get();
    }

    public function getDataTotalDurasiTimByTanggal($idUser, $dateFrom, $dateTo) {
        return SubPekerjaan::whereIn('id_user', $idUser)->where('status', 'valid')->
            whereBetween('tanggal', [$dateFrom, $dateTo])->selectRaw("SUM(durasi) as durasi, DATE(tanggal) as tanggal")->
            groupBy(\DB::raw('DATE(tanggal)'))->get();
    }

    public function getDataTotalDurasiTim1Hari($idUser, $dateFrom, $dateTo) {
        return SubPekerjaan::whereIn('id_user', $idUser)->where('status', 'valid')->
            whereBetween('tanggal', [$dateFrom, $dateTo])->selectRaw("SUM(durasi) as durasi, tanggal")->
            groupBy('tanggal')->get();
    }

    public function getValidSubPekerjaanCountByTanggsl($id_pekerjaan, $dateFrom, $dateTo) {
        return SubPekerjaan::where('status', 'valid')->
            where('id_pekerjaan', $id_pekerjaan)->whereBetween('tanggal', [$dateFrom, $dateTo . ' 23:59:59'])->count();
    }

    public function getSubmitSubPekerjaanCount($id_pekerjaan) {
        return SubPekerjaan::where('status', 'submit')->
            where('id_pekerjaan', $id_pekerjaan)->count();
    }

    public function getRejectSubPekerjaanCount($id_pekerjaan) {
        return SubPekerjaan::where('status', 'reject')->
            where('id_pekerjaan', $id_pekerjaan)->count();
    }

    public function getValidSubPekerjaanByTanggal($id_pekerjaan, $dateFrom, $dateTo) {
        return SubPekerjaan::where('status', 'valid')->
            where('id_pekerjaan', $id_pekerjaan)->whereBetween('tanggal', [$dateFrom, $dateTo . ' 23:59:59'])->get();
    }

    public function getSumDurasiPekerjaanStaff($id_staff, $dateFrom, $dateTo) {
        return DB::table('sub_pekerjaan')->where('status', '=', 'valid')->whereBetween('sub_pekerjaan.tanggal', [$dateFrom, $dateTo . ' 23:59:59'])
        ->whereIn('sub_pekerjaan.id_user', $id_staff)
        ->join('pekerjaan', 'sub_pekerjaan.id_pekerjaan', '=', 'pekerjaan.id')
        ->selectRaw('pekerjaan.nama, SUM(durasi) as durasi')->
        groupByRaw('pekerjaan.nama')->get();
    }
}
