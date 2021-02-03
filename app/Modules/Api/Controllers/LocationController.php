<?php


namespace App\Modules\Api\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Api\Libraries\LocationOut;
use App\Modules\Location\Models\District;
use App\Modules\Location\Models\State;
use App\Modules\Location\Models\Ward;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;


class LocationController extends Controller
{

    function __construct()
    {
        $this->state = new State();
        $this->district = new District();
        $this->ward = new Ward();
        $this->lib = new LocationOut();
    }


    function states(Request $request) {
        $inputs = $request->except(['_token']);
        $states = $this->state->get_states(['status' => 'A', 'orderBy' => ['name', 'asc']]);
        return response()->json($this->lib->states($states));
    }

    function districts($state_id, Request $request) {
        $inputs = $request->except(['_token']);
        if(empty($state_id)){
            return response()->json([
                'success' => false,
                'msg' => trans('Api::api.location.districts.msg.empty')
            ]);
        }else{
            $districts = $this->district->get_districts(['status' => 'A', 'state_id' => $state_id ,'orderBy' => ['name', 'asc']]);
            return response()->json($this->lib->districts($districts));
        }
    }

    function wards($district_id, Request $request) {
        $inputs = $request->except(['_token']);
        if(empty($district_id)){
            return response()->json([
                'success' => false,
                'msg' => trans('Api::api.location.wards.msg.empty')
            ]);
        }else{
            $wards = $this->ward->get_wards(['status' => 'A', 'district_id' => $district_id ,'orderBy' => ['name', 'asc']]);
            return response()->json($this->lib->wards($wards));
        }
    }
}
