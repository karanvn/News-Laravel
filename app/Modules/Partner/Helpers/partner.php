<?php


if (!function_exists('get_partner_statuses')) {

    function get_partner_statuses()
    {
        return trans('Partner::partner.statuses');
    }
}

if (!function_exists('get_partner_filters')) {

    function get_partner_filters($filters = [])
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

