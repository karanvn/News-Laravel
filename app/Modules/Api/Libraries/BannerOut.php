<?php

namespace App\Modules\Api\Libraries;

class BannerOut
{

    function __construct()
    {
        $this->statuses = get_api_statuses();
    }

    public function banners($banners, $filter = []) {
        if(count($banners) > 0){
            $result = [];
            foreach($banners as $banner){
                $result[] = $this->form_banner($banner);
            }

            return [
                'success' => true,
                'data' => $result
            ];
        }else{
            return [
                'success' => false,
                'msg' => trans('Api::api.banner.msg.empty')
            ];
        }
    }

    public function form_banner($banner){
        return [
            'id' => $banner->id,
            'name' => $banner->name,
            'type' => $banner->type,
            'link' => $banner->link,
            'position' => $banner->position,
            'extension' => $banner->extension,
            'avatar' => url('').'/'.show_image(config('banner.image.org_path'), $banner->avatar)
        ];
    }
}
