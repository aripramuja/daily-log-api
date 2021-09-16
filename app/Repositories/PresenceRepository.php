<?php
namespace App\Repositories;

use App\Models\Presence;

class PresenceRepository {
    public function getAllPresence() {
        return Presence::all();
    }

    public function getPresenceById($id) {
        return Presence::find($id);
    }

    public function createPresence($data) {
        return Presence::create([
            'temperature' => $data->temperature,
            'conditions' => $data->conditions,
            'city' => $data->city,
            'latitude' => $data->latitude,
            'longitude' => $data->longitude,
            'notes' => $data->notes,
            'date' => $data->date,
            'check_in_time' => $data->check_in_time,
            'check_out_time' => $data->check_out_time,
            'id_user' => $data->id_user,
        ]);
    }

    public function updatePresence($data) {
        return Presence::find($data->id)->update([
            'temperature' => $data->temperature,
            'conditions' => $data->conditions,
            'city' => $data->city,
            'latitude' => $data->latitude,
            'longitude' => $data->longitude,
            'notes' => $data->notes,
            'date' => $data->date,
            'check_in_time' => $data->check_in_time,
            'check_out_time' => $data->check_out_time,
            'id_user' => $data->id_user,
        ]);
    }

    public function deletePresence($id) {
        return Presence::find($id)->delete();
    }

    public function getPresenceTodayByUserId($id_user, $date) {
        return Presence::where('date', $date)->where('id_user', $id_user)->get();
    }

    public function getDataPresenceByTanggal($dateFrom, $dateTo) {
        return Presence::selectRaw('date, COUNT(*) as hadir')->whereBetween('date', [$dateFrom, $dateTo])->groupBy('date')->get();
    }
}
