<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CityRepository;

class CityController extends Controller
{
    protected CityRepository $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function index() {
        $citys = $this->cityRepository->getAllCity();

        return response([
            'success' => true,
            'message' => 'List city',
            'data' => $citys
        ], 200);
    }

    public function store(Request $request) {
        foreach($request->json()->all() as $data) {
            // dd($data);
             $city = $this->cityRepository->createCity($data);
         }

        if($city) {
            return response([
                'success' => true,
                'message' => 'Item berhasil disimpan',
                'data' => $city
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Item gagal disimpan',
			], 401);
        }
    }

    public function show($id) {
        $city = $this->cityRepository->getCityById($id);

        if($city) {
            return response([
                'success' => true,
                'message' => 'city '. $id,
                'data' => $city
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'city with id '. $id . ' not found',
			], 401);
        }
    }

    public function update(Request $request) {
        $city = $this->cityRepository->updateCity($request);

        if($city) {
            return response([
                'success' => true,
                'message' => 'Item berhasil diupdate',
                'data' => $city
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Item gagal diupdate',
			], 401);
        }
    }

    public function destroy($id) {
        $city = $this->cityRepository->deleteCity($id);

        if($city) {
            return response([
                'success' => true,
                'message' => 'Item berhasil dihapus'
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Item gagal dihapus',
			], 401);
        }
    }
}
