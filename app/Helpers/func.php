<?php

if (!function_exists('json_en')) {

    function json_en($inputs)
    {
        header('Content-Type: application/json');
        echo json_encode($inputs, JSON_UNESCAPED_UNICODE);
        exit;
    }
}


if (!function_exists('show_image')) {

	function show_image($path, $image, $no_image_path = "")
	{
		if(!empty($image) && file_exists($path . '/' . $image)){
			return $path . '/' . $image;
		}
		else{
			return !empty($no_image_path) ? $no_image_path : 'admin/assets/media/users/blank.png';
		}
	}
}

if (!function_exists('split_description_blog')) {

	function split_description_blog($description, $position, $word_count)
	{
        if(!empty($description)){
            $description = explode(" ", $description);
            $arr         = array_slice($description, $position, $word_count);
            $result      = implode(' ', $arr);
        }else{
            return $result = '';
        }
        return $result;
	}
}

if (!function_exists('show_image_blog')) {

    function show_image_blog($path, $image)
    {
        if(!empty($image) && file_exists($path . '/' . $image)){
            return $path . '/' . $image;
        }
        else{
            return 'admin/assets/media/products/no_product.svg';
        }
    }
}


if (!function_exists('show_banner')) {

    function show_banner($path, $image)
    {
        if(!empty($image) && file_exists($path . '/' . $image)){
            return $path . '/' . $image;
        }else{
            return 'admin/assets/media/avatars/blank.png';
        }
    }
}

if (!function_exists('fm_zeros')) {

    function fm_zeros($number, $zero = 8)
    {
        return sprintf("%0{$zero}d", $number);
    }
}

if (!function_exists('uppercase_of_word')) {

    function uppercase_of_word($string)
    {
        $words = explode(" ", $string);
        $letters = "";
        foreach ($words as $value) {
            $letters .= mb_substr($value, 0, 1);
        }
        return $letters;
    }
}

if (!function_exists('get_client_ip')) {

    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}

if (!function_exists('get_filters')) {

    function get_filters($filters = [])
    {
        $url = '';
        $key = 'page';
        if(!empty($filters) && $key != 'page'){
            foreach($filters as $key => $value){
                if(!empty($value))
                    $url.= '&'.$key.'='.$value;
            }
        }
        return $url;

    }
}
