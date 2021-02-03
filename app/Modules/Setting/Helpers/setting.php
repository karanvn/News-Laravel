<?php

if (!function_exists('get_setting_statuses')) {

    function get_setting_statuses()
    {
        return [
            '0' => trans('Setting::setting.statuses.0'),
            '1' => trans('Setting::setting.statuses.1')
        ];
    }
}

if (!function_exists('get_setting_path_image')) {

    function get_setting_path_image()
    {
        return config('setting.image.thumb_path');
    }
}

if (!function_exists('get_setting_filters')) {

    function get_setting_filters($filters = [])
    {
        $url = '';
        if(!empty($filters)){
            foreach($filters as $key => $value){
                if(!empty($value))
                    $url.= '&'.$key.'='.$value;
            }
        }
        return $url;

    }
}


