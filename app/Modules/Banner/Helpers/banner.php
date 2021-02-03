<?php


if (!function_exists('get_banner_statuses')) {

    function get_banner_statuses()
    {
        return trans('Banner::banner.statuses');
    }
}


if (!function_exists('get_banner_types')) {

    function get_banner_types()
    {
        return trans('Banner::banner.types');
    }
}

if (!function_exists('get_banner_extensions')) {

    function get_banner_extensions()
    {
        return trans('Banner::banner.extensions');
    }
}

if (!function_exists('get_banner_sorts')) {

    function get_banner_sorts()
    {
        return trans('Banner::banner.sorts');
    }
}

if (!function_exists('get_banner_published_labels')) {

    function get_banner_published_labels()
    {
        return trans('Banner::banner.published');
    }
}


if (!function_exists('get_banner_published')) {

    function get_banner_published($start, $end)
    {
        $current = time();
        $status = [];
        $start = strtotime($start);
        $end = strtotime($end);

        if($current >= $start && $current <= $end){
            $status['A'] = trans('Banner::banner.published.A');
        }elseif($current < $start){
            $status['H'] = trans('Banner::banner.published.H');
        }elseif($current > $end){
            $status['E'] = trans('Banner::banner.published.E');
        }
        return $status;
    }
}

if (!function_exists('get_banner_path_image')) {

    function get_banner_path_image()
    {
        return config('banner.image.org');
    }
}

if (!function_exists('get_banner_filters')) {

    function get_banner_filters($filters = [])
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
if (!function_exists('get_image_banner_webp')) {

    function get_image_banner_webp($img)
    {
       if(empty($img)){
            return 'admin/assets/media/products/no_product.svg';
       }
        $strrposImg = strrpos($img,'.');
        $nameImg = substr($img, 0, $strrposImg).'.webp';
        $source_path = config('banner.image.org').'/';
      
        $URL = 'storage/'.$source_path.''. $nameImg;
        if(file_exists($URL)=='1'){
            return $URL;
        }else{
            $URL = 'storage/'.$source_path.''. $img;
            return $URL;
        }
        
    }
}
if (!function_exists('get_image_blog_webp')) {

    function get_image_blog_webp($img)
    {
       if(empty($img)){
            return 'admin/assets/media/products/no_product.svg';
       }
        $strrposImg = strrpos($img,'.');
        $nameImg = substr($img, 0, $strrposImg).'.webp';
        $source_path = 'editor/blog/';
      
        $URL = 'storage/'.$source_path.''. $nameImg;
        if(file_exists($URL)=='1'){
            return $URL;
        }else{
            $URL = 'storage/'.$source_path.''. $img;
            if(file_exists($URL)=='1'){
                return $URL;
            }else{
                return 'admin/assets/media/products/no_product.svg';
            }
        }
        
        return $URL;
        
    }
}



