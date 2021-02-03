<?php


namespace App\Modules\Partner\Controllers;

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Auth;

use App\Libraries\Upload;
use App\Modules\Partner\Models\Partner;
use Config;

class PartnerController extends SiteController
{

    function __construct()
    {
        $this->partner = new Partner();
    }

    function index(Request $request) {

        $filters = [
            'name' => @$request->get('name'),
            'email' => @$request->get('email'),
            'phone' => @$request->get('phone'),
            'status' => @$request->get('status')
        ];

        $params = array_merge($filters, ['limit' => 12, 'orderBy' => ['name', 'asc']]);
        $partners = $this->partner->get_partners($params);
        return view('Partner::partner.index', [
            'filters' => $filters,
            'filter' => get_partner_filters($filters),
            'partners' => $partners]);
    }

    function add(){
        return view('Partner::partner.add');
    }

    function edit(Partner $partner, $page = 'overview'){
        return view('Partner::partner.edit', ['partner' => $partner, 'page' => $page]);
    }
}
