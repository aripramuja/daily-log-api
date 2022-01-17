<?php
namespace App\Repositories;

use App\Models\Pengumuman;

class PengumumanRepository {
    public function getAllPengumuman() {
        return Pengumuman::all();
    }

    public function getPengumumanById($id) {
        return Pengumuman::find($id);
    }

    public function createPengumuman($data) {
        return Pengumuman::create([
            'pengumuman' => $data->pengumuman,
            'tanggal' => $data->tanggal,
        ]);
    }

    public function updatePengumuman($data) {
        return Pengumuman::find($data->id)->update([
            'pengumuman' => $data->pengumuman,
            'tanggal' => $data->tanggal,
        ]);
    }

    public function deletePengumuman($id) {
        return Pengumuman::find($id)->delete();
    }
}
