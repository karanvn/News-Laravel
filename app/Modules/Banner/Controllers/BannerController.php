<?php


namespace App\Modules\Banner\Controllers;

use App\Http\Controllers\SiteController;
use Symfony\Component\HttpFoundation\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Libraries\Upload;
use App\Modules\Banner\Models\Banner;
use  App\Modules\Blog\Models\BlogCategory;

use Config;

class BannerController extends SiteController
{

    function __construct()
    {
        $this->banner = new Banner();
        
        $this->BlogCategory = new BlogCategory();
    }

    function index(Request $request) {
        $filters = [
            'type' => @$request->get('type'),
            'status' => @$request->get('status'),
            'published' => @$request['published'],
            'sort' => @$request['sort']
        ];

        $params = array_merge($filters, ['limit' => 12, 'orderBy' => ['position', 'asc']]);
        $banners = $this->banner->get_banners($params);
        return view('Banner::banner.index', [
            'filters' => $filters,
            'filter' => get_banner_filters($filters),
            'obj' => $this->banner,
            'banners' => $banners]);
    }

    function add(){
        return view('Banner::banner.action', ['obj' => $this->banner]);
    }

    function edit(Banner $banner){
        $objects = '';
       
        if($banner->type=='CATEGORYBLOG'){
            $objects = $this->BlogCategory->get_categories(['status' =>'A']);
        }
        
        return view('Banner::banner.action', [
            'obj' => $this->banner,
            'objects' => $objects,
            'banner' => $banner]);
    }
}
