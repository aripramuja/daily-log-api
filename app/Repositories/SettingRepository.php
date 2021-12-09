<?php
namespace App\Repositories;

use App\Models\Setting;

class SettingRepository{
    public function getAllSetting() {
        return Setting::all();
    }
}
