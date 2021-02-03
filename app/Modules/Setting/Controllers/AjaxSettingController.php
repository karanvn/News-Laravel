<?php


namespace App\Modules\Setting\Controllers;

use App\Http\Controllers\SiteController;
use App\Modules\Setting\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Libraries\Upload;


class AjaxSettingController extends SiteController
{
    function __construct()
    {
        $this->setting = new Setting();
    }

    function processGeneral(Request $request) {
        $inputs = $request->except(['_token', 'image']);
        $upload = new Upload();
        $hasFile = $request->hasFile('image') ? true : false;

        foreach($inputs as $type => $input){
            $item    = $this->setting->get_type_setting($type);
            $setting = !empty($item) ? $item : new Setting();
            $setting->type = $type;
            $setting->data = serialize($input);
            $setting->save(); 
        }
        
        if ($hasFile) {
            $file          = $request->image;
            // $image_path    = get_setting_path_image();
            $image_path    = '/Logo';
            // dd($image_path);
            $setting->type = 'LOGO';
            $item    = $this->setting->get_type_setting('LOGO');
            $setting = !empty($item) ? $item : new Setting();
            // dd($setting);
            $setting->data = serialize($upload->doUploadLogo($image_path, $file, '', [250, 250]));
            // dd($setting->type);
            $setting->save();
        }

        return response()->json([
            'success' => true,
            'toastr' => trans('Setting::setting.toastr_success'),
        ]);
    }
}
