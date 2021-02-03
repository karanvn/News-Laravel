<?php


namespace App\Modules\Location\Controllers;

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Auth;

use App\Modules\Location\Models\State;


class StateController extends SiteController
{

    function __construct()
    {
        $this->state = new State();
    }

    function index(Request $request) {

        $filters = [
            'state_id' => @$request->get('state_id'),
            'status' => @$request->get('status')
        ];

        $params = array_merge($filters, ['limit' => 24, 'orderBy' => ['state_id', 'desc']]);
        $states = $this->state->get_states($params);
        return view('Location::state.index', [
            'filters' => $filters,
            'filter' => get_location_filters($filters),
            'states' => $states]);
    }

    function add(){
        return view('Location::state.action', []);
    }
    
    function edit(State $state){
        return view('Location::state.action', ['state' => $state]);
    }
    function frmExcelShipping(){
        return view('Location::excel.excelForm');
    }
}
