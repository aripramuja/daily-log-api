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
           'longitude' => $data["longitude"],
           'check_in_time' => $data["check_in_time"],
            'check_out_time' => $data["check_out_time"]
        ]);
    }

    public function updateArrival($data) {
        return Arrival::find($data["id"])->update([
            'tanggal' => $data["tanggal"],
            'status' => $data["status"],
            'username' => $data["username"],
            'latitude' => $data["latitude"],
            'longitude' => $data["longitude"],
            'check_in_time' => $data["check_in_time"],
            'check_out_time' => $data["check_out_time"]
        ]);
    }

    public function deleteArrival($id) {
        return Arrival::find($id)->delete();
    }

    public function getArrivalByUsernameAndTanggal($username, $date) {
        return Arrival::where('tanggal', $date)->
            where('username', $username)->first();
    }
}
