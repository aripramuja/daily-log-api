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

    public function getDataPresenceTim($id_position ,$dateFrom, $dateTo) {
        $presences = $this->presenceRepository->getDataPresenceByTanggal($dateFrom, $dateTo);
        $num_staff = $this->penggunaRepository->getPenggunaStaff($id_position)->count();

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
