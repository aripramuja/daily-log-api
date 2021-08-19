<?php

namespace App\Http\Controllers;

use App\Repositories\PekerjaanRepository;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    protected PekerjaanRepository $pekerjaanRepository;

    public function __construct(PekerjaanRepository $pekerjaanRepository)
    {
        $this->pekerjaanRepository = $pekerjaanRepository;
    }

    public function index() {
        $pekerjaans = $this->pekerjaanRepository->getAllPekerjaan();

        return response([
            'success' => true,
            'message' => 'List Pekerjaan',
            'data' => $pekerjaans
        ], 200);
    }

    public function store(Request $request) {
        $pekerjaan = $this->pekerjaanRepository->createPekerjaan($request);

        if($pekerjaan) {
            return response([
                'success' => true,
                'message' => 'Item berhasil disimpan',
                'data' => $pekerjaan
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Item gagal disimpan',
			], 401);
        }
    }

    public function show($id) {
        $pekerjaan = $this->pekerjaanRepository->getPekerjaanById($id);

        if($pekerjaan) {
            return response([
                'success' => true,
                'message' => 'Pekerjaan '. $id,
                'data' => $pekerjaan
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Pekerjaan with id '. $id . ' not found',
			], 401);
        }
    }

    public function update(Request $request) {
        $pekerjaan = $this->pekerjaanRepository->updatePekerjaan($request);

        if($pekerjaan) {
            return response([
                'success' => true,
                'message' => 'Item berhasil diupdate',
                'data' => $pekerjaan
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Item gagal diupdate',
			], 401);
        }
    }

    public function destroy($id) {
        $pekerjaan = $this->pekerjaanRepository->deletePekerjaan($id);

        if($pekerjaan) {
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

    public function getPekerjaanByIdUser($id) {
        $pekerjaans = $this->pekerjaanRepository->getPekerjaanByIdUser($id);

        return response([
            'success' => true,
            'message' => 'List Pekerjaan',
            'data' => $pekerjaans
        ], 200);
    }

    public function getPekerjaanByUserIdAndTanggal($id, $dateFrom, $dateTo) {
        $pekerjaans = $this->pekerjaanRepository->getPekerjaanByIdUserAndTanggal($id, $dateFrom, $dateTo);
        return response([
            'success' => true,
            'message' => 'List Pekerjaan form '. $dateFrom .' to ' .$dateTo,
            'data' => $pekerjaans
        ], 200);
    }
}
