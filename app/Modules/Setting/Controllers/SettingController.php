<?php


namespace App\Modules\Setting\Controllers;

use App\Http\Controllers\SiteController;
use App\Modules\Setting\Models\Setting;

class SettingController extends SiteController
{
    function __construct()
    {
        $this->setting = new Setting();
    }

    function index() {
        $settings = $this->setting->get_settings();
        $generals = [];
        if(count($settings) > 0){
            foreach($settings as $setting){
                $generals[$setting->type] = unserialize($setting->data);
            }
        }
        return view('Setting::general.index', ['generals' => $generals]);
    }
}
