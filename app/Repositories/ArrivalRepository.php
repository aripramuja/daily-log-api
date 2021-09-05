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
           'status' => $data["status"],
           'username' => $data["username"],
           'latitude' => $data["latitude"],
           'longitude' => $data["longitude"]
        ]);
    }

    public function updateArrival($data) {
        return Arrival::find($data->id)->update([
            'tanggal' => $data["tanggal"],
            'status' => $data["status"],
            'username' => $data["username"],
            'latitude' => $data["latitude"],
            'longitude' => $data["longitude"]
        ]);
    }

    public function deleteArrival($id) {
        return Arrival::find($id)->delete();
    }

    public function getArrivalByTanggal($date) {
        return Arrival::where('tanggal', $date)->get();
    }
}
