<?php


if (!function_exists('get_page_static_statuses')) {

    function get_page_static_statuses()
    {
        return trans('PageStatic::page_static.statuses');
    }
}


if (!function_exists('get_page_static_types')) {

    function get_page_static_types()
    {
        return trans('PageStatic::page_static.types');
    }
}

if (!function_exists('get_page_static_extensions')) {

    function get_page_static_extensions()
    {
        return trans('PageStatic::page_static.extensions');
    }
}

if (!function_exists('get_page_static_sorts')) {

    function get_page_static_sorts()
    {
        return trans('PageStatic::page_static.sorts');
    }
}

if (!function_exists('get_page_static_published_labels')) {

    function get_page_static_published_labels()
    {
        return trans('PageStatic::page_static.published');
    }
}


// if (!function_exists('get_page_static_published')) {

//     function get_page_static_published($start, $end)
//     {
//         $current = time();
//         $status = [];
//         $start = strtotime($start);
//         $end = strtotime($end);

//         if($current >= $start && $current <= $end){
//             $status['A'] = trans('PageStatic::page_static.published.A');
//         }elseif($current < $start){
//             $status['H'] = trans('PageStatic::page_static.published.H');
//         }elseif($current > $end){
//             $status['E'] = trans('PageStatic::page_static.published.E');
//         }
//         return $status;
//     }
// }

if (!function_exists('get_page_static_filters')) {

    function get_page_static_filters($filters = [])
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

if (!function_exists('get_page_static_path_image')) {

    function get_page_static_path_image()
    {
        return config('page_static.image.org');
    }
}

if (!function_exists('get_page_static_module')) {

    function get_page_static_module()
    {
        return config('page_static.module.page_static');
    }
}

if (!function_exists('get_path_page_static_html')) {

    function get_path_page_static_html()
    {
        return config('page_static.html');
    }
}


