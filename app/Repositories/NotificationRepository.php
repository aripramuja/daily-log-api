<?php
namespace App\Repositories;

use App\Models\Notification;
use Carbon\Carbon;

class NotificationRepository {
    public function getAllNotification() {
        return Notification::all();
    }

    public function getNotificationById($id) {
        return Notification::find($id);
    }

    public function createNotification($data) {
        return Notification::create([
           'receiver_id' => $data['receiver_id'],
           'sender' => $data['sender'],
           'subpekerjaan_id' => $data['subpekerjaan_id'],
           'is_read' => $data['is_read'],
           'date' => $data['date'],
           'status' => $data['status']
        ]);
    }

    public function updateNotification($data) {
        return Notification::find($data->id)->update([
           'receiver_id' => $data['receiver_id'],
           'sender' => $data['sender'],
           'subpekerjaan_id' => $data['subpekerjaan_id'],
           'is_read' => $data['is_read'],
           'date' => $data['date']
        ]);
    }

    public function deleteNotification($id) {
        return Notification::find($id)->delete();
    }

    public function getNotificationByReceiverId($id_user) {
        $date = Carbon::now("Asia/Jakarta")->format("Y-m-d");
        $lastDate = Carbon::now("Asia/Jakarta")->subDays(30)->format("Y-m-d");
        return Notification::join('sub_pekerjaan', 'sub_pekerjaan.id', '=', 'notification.subpekerjaan_id')->
            select('notification.id', 'receiver_id', 'sender', 'notification.subpekerjaan_id', 'sub_pekerjaan.nama', 'notification.status', 'sub_pekerjaan.id_pekerjaan', 'notification.date', 'notification.is_read')->
            where('notification.receiver_id', $id_user)->whereBetween('notification.date', [$lastDate, $date])->get();
    }

    public function updateNotificationRead($id) {
        return Notification::find($id)->update([
            'is_read' => 1,
        ]);
    }

    public function getCountReadNotificationByReceiverId($id_user) {
        return Notification::where('receiver_id', $id_user)->where('is_read', 0)->count();
    }
}
