<?php

namespace App\Http\Controllers;

use App\Repositories\PekerjaanRepository;
use App\Repositories\SubPekerjaanRepository;
use Illuminate\Http\Request;

class SubPekerjaanController extends Controller
{
    protected SubPekerjaanRepository $subPekerjaanRepository;
    protected PekerjaanRepository $pekerjaanRepository;

    public function __construct(
        SubPekerjaanRepository $subPekerjaanRepository,
        PekerjaanRepository $pekerjaanRepository
    ){
        $this->subPekerjaanRepository = $subPekerjaanRepository;
        $this->pekerjaanRepository = $pekerjaanRepository;
    }

    public function index() {
        $subPekerjaans = $this->subPekerjaanRepository->getAllSubPekerjaan();

        return response([
            'success' => true,
            'message' => 'List SubPekerjaan',
            'data' => $subPekerjaans
        ], 200);
    }

    public function store(Request $request) {
        $subPekerjaan = $this->subPekerjaanRepository->createSubPekerjaan($request);

        if($subPekerjaan) {
            return response([
                'success' => true,
                'message' => 'Item berhasil disimpan',
                'data' => $subPekerjaan
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Item gagal disimpan',
			], 401);
        }
    }

    public function show($id) {
        $subPekerjaan = $this->subPekerjaanRepository->getSubPekerjaanById($id);

        if($subPekerjaan) {
            return response([
                'success' => true,
                'message' => 'SubPekerjaan '. $id,
                'data' => $subPekerjaan
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'SubPekerjaan with id '. $id . ' not found',
			], 401);
        }
    }

    public function update(Request $request) {
        $subPekerjaan = $this->subPekerjaanRepository->updateSubPekerjaan($request);

        if($subPekerjaan) {
            return response([
                'success' => true,
                'message' => 'Item berhasil diupdate',
                'data' => $subPekerjaan
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Item gagal diupdate',
			], 401);
        }
    }

    public function destroy($id) {
        $subPekerjaan = $this->subPekerjaanRepository->deleteSubPekerjaan($id);

        if($subPekerjaan) {
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

    public function getSubmittedSubPekerjaan($id){
        $data = array();
            $subPekerjaans = $this->subPekerjaanRepository->getSubmitSubPekerjaan($id);
            foreach($subPekerjaans as $subPekerjaan) {
                $data[] = $subPekerjaan;
            }
        return response([
            'success' => true,
            'message' => 'List SubPekerjaan submit',
            'data' => $data
        ], 200);
    }

    public function getRejectedSubPekerjaan($id){
        $data = array();
            $subPekerjaans = $this->subPekerjaanRepository->getRejectSubPekerjaan($id);
            foreach($subPekerjaans as $subPekerjaan) {
                $data[] = $subPekerjaan;
            }
        return response([
            'success' => true,
            'message' => 'List SubPekerjaan reject',
            'data' => $data
        ], 200);
    }

    public function getValidSubPekerjaan($id){
        $data = array();
            $subPekerjaans = $this->subPekerjaanRepository->getValidSubPekerjaan($id);
            foreach($subPekerjaans as $subPekerjaan) {
                $data[] = $subPekerjaan;
            }


        return response([
            'success' => true,
            'message' => 'List SubPekerjaan valid',
            'data' => $data
        ], 200);
    }

    public function getSubmittedSubPekerjaanByIdPengguna($id) {
        $data = array();
        $pekerjaans = $this->pekerjaanRepository->getPekerjaanByIdUser($id);
        foreach($pekerjaans as $pekerjaan) {
            $subPekerjaans = $this->subPekerjaanRepository->getSubmitSubPekerjaan($pekerjaan->id);
            foreach($subPekerjaans as $subPekerjaan) {
                $data[] = $subPekerjaan;
            }
        }
        return response([
            'success' => true,
            'message' => 'List SubPekerjaan submit',
            'data' => $data
        ], 200);
    }

    public function getValidSubPekerjaanCount($id){
        $data = 0;
        $pekerjaans = $this->pekerjaanRepository->getPekerjaanByIdUser($id);
        foreach($pekerjaans as &$pekerjaan) {
            $subPekerjaans = $this->subPekerjaanRepository->getValidSubPekerjaanCount($pekerjaan->id);
            $data += $subPekerjaans;
        }

        return response([
            'success' => true,
            'message' => 'List SubPekerjaan valid',
            'data' => $data
        ], 200);
    }

    public function getDataTotalDurasiByTanggal($dateFrom, $dateTo) {
        $tanggal = $this->subPekerjaanRepository->getDataTotalDurasiByTanggal($dateFrom, $dateTo);
        return response([
            'success' => true,
            'message' => 'tanggal',
            'data' => $tanggal
        ], 200);
    }
}
