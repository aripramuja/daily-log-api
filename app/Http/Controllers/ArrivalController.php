<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ArrivalRepository;
use Carbon\Carbon;

use function PHPUnit\Framework\isEmpty;

class ArrivalController extends Controller
{
    protected ArrivalRepository $arrivalRepository;

    public function __construct(ArrivalRepository $arrivalRepository)
    {
        $this->arrivalRepository = $arrivalRepository;
    }

    public function index() {
        $arrivals = $this->arrivalRepository->getAllArrival();

        return response([
            'success' => true,
            'message' => 'List arrival',
            'data' => $arrivals
        ], 200);
    }

    public function store(Request $request) {

        $arrival = $this->arrivalRepository->createArrival($request);


        if($arrival) {
            return response([
                'success' => true,
                'message' => 'Item berhasil disimpan',
                'data' => $arrival
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Item gagal disimpan',
			], 401);
        }
    }

    public function show($id) {
        $arrival = $this->arrivalRepository->getArrivalById($id);

        if($arrival) {
            return response([
                'success' => true,
                'message' => 'arrival '. $id,
                'data' => $arrival
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'arrival with id '. $id . ' not found',
			], 401);
        }
    }

    public function update(Request $request) {
        $arrival = $this->arrivalRepository->updateArrival($request);

        if($arrival) {
            return response([
                'success' => true,
                'message' => 'Item berhasil diupdate',
                'data' => $arrival
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Item gagal diupdate',
			], 401);
        }
    }

    public function destroy($id) {
        $arrival = $this->arrivalRepository->deleteArrival($id);

        if($arrival) {
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

    public function checkIn($username, $latitude, $longitude) {
        $date = Carbon::now("Asia/Jakarta")->format("Y-m-d");
        $data = array();
        $data['tanggal'] = $date;
        $data['status'] = 'check in';
        $data['username'] = $username;
        $data['latitude'] = $latitude;
        $data['longitude'] = $longitude;

        $arrival = $this->arrivalRepository->getArrivalByUsernameAndTanggal($username, $date);
        if($arrival) {
            $data['status'] = 'check out';
            $data['id'] = $arrival->id;
            $arrival = $this->arrivalRepository->updateArrival($data);
        } else {
            $arrival = $this->arrivalRepository->createArrival($data);
        }

        if($arrival) {
            return response([
                'success' => true,
                'message' => $data['status'].' berhasil'
            ],200);
        } else {
            return response([
                'success' => false,
                'message' => 'Check in gagal',
            ], 401);
        }
    }

    public function checkOut($username, $latitude, $longitude) {
        $date = Carbon::now("Asia/Jakarta")->format("Y-m-d");
        $data = array();
        $data['tanggal'] = $date;
        $data['status'] = 'check out';
        $data['username'] = $username;
        $data['latitude'] = $latitude;
        $data['longitude'] = $longitude;

        $arrival = $this->arrivalRepository->createArrival($data);
        if($arrival) {
            return response([
                'success' => true,
                'message' => 'Check out berhasil'
            ],200);
        } else {
            return response([
                'success' => false,
                'message' => 'Check out gagal',
            ], 401);
        }

    }
}
