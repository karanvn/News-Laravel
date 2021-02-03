<?php


if (!function_exists('get_location_statuses')) {

    function get_location_statuses()
    {
        return trans('Location::state.statuses');
    }
}

if (!function_exists('get_location_filters')) {

    function get_location_filters($filters = [])
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



