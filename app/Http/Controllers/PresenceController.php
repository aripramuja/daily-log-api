<?php

namespace App\Http\Controllers;

use App\Repositories\PenggunaRepository;
use Illuminate\Http\Request;
use App\Repositories\PresenceRepository;

class PresenceController extends Controller
{

    protected PresenceRepository $presenceRepository;
    protected PenggunaRepository $penggunaRepository;

    public function __construct(PresenceRepository $presenceRepository, PenggunaRepository $penggunaRepository)
    {
        $this->presenceRepository = $presenceRepository;
        $this->penggunaRepository = $penggunaRepository;
    }

    public function index() {
        $presences = $this->presenceRepository->getAllPresence();

        return response([
            'success' => true,
            'message' => 'List presence',
            'data' => $presences
        ], 200);
    }

    public function store(Request $request) {
        $presence = $this->presenceRepository->createPresence($request);

        if($presence) {
            return response([
                'success' => true,
                'message' => 'Item berhasil disimpan',
                'data' => $presence
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Item gagal disimpan',
			], 401);
        }
    }

    public function show($id) {
        $presence = $this->presenceRepository->getPresenceById($id);

        if($presence) {
            return response([
                'success' => true,
                'message' => 'presence '. $id,
                'data' => $presence
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'presence with id '. $id . ' not found',
			], 401);
        }
    }

    public function update(Request $request) {
        $presence = $this->presenceRepository->updatePresence($request);

        if($presence) {
            return response([
                'success' => true,
                'message' => 'Item berhasil diupdate',
                'data' => $presence
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Item gagal diupdate',
			], 401);
        }
    }

    public function destroy($id) {
        $presence = $this->presenceRepository->deletePresence($id);

        if($presence) {
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

    public function getTodayPresenceByIdUser($id_user, $date) {
        $presence = $this->presenceRepository->getPresenceTodayByUserId($id_user, $date);

        if($presence) {
            return response([
                'success' => true,
                'message' => 'presence '. $id_user . ' at '. $date,
                'data' => $presence
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'presence with id '. $id_user . ' not found',
			], 401);
        }
    }

    public function getDataPresenceTim($id_user ,$dateFrom, $dateTo) {
        $num_staff = $this->penggunaRepository->getListStaff($id_user)->count();
        $tims = $this->penggunaRepository->getListStaff($id_user);
        $id_tim = array();
        foreach($tims as $tim) {
            $id_tim[] = $tim->id;
        }
        $presences = $this->presenceRepository->getDataPresenceTimByTanggal($id_tim ,$dateFrom, $dateTo);

        foreach($presences as $presence) {
            $presence['tidak_hadir'] = $num_staff - $presence['hadir'];
        }

        if($presences) {
            return response([
                'success' => true,
                'message' => 'presence '. $dateFrom . ' to '. $dateTo,
                'data' => $presences
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'not found',
			], 401);
        }
    }

    public function getPresenceUserByTanggal($id_user, $dateFrom, $dateTo) {
        $presence = $this->presenceRepository->getPresenceUserByTanggal($id_user, $dateFrom, $dateTo);

        if($presence) {
            return response([
                'success' => true,
                'message' => 'presence '. $id_user . ' from '. $dateFrom . ' to '. $dateTo,
                'data' => $presence
            ],200);
        }
    }

    public function getDataPresenceTimStaff($id_user ,$dateFrom, $dateTo) {
        $num_staff = $this->penggunaRepository->getListStaff($id_user)->count() + 1;
        $tims = $this->penggunaRepository->getListStaff($id_user);
        $id_tim = array();
        $id_tim[] = $id_user;
        foreach($tims as $tim) {
            $id_tim[] = $tim->id;
        }
        $presences = $this->presenceRepository->getDataPresenceTimByTanggal($id_tim ,$dateFrom, $dateTo);

        foreach($presences as $presence) {
            $presence['tidak_hadir'] = $num_staff - $presence['hadir'];
        }

        if($presences) {
            return response([
                'success' => true,
                'message' => 'presence '. $dateFrom . ' to '. $dateTo,
                'data' => $presences
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'not found',
			], 401);
        }
    }
}
