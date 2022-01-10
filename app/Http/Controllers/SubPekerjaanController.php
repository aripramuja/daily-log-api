<?php

namespace App\Http\Controllers;

use App\Exports\KinerjaExport;
use App\Repositories\PekerjaanRepository;
use App\Repositories\PenggunaRepository;
use App\Repositories\SubPekerjaanRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SubPekerjaanController extends Controller
{
    protected SubPekerjaanRepository $subPekerjaanRepository;
    protected PekerjaanRepository $pekerjaanRepository;
    protected PenggunaRepository $penggunaRepository;

    public function __construct(
        SubPekerjaanRepository $subPekerjaanRepository,
        PekerjaanRepository $pekerjaanRepository,
        PenggunaRepository $penggunaRepository
    ){
        $this->subPekerjaanRepository = $subPekerjaanRepository;
        $this->pekerjaanRepository = $pekerjaanRepository;
        $this->penggunaRepository = $penggunaRepository;
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

    public function getValidSubPekerjaanCount($id, $dateFrom, $dateTo){
        $data = 0;
        $pekerjaans = $this->pekerjaanRepository->getPekerjaanByIdUser($id);
        foreach($pekerjaans as &$pekerjaan) {
            $subPekerjaans = $this->subPekerjaanRepository->getValidSubPekerjaanCountByTanggsl($pekerjaan->id, $dateFrom, $dateTo);
            $data += $subPekerjaans;
        }

        return response([
            'success' => true,
            'message' => 'List SubPekerjaan valid',
            'data' => $data
        ], 200);
    }

    public function getDataTotalDurasiByTanggal($idPengguna, $dateFrom, $dateTo) {
        $tanggal = $this->subPekerjaanRepository->getDataTotalDurasiByTanggal($idPengguna, $dateFrom, $dateTo);
        return response([
            'success' => true,
            'message' => 'tanggal',
            'data' => $tanggal
        ], 200);
    }

    public function getDataTotalDurasiTimByTanggal($idUser, $dateFrom, $dateTo) {
        $id_tim = array();
        $tims = $this->penggunaRepository->getListStaff($idUser);
        foreach($tims as $tim) {
            $id_tim[] = $tim->id;
        }
        $dateTo = $dateTo . ' 23:59:59';
        $tanggal = $this->subPekerjaanRepository->getDataTotalDurasiTimByTanggal($id_tim, $dateFrom, $dateTo);
        return response([
            'success' => true,
            'message' => 'tanggal',
            'data' => $tanggal
        ], 200);
    }

    public function getDataTotalDurasiTim1Hari($idUser, $dateFrom, $dateTo) {
        $id_tim = array();
        $tims = $this->penggunaRepository->getListStaff($idUser);
        foreach($tims as $tim) {
            $id_tim[] = $tim->id;
        }
        $dateTo = $dateTo . ' 23:59:59';
        $tanggal = $this->subPekerjaanRepository->getDataTotalDurasiTim1Hari($id_tim, $dateFrom, $dateTo);
        return response([
            'success' => true,
            'message' => 'tanggal',
            'data' => $tanggal
        ], 200);
    }

    public function getSubmittedPersetujuan($idUser) {
        $data = array();
        $pekerjaans = $this->pekerjaanRepository->getPekerjaanByIdUser($idUser);
        foreach($pekerjaans as $pekerjaan) {
            $subPekerjaans = $this->subPekerjaanRepository->getSubmitSubPekerjaan($pekerjaan->id);
            if($subPekerjaans->count() > 0 ) {
                $pekerjaan['subPekerjaan'] = $subPekerjaans;
                $data[] = $pekerjaan;
            }
        }
        return response([
            'success' => true,
            'message' => 'List SubPekerjaan submit',
            'data' => $data
        ], 200);
    }

    public function getRejectedPersetujuan($idUser) {
        $data = array();
        $pekerjaans = $this->pekerjaanRepository->getPekerjaanByIdUser($idUser);
        foreach($pekerjaans as $pekerjaan) {
            $subPekerjaans = $this->subPekerjaanRepository->getRejectSubPekerjaan($pekerjaan->id);
            if($subPekerjaans->count() > 0 ) {
                $pekerjaan['subPekerjaan'] = $subPekerjaans;
                $data[] = $pekerjaan;
            }
        }
        return response([
            'success' => true,
            'message' => 'List SubPekerjaan reject',
            'data' => $data
        ], 200);
    }

    public function getDataTotalDurasiTimStaffByTanggal($idPosition, $idPengguna, $dateFrom, $dateTo) {
        $id_tim = array();
        $id_tim[] = $idPengguna;
        $tims = $this->penggunaRepository->getListStaff($idPengguna);
        foreach($tims as $tim) {
            $id_tim[] = $tim->id;
        }
        $dateTo = $dateTo . ' 23:59:59';
        $tanggal = $this->subPekerjaanRepository->getDataTotalDurasiTimByTanggal($id_tim, $dateFrom, $dateTo);
        return response([
            'success' => true,
            'message' => 'tanggal',
            'data' => $tanggal
        ], 200);
    }

    public function getDataTotalDurasiTimStaff1Hari($idPosition, $idPengguna, $dateFrom, $dateTo) {
        $id_tim = array();
        $id_tim[] = $idPengguna;
        $tims = $this->penggunaRepository->getListStaff($idPengguna);
        foreach($tims as $tim) {
            $id_tim[] = $tim->id;
        }
        $dateTo = $dateTo . ' 23:59:59';
        $tanggal = $this->subPekerjaanRepository->getDataTotalDurasiTim1Hari($id_tim, $dateFrom, $dateTo);
        return response([
            'success' => true,
            'message' => 'tanggal',
            'data' => $tanggal
        ], 200);
    }

    public function getValidPersetujuan($idUser, $dateFrom, $dateTo) {
        $data = array();
        $pekerjaans = $this->pekerjaanRepository->getPekerjaanByIdUser($idUser);
        foreach($pekerjaans as $pekerjaan) {
            $subPekerjaans = $this->subPekerjaanRepository->getValidSubPekerjaanByTanggal($pekerjaan->id, $dateFrom, $dateTo);
            if($subPekerjaans->count() > 0 ) {
                $pekerjaan['subPekerjaan'] = $subPekerjaans;
                $data[] = $pekerjaan;
            }
        }
        return response([
            'success' => true,
            'message' => 'List SubPekerjaan valid',
            'data' => $data
        ], 200);
    }

    public function getDataTotalDurasiAllTimStaffByTanggal($idPengguna, $dateFrom, $dateTo) {
        $id_tim = array();
        $id_tim[] = $idPengguna;
        $tims = $this->penggunaRepository->getAllPenggunaChild($idPengguna);
        foreach($tims as $tim) {
            $id_tim[] = $tim->id;
        }
        $dateTo = $dateTo . ' 23:59:59';
        $tanggal = $this->subPekerjaanRepository->getDataTotalDurasiTimByTanggal($id_tim, $dateFrom, $dateTo);

        return response([
            'success' => true,
            'message' => 'tanggal',
            'data' => $tanggal
        ], 200);
    }

    public function getDataTotalDurasiAllTimStaff1Hari($idPengguna, $dateFrom, $dateTo) {
        $id_tim = array();
        $id_tim[] = $idPengguna;
        $tims = $this->penggunaRepository->getAllPenggunaChild($idPengguna);
        foreach($tims as $tim) {
            $id_tim[] = $tim->id;
        }
        $dateTo = $dateTo . ' 23:59:59';
        $tanggal = $this->subPekerjaanRepository->getDataTotalDurasiTim1Hari($id_tim, $dateFrom, $dateTo);
        return response([
            'success' => true,
            'message' => 'tanggal',
            'data' => $tanggal
        ], 200);
    }

    public function exportToExcel($idUser, $dateFrom, $dateTo) {
        $data = array();
        $pekerjaans = $this->pekerjaanRepository->getPekerjaanByIdUser($idUser);
        foreach($pekerjaans as $pekerjaan) {
            $subPekerjaans = $this->subPekerjaanRepository->getValidSubPekerjaanByTanggal($pekerjaan->id, $dateFrom, $dateTo);
            if($subPekerjaans->count() > 0 ) {
                $pekerjaan['subPekerjaan'] = $subPekerjaans;
                $data[] = $pekerjaan;
            }
        }
        return Excel::download(new KinerjaExport($data), 'tesExcel.xlsx');
    }

    public function getSumDurasiPekerjaanStaff($idPengguna, $dateFrom, $dateTo) {
        $id_tim = array();
        $tims = $this->penggunaRepository->getListStaff($idPengguna);
        foreach($tims as $tim) {
            $id_tim[] = $tim->id;
        }
        $subPekerjaan = $this->subPekerjaanRepository->getSumDurasiPekerjaanStaff($id_tim, $dateFrom, $dateTo);
        return response([
            'success' => true,
            'message' => 'tanggal',
            'data' => $subPekerjaan
        ], 200);
    }
}
