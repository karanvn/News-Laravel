<?php


namespace App\Modules\Location\Controllers;

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Auth;

use App\Modules\Location\Models\Ward;


class WardController extends SiteController
{

    function __construct()
    {
        $this->ward = new Ward();
    }

    function index(Request $request) {

        $filters = [
            'state_id' => @$request->get('state_id'),
            'district_id' => @$request->get('district_id'),
            'ward_id' => @$request->get('ward_id'),
            'status' => @$request->get('status')
        ];

        $params = array_merge($filters, ['limit' => 12, 'orderBy' => ['ward_id', 'desc']]);
        $wards = $this->ward->get_wards($params);
        return view('Location::ward.index', [
            'filters' => $filters,
            'filter' => get_location_filters($filters),
            'wards' => $wards]);
    }

    function add(){
        return view('Location::ward.add', []);
    }

    function edit(Ward $ward){
        return view('Location::ward.edit', ['ward' => $ward]);
    }
}
