<?php
namespace App\Repositories;

use App\Models\SubPekerjaan;

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
            'id_pekerjaan' => $data->id_pekerjaan
        ]);
    }

    public function updateSubPekerjaan($data) {
        return SubPekerjaan::find($data->id)->update([
            'nama' => $data->nama,
            'durasi' => $data->durasi,
            'tanggal' => $data->tanggal,
            'status' => $data->status,
            'saran' => $data->saran,
            'id_pekerjaan' => $data->id_pekerjaan
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
}
