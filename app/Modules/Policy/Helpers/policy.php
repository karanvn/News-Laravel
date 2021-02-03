<?php

if (!function_exists('get_policy_statuses')) {

    function get_policy_statuses()
    {
        return [
            '0' => trans('Policy::policy.statuses.0'),
            '1' => trans('Policy::policy.statuses.1')
        ];
    }
}

if (!function_exists('get_policy_path_image')) {

    function get_policy_path_image()
    {
        return config('policy.image.thumb');
    }
}

if (!function_exists('get_policy_filters')) {

    function get_policy_filters($filters = [])
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


