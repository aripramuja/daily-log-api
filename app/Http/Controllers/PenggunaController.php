<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use App\Repositories\PenggunaRepository;

class PenggunaController extends Controller
{
    protected PenggunaRepository $penggunaRepository;

    public function __construct(PenggunaRepository $penggunaRepository)
    {
        $this->penggunaRepository = $penggunaRepository;
    }

    public function index() {
        $penggunas = $this->penggunaRepository->getAllPengguna();

        return response([
            'success' => true,
            'message' => 'List pengguna',
            'data' => $penggunas
        ], 200);
    }

    public function store(Request $request) {
        $pengguna = $this->penggunaRepository->createPengguna($request);

        if($pengguna) {
            return response([
                'success' => true,
                'message' => 'Item berhasil disimpan',
                'data' => $pengguna
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Item gagal disimpan',
			], 401);
        }
    }

    public function show($id) {
        $pengguna = $this->penggunaRepository->getPenggunaById($id);

        if($pengguna) {
            return response([
                'success' => true,
                'message' => 'pengguna '. $id,
                'data' => $pengguna
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'pengguna with id '. $id . ' not found',
			], 401);
        }
    }

    public function update(Request $request) {
        $pengguna = $this->penggunaRepository->updatePengguna($request);

        if($pengguna) {
            return response([
                'success' => true,
                'message' => 'Item berhasil diupdate',
                'data' => $pengguna
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Item gagal diupdate',
			], 401);
        }
    }

    public function destroy($id) {
        $pengguna = $this->penggunaRepository->deletePengguna($id);

        if($pengguna) {
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

    public function login(Request $request) {
      $pengguna = $this->penggunaRepository->getPenggunaByUsername($request->username);

      if($pengguna) {
          if($pengguna->password == $request->password) {
            $pengguna->password = "";
            return response([
                'success' => true,
                'message' => 'Login berhasil',
                'data' => $pengguna
            ],200);
          } else {
            return response([
                'success' => false,
                'message' => 'Password salah',
            ],200);
          }
      } else {
        return response([
            'success' => false,
            'message' => 'username tidak ditemukan',
        ], 401);
      }
    }

    public function getPenggunaStaff($id_position) {
        $data = array();
        $penggunas = $this->penggunaRepository->getPenggunaStaff($id_position);


        if($data) {
            return response([
                'success' => true,
                'message' => 'List Staff',
                'data' => $data
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'No staff data',
			], 401);
        }
    }

    public function getPenggunaByIdPosition($id_position) {
        $pengguna = $this->penggunaRepository->getPenggunaByPositionId($id_position);

        if($pengguna) {
            return response([
                'success' => true,
                'message' => 'pengguna with position'. $id_position,
                'data' => $pengguna
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'pengguna with id position '. $id_position . ' not found',
			], 401);
        }
    }
}
