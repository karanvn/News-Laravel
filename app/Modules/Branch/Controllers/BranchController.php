<?php


namespace App\Modules\Branch\Controllers;

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Auth;

use App\Libraries\Upload;
use App\Modules\Branch\Models\Branch;

use Config;

class BranchController extends SiteController
{

    function __construct()
    {
        $this->branch = new Branch();
    }

    function index(Request $request) {

        $filters = [
            'name' => @$request->get('name'),
            'status' => @$request->get('status')
        ];

        $params = array_merge($filters, ['limit' => 12, 'orderBy' => ['id', 'desc']]);
        $branches = $this->branch->get_branches($params);
        return view('Branch::branch.index', [
            'filters' => $filters,
            'filter' => get_branch_filters($filters),
            'branches' => $branches]);
    }

    function add(){
        return view('Branch::branch.action', []);
    }

    function edit(Branch $branch){
        return view('Branch::branch.action', [
            'state_id' => $branch->state_id,
            'district_id' => $branch->district_id,
            'ward_id' => $branch->ward_id,
            'branch' => $branch]);
    }
}
