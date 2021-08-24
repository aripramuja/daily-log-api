<?php
namespace App\Repositories;

use App\Models\City;

class CityRepository {
    public function getAllCity() {
        return City::all();
    }

    public function getCityById($id) {
        return City::find($id);
    }

    public function createCity($data) {
        return City::create([
           'city' => $data["city"],
           'latitude' => $data["latitude"],
           'longitude' => $data["longitude"]
        ]);
    }

    public function updateCity($data) {
        return City::find($data->id)->update([
           'city' => $data['city'],
           'latitude' => $data['latitude'],
           'longitude' => $data['longitude']
        ]);
    }

    public function deleteCity($id) {
        return City::find($id)->delete();
    }
}
