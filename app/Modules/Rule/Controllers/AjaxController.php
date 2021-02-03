<?php


namespace App\Modules\Rule\Controllers;

use App\Http\Controllers\SiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

use App\Modules\Rule\Models\MPermission;
use App\Modules\Rule\Models\MRole;
use App\Modules\Rule\Models\Rule;

use App\Modules\Log\Libraries\LibActivityLog;


class AjaxController extends SiteController
{
    function __construct()
    {
        $this->permission = new MPermission();
        $this->role = new MRole();
        $this->rule = new Rule();
        $this->log = new LibActivityLog();
    }

    function processPermission(Request $request) {
        $inputs = $request->except(['_token']);

        $id = !empty($inputs['id']) ? $inputs['id'] : 0;
        $prefix_errors_trans = 'Rule::permission.add.form.errors.';
        $prefix_success_trans = 'Rule::permission.add.form.success.';

        $conditions = [
            'title' => 'required'
        ];
        $messages = [
            'title.required' => trans($prefix_errors_trans . 'title'),
        ];
        if(empty($id)){
            $conditions['name'] = 'required|unique:permissions,name';
            $messages['name.required'] = trans($prefix_errors_trans . 'name');
            $messages['name.unique'] = trans($prefix_errors_trans . 'name_unique');
        }

        $validator = Validator::make($request->all(),
            $conditions,
            $messages
        );

        $passes = $validator->passes();
        $permission = !empty($id) ? $this->permission->get_permission($id) : $this->permission;
        $object = clone $permission;
        $toastr = trans($prefix_errors_trans. 'header');

        if($passes){
            $toastr = !empty($id) ? trans($prefix_success_trans . 'edit') : trans($prefix_success_trans . 'add');
            foreach($inputs as $key => $val){
                $permission->$key = $val;
            }
            $permission->save();

            //LOG PERMISSION
            $object->object_id = $permission->id;
            $object->user_id = Auth::user()->id;
            $object->empty = !empty($id) ? false : true;

            $this->log->permissionLog([
                'object' => $object,
                'data' => $inputs
            ]);

        }
        $errors = $validator->errors();
        return response()->json([
            'success' => $passes,
            'errors' => $errors,
            'toastr' => $toastr,
            'permission' => $permission,
            'inputs' => $inputs
        ]);
    }

    function processRole(Request $request) {
        $inputs = $request->except(['_token']);

        $id = !empty($inputs['id']) ? $inputs['id'] : 0;
        $prefix_errors_trans = 'Rule::role.add.form.errors.';
        $prefix_success_trans = 'Rule::role.add.form.success.';

        $conditions = [];
        $messages = [];
        if(empty($id)){
            $conditions = [
                'name' => 'required|unique:roles,name'
            ];
            $messages = [
                'name.required' => trans($prefix_errors_trans . 'name'),
                'name.unique'   => trans($prefix_errors_trans . 'name_unique')
            ];
        }

        $validator = Validator::make($request->all(),
            $conditions,
            $messages
        );

        $passes = $validator->passes();
        $role = !empty($id) ? $this->role->get_role($id) : $this->role;
        $object = clone $role;
        $toastr = trans($prefix_errors_trans. 'header');

        if($passes){
            $toastr = !empty($id) ? trans($prefix_success_trans . 'edit') : trans($prefix_success_trans . 'add');
            foreach($inputs as $key => $val){
                if($key != 'permission_ids')
                    $role->$key = $val;
            }
            $role->save();

            $object->object_id = $role->id;
            $object->user_id = Auth::user()->id;
            $object->empty = !empty($id) ? false : true;

            $this->log->roleLog([
                'object' => $object,
                'data' => $inputs
            ]);


            $permission_ids = @$inputs['permission_ids'];
            if(!empty($permission_ids)){

                //Remove all role permissions before asign new permissions
                $hasPermissions = $role->permissions()->get();
                if(count($hasPermissions)){
                    foreach($hasPermissions as $has){
                        $role->revokePermissionTo($has->name);
                    }
                }

                //Asign new permissions
                foreach($permission_ids as $permission_id){
                    $permission = $this->permission->get_permission($permission_id);
                    if($permission){
                        $role->givePermissionTo($permission);
                    }
                }
            }else{
                //Remove all role permissions before asign new permissions
                $hasPermissions = $role->permissions()->get();
                if(count($hasPermissions)){
                    foreach($hasPermissions as $has){
                        $role->revokePermissionTo($has->name);
                    }
                }
            }
        }
        $errors = $validator->errors();
        return response()->json([
            'success' => $passes,
            'errors' => $errors,
            'toastr' => $toastr,
            'role' => $role,
            'inputs' => $inputs
        ]);
    }

    function processRolePermission(Request $request){
        $inputs = $request->except(['_token']);
        $term = $inputs['term'];
        if(strlen($term) >= 0){
            $permissions = $this->permission->get_permissions(['name' => $term.'%', 'limit' => 20, 'offset' => 0]);
            $success = count($permissions) > 0 ? true : false;
            $results = [];
            if($success){
                foreach($permissions as $permission){
                    $results[] = [
                        'id' => $permission->id,
                        'name' => $permission->name
                    ];
                }
            }
            return response()->json([
                'success' => $success,
                'results' => $results
            ]);
        }
    }

    function processRule(Request $request) {
        $inputs = $request->except(['_token']);

        $id = !empty($inputs['id']) ? $inputs['id'] : 0;
        $prefix_errors_trans = 'Rule::role.add.form.errors.';
        $prefix_success_trans = 'Rule::role.add.form.success.';

        $conditions = [
            'name' => 'required'
        ];
        $messages = [
            'name.required' => trans($prefix_errors_trans . 'name')
        ];

        $validator = Validator::make($request->all(),
            $conditions,
            $messages
        );

        $passes = $validator->passes();
        $rule = !empty($id) ? $this->rule->get_rule($id) : $this->rule;
        $toastr = trans($prefix_errors_trans. 'header');
        $object = clone $rule;

        if($passes){
            $toastr = !empty($id) ? trans($prefix_success_trans . 'edit') : trans($prefix_success_trans . 'add');
            $user_id = Auth::user()->id;

            if(empty($id))
                $rule->user_id = $user_id;

            foreach($inputs as $key => $val){
                $rule->$key = $val;
            }
            $rule->save();

            $object->object_id = $rule->id;
            $object->user_id = $user_id;
            $object->empty = !empty($id) ? false : true;
            $this->log->ruleLog([
                'object' => $object,
                'data' => $inputs
            ]);
        }
        return response()->json([
            'success' => $passes,
            'errors' => $validator->errors(),
            'toastr' => $toastr,
            'rule' => $rule
        ]);
    }


}
