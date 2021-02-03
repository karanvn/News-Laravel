<?php


namespace App\Modules\Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Modules\Api\Libraries\BannerOut;
use App\Modules\Banner\Models\Banner;

class BannerController extends Controller
{
    function __construct()
    {
        $this->banner = new Banner();
        $this->lib = new BannerOut();
    }

    function banners(Request $request) {
        $inputs = $request->except(['_token']);
        $type = @$inputs['type'];
        if(empty($type)){
            $banners = [];
        }else{
            $filters = [
                'published' => 'A',
                'type' => $type
            ];
            $params = array_merge($filters, [ 'orderBy' => ['position', 'asc']]);
            $banners = $this->banner->get_banners($params);
        }
        return response()->json($this->lib->banners($banners));
    }
}
