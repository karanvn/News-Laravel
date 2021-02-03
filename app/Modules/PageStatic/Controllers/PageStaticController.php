<?php


namespace App\Modules\PageStatic\Controllers;

use App\Http\Controllers\SiteController;
use Symfony\Component\HttpFoundation\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Libraries\Func;
use App\Modules\PageStatic\Models\PageStatic;

use Config;

class PageStaticController extends SiteController
{

    public function __construct()
    {
        $this->pageStatic = new PageStatic();
    }

    public function index(Request $request) {
        $filters = [
            'status' => @$request->get('status'),
            'sort'   => @$request['sort']
        ];

        // dd($filters);

        $params = array_merge($filters, ['limit' => 12, 'orderBy' => ['id', 'asc']]);
        $pageStatics = $this->pageStatic->get_pages($params);

        return view('PageStatic::page_static.index', [
            'filters'     => $filters,
            'filter'      => get_page_static_filters($filters),
            'pageStatics' => $pageStatics]);
    }

    public function add(){
        return view('PageStatic::page_static.add');
    }

    public function edit($id){
        $page = $this->pageStatic->get_page($id);
    
        return view('PageStatic::page_static.add', ['page' => $page]);
    }
}
