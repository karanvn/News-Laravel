<?php

namespace App\Modules\Setting\Libraries;

use App\Modules\Setting\Models\Setting;

class SettingLib
{
    function __construct()
    {
        $this->setting = new Setting();
    }

    public function getSetting($type)
    {
        $setting = $this->setting->get_type_setting($type);
        if($setting){
            return unserialize($setting->data);
        }
        return [];
    }
}
