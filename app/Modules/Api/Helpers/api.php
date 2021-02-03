<?php

if (!function_exists('get_api_statuses')) {

    function get_api_statuses()
    {
        return trans('Api::api.statuses');
    }
}

if (!function_exists('get_api_genders')) {

    function get_api_genders()
    {
        return trans('Api::api.genders');
    }
}

if (!function_exists('get_api_users')) {

    function get_api_users($type)
    {
        return trans('Api::api.'.$type.'.filters');
    }
}



