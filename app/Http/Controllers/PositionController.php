<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PositionRepository;

class PositionController extends Controller
{
    protected PositionRepository $positionRepository;

    public function __construct(PositionRepository $positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }
    public function index() {
        $Positions = $this->positionRepository->getAllPosition();

        return response([
            'success' => true,
            'message' => 'List Position',
            'data' => $Positions
        ], 200);
    }

    public function store(Request $request) {
        foreach($request->json()->all() as $data) {
           // dd($data);
            $Position = $this->positionRepository->createPosition($data);
        }

        if($Position) {
            return response([
                'success' => true,
                'message' => 'Item berhasil disimpan',
                'data' => $Position
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Item gagal disimpan',
			], 401);
        }
    }

    public function show($id) {
        $Position = $this->positionRepository->getPositionById($id);

        if($Position) {
            return response([
                'success' => true,
                'message' => 'Position '. $id,
                'data' => $Position
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Position with id '. $id . ' not found',
			], 401);
        }
    }

    public function update(Request $request) {
        $Position = $this->positionRepository->updatePosition($request);

        if($Position) {
            return response([
                'success' => true,
                'message' => 'Item berhasil diupdate',
                'data' => $Position
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Item gagal diupdate',
			], 401);
        }
    }

    public function destroy($id) {
        $Position = $this->positionRepository->deletePosition($id);

        if($Position) {
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
