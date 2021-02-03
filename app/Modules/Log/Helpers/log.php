<?php


if (!function_exists('get_log_statuses')) {

    function get_log_statuses()
    {
        return trans('Log::log.statuses');
    }
}

if (!function_exists('get_log_genders')) {

    function get_log_genders()
    {
        return trans('Log::log.genders');
    }
}

if (!function_exists('get_log_order_statuses')) {

    function get_log_order_statuses()
    {
        return trans('Log::log.order_statuses');
    }
}

if (!function_exists('get_log_types')) {

    function get_log_types()
    {
        return trans('Log::log.types');
    }
}

if (!function_exists('get_log_classes')) {

    function get_log_classes()
    {
        return trans('Log::log.classes');
    }
}

if (!function_exists('get_log_objects')) {

    function get_log_objects($log)
    {
        $type = $log->type;
        $object_id = $log->object_id;
        $sub_id = @$log->sub_id;
        $results = [];
        if(!empty($type) && !empty($object_id)){
            switch($type){
                case 'ORDER':
                    $results['route'] = route('OrderEdit', [$object_id.'#tab-history']);
                    $results['title'] = ' #ĐH'.fm_zeros($object_id, 6);
                break;

                case 'PRODUCT':
                    $results['route'] = route('ProductEdit', [$object_id.'#tab-history']);
                    $results['title'] = fm_zeros(!empty($sub_id) ? $sub_id : $object_id, 6);
                break;

                case 'CATEGORY':
                    $results['route'] = route('ProductCategoryEdit', [$object_id]);
                    $results['title'] = fm_zeros($object_id, 6);
                break;

                case 'BRANCH':
                    $results['route'] = route('BranchEdit', [$object_id]);
                    $results['title'] = fm_zeros($object_id, 6);
                break;
                
                case 'POLICY':
                    $results['route'] = route('PolicyEdit', [$object_id]);
                    $results['title'] = fm_zeros($object_id, 6);
                break;

                case 'FEATURE':
                    $results['route'] = route('ProductFeatureEdit', [$object_id]);
                    $results['title'] = fm_zeros($object_id, 6);
                break;

                case 'CUSTOMER':
                    $results['route'] = route('CustomerEdit', [$object_id, 'history']);
                    $results['title'] = fm_zeros($object_id, 6);
                break;

                case 'ADMIN':
                    $results['route'] = route('AdminEdit', [$object_id, 'history']);
                    $results['title'] = fm_zeros($object_id, 6);
                break;

                case 'BANNER':
                    $results['route'] = route('BannerEdit', [$object_id]);
                    $results['title'] = fm_zeros($object_id, 6);
                break;
            }
        }

        return $results;
    }
}

if (!function_exists('get_log_titles')) {

    function get_log_titles()
    {
        return trans('Log::log.titles');
    }
}
