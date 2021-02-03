<?php


if (!function_exists('get_branch_statuses')) {

    function get_branch_statuses()
    {
        return [
            'D' => trans('Branch::branch.statuses.D'),
            'A' => trans('Branch::branch.statuses.A')
        ];
    }
}

if (!function_exists('get_branch_path_image')) {

    function get_branch_path_image()
    {
        return config('branch.image.thumb');
    }
}

if (!function_exists('get_branch_filters')) {

    function get_branch_filters($filters = [])
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


