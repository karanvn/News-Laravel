<?php


namespace App\Modules\Rule\Controllers;

use App\Http\Controllers\SiteController;
use Symfony\Component\HttpFoundation\Request;

use App\Modules\Rule\Models\MRole;
use App\Modules\Rule\Models\MPermission;
use App\Modules\Rule\Models\Rule;

use Config;

class RoleController extends SiteController
{

    function __construct()
    {
        $this->role = new MRole();
        $this->rule = new Rule();
        $this->permission = new MPermission();
    }

    function index(Request $request) {

        $filters = [
            'name' => @$request->get('name'),
            'rule_id' => @$request->get('rule_id')
        ];

        $params = array_merge($filters, ['limit' => 12, 'orderBy' => ['id', 'desc']]);
        $roles = $this->role->get_roles($params);
        $rules = $this->rule->get_rules(['orderBy' => ['name', 'asc']]);
        return view('Rule::role.index', [
            'filters' => $filters,
            'filter' => get_rule_filters($filters),
            'rules' => $rules,
            'roles' => $roles]);
    }

    function add(){
        $rules = $this->rule->get_rules(['stauts' => 'A','orderBy' => ['name', 'asc']]);
        $permissions = $this->permission->get_permissions(['stauts' => 'A','orderBy' => ['name', 'asc']]);
        return view('Rule::role.add', [
            'permissions' => $permissions,
            'rules' => $rules]);
    }

    function edit(MRole $role){

        $rules = $this->rule->get_rules(['stauts' => 'A','orderBy' => ['name', 'asc']]);
        return view('Rule::role.edit', [
            'rules' => $rules,
            'role' => $role]);
    }
}
