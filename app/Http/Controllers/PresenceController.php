<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PresenceRepository;

class PresenceController extends Controller
{

    protected PresenceRepository $presenceRepository;

    public function __construct(PresenceRepository $presenceRepository)
    {
        $this->presenceRepository = $presenceRepository;
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
}
