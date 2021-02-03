<?php


if (!function_exists('get_mail_statuses')) {

    function get_mail_statuses()
    {
        return trans('Mail::mail.statuses');
    }
}

if (!function_exists('get_block_positions')) {

    function get_block_positions()
    {
        return trans('Mail::mail.positions');
    }
}

if (!function_exists('get_block_shows')) {

    function get_block_shows()
    {
        return trans('Mail::mail.shows');
    }
}

if (!function_exists('get_tpl_types')) {

    function get_tpl_types()
    {
        return trans('Mail::mail.tpl.types');
    }
}


if (!function_exists('get_path_html')) {

    function get_path_html()
    {
        return config('mail.html');
    }
}


