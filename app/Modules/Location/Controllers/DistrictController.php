<?php


namespace App\Modules\Location\Controllers;

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Auth;

use App\Modules\Location\Models\District;


class DistrictController extends SiteController
{

    function __construct()
    {
        $this->district = new District();
    }

    function index(Request $request) {
        $filters = [
            'district_id' => @$request->get('district_id'),
            'state_id' => @$request->get('state_id'),
            'status' => @$request->get('status')
        ];

        $params = array_merge($filters, ['limit' => 12, 'orderBy' => ['district_id', 'desc']]);
        $districts = $this->district->get_districts($params);
        return view('Location::district.index', [
            'filters' => $filters,
            'filter' => get_location_filters($filters),
            'districts' => $districts]);
    }

    function add(){
        return view('Location::district.action', []);
    }

    function edit(District $district){
        return view('Location::district.action', ['district' => $district]);
    }
}
