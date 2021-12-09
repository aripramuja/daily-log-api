<?php

namespace App\Http\Controllers;

use App\Repositories\SettingRepository;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected SettingRepository $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function index() {
        $setting = $this->settingRepository->getAllSetting();

        return response([
            'success' => true,
            'message' => 'Setting',
            'data' => $setting[0]->backdate
        ], 200);
    }
}
