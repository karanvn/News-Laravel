<?php


if (!function_exists('get_user_statuses')) {

    function get_user_statuses()
    {
        return trans('Auth::admin.statuses');
    }
}

if (!function_exists('get_user_genders')) {

    function get_user_genders()
    {
        return trans('Auth::admin.genders');
    }
}

if (!function_exists('get_auth_filters')) {

    function get_auth_filters($filters = [])
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
