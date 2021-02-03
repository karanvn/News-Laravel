<?php


namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\App;

use App\Libraries\Upload;
use App\Modules\Log\Libraries\LibActivityLog;
use App\Modules\Log\Models\ActivityLog;
use App\User;
use App\Modules\Rule\Models\Rule;
use App\Modules\Rule\Models\MPermission;
use App\Modules\Rule\Models\MRole;

;
use Illuminate\Http\Request;

class AdminController extends SiteController
{
    function __construct()
    {
        $this->user = new User();
        $this->rule = new Rule();
        $this->role = new MRole();
        $this->log = new ActivityLog();
        
    }

    function index(Request $request) {
        $filters = [
            'name' => @$request->get('name'),
            'email' => @$request->get('email'),
            'id'    => @$request->get('id'),
            'status' => @$request->get('status')
        ];

        $params = array_merge($filters, ['limit' => 12, 'orderBy' => ['id', 'desc']]);
        $params['email'] = $filters['email'].'%';
        $params['user_type'] = 'A';
        $users = $this->user->get_users($params);
        return view('Auth::admin.index', [
            'filters' => $filters,
            'filter' => get_auth_filters($filters),
            'users' => $users]);

        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('Auth::admin.index', ['users' => $users]);
    }

    function add(){
        return view('Auth::admin.add', ['user_type' => 'A']);
    }

    function edit(User $user, $page = 'general'){
        if(!$this->hasPermissionAdmin($user, 'view admins'))
            return view('errors.403');
        if($user->user_type == 'C')
            return redirect()->route('CustomerEdit', [$user->id, 'general']);

        $roles = [];
        $partner = false;

        switch($page){
            case 'rule':
                $roles = $this->role->get_roles();
            break;

            case 'general':
                $partner = $user->partner()->get()->first();
            break;

        }

        $logs = $page != 'history' ? [] : $this->log->get_logs([
            'type' => 'ADMIN',
            'object_id' => $user->id
        ]);

        return view('Auth::admin.edit', [
            'roles' => $roles,
            'user' => $user,
            'partner' => $partner,
            'logs' => $logs,
            'lib' => new LibActivityLog(),
            'page' => $page]);
    }
}
