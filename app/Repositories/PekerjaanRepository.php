<?php
namespace App\Repositories;

use App\Models\Pekerjaan;

class PekerjaanRepository {
    public function getAllPekerjaan() {
        return Pekerjaan::all();
    }

    public function getPekerjaanById($id) {
        return Pekerjaan::find($id);
    }

    public function createPekerjaan($data) {
        return Pekerjaan::create([
            'nama' => $data->nama,
            'id_user' => $data->id_user
        ]);
    }

    public function updatePekerjaan($data) {
        return Pekerjaan::find($data->id)->update([
            'nama' => $data->nama,
            'id_user' => $data->id_user
        ]);
    }

    public function deletePekerjaan($id) {
        return Pekerjaan::find($id)->delete();
    }

    public function getPekerjaanByIdUser($id){
        return Pekerjaan::where('id_user', $id)->get();
    }

    public function getPekerjaanByIdUserAndTanggal($id, $dateFrom, $dateTo){
        return Pekerjaan::where('id_user', $id)->
            whereBetween('tanggal', [$dateFrom, $dateTo])->get();
    }
}
