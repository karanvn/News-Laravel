<?php


namespace App\Modules\Api\Controllers;

use App\Http\Controllers\SiteController;
use App\Modules\Product\Models\Category;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Request;

use Config;

class ThirdController extends SiteController
{

    function __construct()
    {
        $this->category = new Category();
    }

    function user(Request $request) {
        return view('Api::user.index', []);
    }

    function product(Request $request) {
        $categories = $this->category->get_categories(['parent_id' => 0]);
        return view('Api::product.index', [
            'categories' => $categories
        ]);
    }

    function banner(Request $request) {
        return view('Api::banner.index', [

        ]);
    }

    function order(Request $request) {
        return view('Api::order.index', [

        ]);
    }

    function location(Request $request) {
        return view('Api::location.index', []);
    }
}
