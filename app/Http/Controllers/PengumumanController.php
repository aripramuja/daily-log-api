<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PengumumanRepository;

class PengumumanController extends Controller
{
    protected PengumumanRepository $pengumumanRepository;

    public function __construct(PengumumanRepository $pengumumanRepository)
    {
        $this->pengumumanRepository = $pengumumanRepository;
    }

    public function index() {
        $pengumumans = $this->pengumumanRepository->getAllPengumuman();

        return response([
            'success' => true,
            'message' => 'List Pengumuman',
            'data' => $pengumumans
        ], 200);
    }

    public function store(Request $request) {
        $pengumuman = $this->pengumumanRepository->createPengumuman($request);

        if($pengumuman) {
            return response([
                'success' => true,
                'message' => 'Item berhasil disimpan',
                'data' => $pengumuman
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Item gagal disimpan',
			], 200);
        }
    }

    public function show($id) {
        $pengumuman = $this->pengumumanRepository->getPengumumanById($id);

        if($pengumuman) {
            return response([
                'success' => true,
                'message' => 'Pengumuman '. $id,
                'data' => $pengumuman
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Pengumuman with id '. $id . ' not found',
			], 200);
        }
    }

    public function update(Request $request) {
        $pengumuman = $this->pengumumanRepository->updatePengumuman($request);

        if($pengumuman) {
            return response([
                'success' => true,
                'message' => 'Item berhasil diupdate',
                'data' => $pengumuman
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Item gagal diupdate',
			], 200);
        }
    }

    public function destroy($id) {
        $pengumuman = $this->pengumumanRepository->deletePengumuman($id);

        if($pengumuman) {
            return response([
                'success' => true,
                'message' => 'Item berhasil dihapus'
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Item gagal dihapus',
			], 200);
        }
    }
}
