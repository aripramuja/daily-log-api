<?php
namespace App\Repositories;

use App\Models\Pengguna;

class PenggunaRepository {
    public function getAllPengguna() {
        return Pengguna::all();
    }

    public function getPenggunaById($id) {
        return Pengguna::find($id);
    }

    public function createPengguna($data) {
        return Pengguna::create([
            'username' => $data->username,
            'password' => $data->password,
            'jabatan' => $data->jabatan
        ]);
    }

    public function updatePengguna($data) {
        return Pengguna::find($data->id)->update([
            'username' => $data->username,
            'password' => $data->password,
            'jabatan' => $data->jabatan
        ]);
    }

    public function deletePengguna($id) {
        return Pengguna::find($id)->delete();
    }

    public function getPenggunaByUsername($username) {
        return Pengguna::where('username', $username)->first();
    }

    public function getPenggunaByJabatan($jabatan) {
        return Pengguna::where('jabatan', $jabatan)->get();
    }

    public function getPenggunaByPositionId($id_position) {
        return Pengguna::where('position_id', $id_position)->first();
    }

    // public function getPenggunaStaff($id_position) {
    //     return Pengguna::join('position', 'position.id', '=', 'user.position_id')->
    //         select('user.id', 'username', 'jabatan', 'jabatan', 'position_id')->
    //         where('position.parent_id', $id_position)->get();
    // }

    public function getListStaff($id_user) {
        return Pengguna::where('atasan_id', $id_user)->get();
    }
}
