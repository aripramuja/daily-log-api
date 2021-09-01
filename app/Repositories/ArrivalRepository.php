<?php
namespace App\Repositories;

use App\Models\Arrival;

class ArrivalRepository {
    public function getAllArrival() {
        return Arrival::all();
    }

    public function getArrivalById($id) {
        return Arrival::find($id);
    }

    public function createArrival($data) {
        return Arrival::create([
           'tanggal' => $data["tanggal"],
           'check_in' => $data["check_in"],
           'check_out' => $data["check_out"]
        ]);
    }

    public function updateArrival($data) {
        return Arrival::find($data->id)->update([
            'tanggal' => $data["tanggal"],
            'check_in' => $data["check_in"],
            'check_out' => $data["check_out"]
        ]);
    }

    public function deleteArrival($id) {
        return Arrival::find($id)->delete();
    }

    public function getArrivalByTanggal($date) {
        return Arrival::where('tanggal', $date)->get();
    }
}
