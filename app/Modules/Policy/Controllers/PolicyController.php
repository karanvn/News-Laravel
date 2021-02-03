<?php


namespace App\Modules\Policy\Controllers;

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Auth;

use App\Libraries\Upload;
use App\Modules\Policy\Models\Policy;

use Config;

class PolicyController extends SiteController
{

    public function __construct()
    {
        $this->policy = new Policy();
    }

    public function index(Request $request) {
        $filters = [
            'name'   => @$request->get('name'),
            'status' => @$request->get('status')
        ];

        $params = array_merge($filters, ['limit' => 12, 'orderBy' => ['id', 'desc']]);
        $policy = $this->policy->get_policies($params);
        return view('Policy::policy.index', [
            'filters' => $filters,
            'filter'  => get_policy_filters($filters),
            'policy'  => $policy]);
    }

    public function add(){
        return view('Policy::policy.action', []);
    }

    public function edit(Policy $policy){
        return view('Policy::policy.action', [
            'policy' => $policy]);
    }
}

