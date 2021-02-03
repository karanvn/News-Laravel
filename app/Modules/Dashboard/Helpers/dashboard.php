<?php


if (!function_exists('get_period_filters')) {

    function get_period_filters()
    {
        return trans('Dashboard::dashboard.filters');
    }
}

if (!function_exists('get_label_times')) {

    function get_label_times()
    {
        return trans('Dashboard::dashboard.times');
    }
}

if (!function_exists('get_time_keys')) {

    function get_time_keys()
    {
        return trans('Dashboard::dashboard.keys');
    }
}

if (!function_exists('get_days')) {

    function get_days($start, $end)
    {
        $date1 = strtotime($start);
        $date2 = strtotime($end);
        return ($date2 - $date1) / (24 * 60 * 60);
    }
}

if (!function_exists('get_dates')) {

    function get_dates($first, $last, $step = '+1 day', $output_format = 'd-m-Y')
    {
        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);

        while( $current <= $last ) {
            $dates[] = date($output_format, $current);
            $current = strtotime($step, $current);
        }

        return $dates;
    }
}


if (!function_exists('get_times')) {

    function get_times($filter = 'TODAY', $full = true)
    {
        $start = 0;
        $end = 0;
        switch($filter){
            case 'TODAY':
                $start = $end = date('Y-m-d', time());
            break;

            case 'YESTERDAY':
                $start = $end = date('Y-m-d', time()-86400);
            break;

            case 'THISWEEK':
                $start = date('Y-m-d',strtotime("Monday This Week"));
                $end = date('Y-m-d',strtotime("Sunday This Week"));
            break;

            case 'THISMONTH':
                $start = date('Y-m-01');
                $end = date('Y-m-t');
            break;

            default:
                $start = $end = '1990-01-01';
        }

        $params['start'] = $full ? $start.' 00:00:01' : $start;
        $params['end'] = $full ? $end.' 23:59:59' : $end;

        return $params;
    }
}

