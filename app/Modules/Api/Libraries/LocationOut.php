<?php

namespace App\Modules\Api\Libraries;

class LocationOut
{

    function __construct()
    {
        $this->statuses = get_api_statuses();
    }

    public function states($states) {
        if(count($states) > 0){
            $result = [];
            foreach($states as $state){
                $result[] = $this->form_state($state);
            }

            return [
                'success' => true,
                'data' => $result
            ];
        }else{
            return [
                'success' => false,
                'msg' => trans('Api::api.location.states.msg.empty')
            ];
        }
    }

    public function districts($districts) {
        if(count($districts) > 0){
            $result = [];
            foreach($districts as $district){
                $result[] = $this->form_district($district);
            }

            return [
                'success' => true,
                'data' => $result
            ];
        }else{
            return [
                'success' => false,
                'msg' => trans('Api::api.location.districts.msg.empty')
            ];
        }
    }

    public function wards($wards) {
        if(count($wards) > 0){
            $result = [];
            foreach($wards as $ward){
                $result[] = $this->form_ward($ward);
            }

            return [
                'success' => true,
                'data' => $result
            ];
        }else{
            return [
                'success' => false,
                'msg' => trans('Api::api.location.wards.msg.empty')
            ];
        }
    }


    public function form_state($state){
        return [
            'state_id' => $state->state_id,
            'state_name' => $state->name
        ];
    }

    public function form_district($district){
        $state = $district->state()->first();
        return [
            'district_id' => $district->district_id,
            'district_name' => $district->name,
            'state_id' => @$state->state_id,
            'state_name' => @$state->name
        ];
    }

    public function form_ward($ward){
        $district = $ward->district()->first();
        return [
            'ward_id' => $ward->ward_id,
            'ward_name' => $ward->name,
            'district_id' => @$district->district_id,
            'district_name' => @$district->name
        ];
    }
}
