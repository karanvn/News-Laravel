<?php

if (!function_exists('get_rule_statuses')) {

    function get_rule_statuses()
    {
        return trans('Rule::rule.statuses');
    }
}

if (!function_exists('get_rule_filters')) {

    function get_rule_filters($filters = [])
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


