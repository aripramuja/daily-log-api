<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\NotificationRepository;

class NotificationController extends Controller
{
    protected NotificationRepository $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }
    public function index() {
        $notifications = $this->notificationRepository->getAllNotification();

        return response([
            'success' => true,
            'message' => 'List notification',
            'data' => $notifications
        ], 200);
    }

    public function store(Request $request) {
        $notification = $this->notificationRepository->createNotification($request);

        if($notification) {
            return response([
                'success' => true,
                'message' => 'Item berhasil disimpan',
                'data' => $notification
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Item gagal disimpan',
			], 401);
        }
    }

    public function show($id) {
        $notification = $this->notificationRepository->getNotificationById($id);

        if($notification) {
            return response([
                'success' => true,
                'message' => 'notification '. $id,
                'data' => $notification
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'notification with id '. $id . ' not found',
			], 401);
        }
    }

    public function update(Request $request) {
        $notification = $this->notificationRepository->updateNotification($request);

        if($notification) {
            return response([
                'success' => true,
                'message' => 'Item berhasil diupdate',
                'data' => $notification
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Item gagal diupdate',
			], 401);
        }
    }

    public function destroy($id) {
        $notification = $this->notificationRepository->deleteNotification($id);

        if($notification) {
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

    public function getNotificationByReceiverId($id_user) {
        $notification = $this->notificationRepository->getNotificationByReceiverId($id_user);

        if($notification) {
            return response([
                'success' => true,
                'message' => 'List notification '. $id_user,
                'data' => $notification
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'notification with id '. $id_user . ' not found',
			], 401);
        }
    }

    public function updateNotificationRead($id) {
        $notification = $this->notificationRepository->updateNotificationRead($id);

        if($notification) {
            return response([
                'success' => true,
                'message' => 'Item berhasil diupdate',
                'data' => $notification
            ],200);
        } else {
            return response([
				'success' => false,
				'message' => 'Item gagal diupdate',
			], 401);
        }
    }
}
