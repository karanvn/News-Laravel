<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

use Illuminate\Routing\Controller as BaseController;

class SiteController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get_auth(){
        return Auth::user();
    }

    public function hasPermission($permission){
        $user = $this->get_auth();
        return $user->id == 1 ? true : $user->hasPermissionTo($permission);
    }

    public function hasPermissionAdmin($user, $permission){
        $auth = $this->get_auth();
        if($auth->id == 1){
            return true;
        }
        return $auth->id == $user->id ? true : $auth->hasPermissionTo($permission);
    }
}
