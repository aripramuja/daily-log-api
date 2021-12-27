<?php
namespace App\Repositories;

use App\Models\Pengguna;
use Illuminate\Support\Facades\DB;
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

    public function getAllPenggunaChild($id_user) {
        $query =  Pengguna::where('atasan_id', $id_user)
            ->unionAll(
                Pengguna::select('user.*')
                ->join('cte', 'cte.id', '=', 'user.atasan_id')
            );

            return Pengguna::from('cte')->withRecursiveExpression('cte', $query)->get();
    }

    public function getListStaff($id_user) {
        return Pengguna::where('atasan_id', $id_user)->get();
    }

    public function updateFoto($id_user, $path) {
        return Pengguna::find($id_user)->update([
            'foto' => $path
        ]);
    }

    public function getFotoPengguna($id_user) {
        return Pengguna::where('id',$id_user)->first();
    }
}
