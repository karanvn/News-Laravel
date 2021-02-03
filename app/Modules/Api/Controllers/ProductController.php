<?php


namespace App\Modules\Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

use App\Modules\Api\Libraries\ProductOut;
use App\Modules\Product\Models\Category;
use App\Modules\Product\Models\Product;

class ProductController extends Controller
{

    function __construct()
    {
        $this->product = new Product();
        $this->category = new Category();
        $this->lib = new ProductOut();
    }


    function products(Request $request) {
        $inputs = $request->except(['_token']);
        $limit = !empty($inputs['limit']) ? @$inputs['limit'] : 20;
        $category_ids = @$inputs['category_ids'];
        $name = @$inputs['name'];
        $filters = [];

        if(!empty($name))
            $filters['name'] = $name;

        if(!empty($category_ids) && !is_array($category_ids)){
            $filters['category_ids'] = array_filter(explode(',', $category_ids));
        }

        $params = array_merge($filters, ['limit' => $limit, 'status' => 'A', 'availSinceTo' => date('Y-m-d H:i:s') , 'orderBy' => ['product_id', 'desc'], 'parent' => ['=', 0]]);
        $products = $this->product->get_products($params);
        $filter = get_product_filters($filters, false);
        return response()->json($this->lib->products($products, $filter));
    }

    function product($id) {
        $product = $this->product->get_product($id);
        return response()->json($this->lib->product($product));
    }


    function categories(Request $request) {
        $inputs = $request->except(['_token']);
        $category_id = (int)@$inputs['category_id'];
        $category_id = (!empty($category_id) && (int)$category_id > 0 ) ? $category_id : 0;
        if(!empty($category_id)){
            $category = $this->category->get_category($category_id);
            if($category){
                $categories = $category->categories()->where('status', 'A')->get();
            }else{
                $categories = [];
            }
        }else{
            $categories = $this->category->get_categories(['parent_id' => 0, 'status' => 'A']);
        }
        return response()->json($this->lib->categories($categories));
    }
}
