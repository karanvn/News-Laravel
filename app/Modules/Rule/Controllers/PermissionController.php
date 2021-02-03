<?php


namespace App\Modules\Rule\Controllers;

use App\Http\Controllers\SiteController;
use Symfony\Component\HttpFoundation\Request;

use App\Modules\Rule\Models\MPermission;

use Config;

class PermissionController extends SiteController
{

    function __construct()
    {
        $this->permission = new MPermission();
    }

    function index(Request $request) {

        $filters = [
            'name' => @$request->get('name')
        ];

        $params = array_merge($filters, ['limit' => 12, 'orderBy' => ['id', 'desc']]);
        $permissions = $this->permission->get_permissions($params);
        return view('Rule::permission.index', [
            'filters' => $filters,
            'filter' => get_rule_filters($filters),
            'permissions' => $permissions]);
    }

    function add(){
        return view('Rule::permission.add', []);
    }

    function edit(MPermission $permission){
        return view('Rule::permission.edit', [
            'permission' => $permission]);
    }
}
