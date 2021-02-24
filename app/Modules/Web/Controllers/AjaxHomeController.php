<?php


namespace App\Modules\Web\Controllers;

use App\Http\Controllers\SiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Modules\Blog\Models\Blog;
use Illuminate\Support\Facades\Auth;
use App\Modules\Discount\Models\Discount;
use App\Modules\Log\Libraries\LibActivityLog;
use Illuminate\Support\Facades\DB;
use App\Modules\Evaluate\Models\Evaluate;
use App\Modules\Product\Models\Collection;
use App\Modules\Blog\Models\BlogCategory;
use App\Modules\Blog\Models\BlogComment;
use App\Modules\Feedback\Models\FeedBack;
use App\Modules\Evaluate\Models\EvaluateImage;
class AjaxHomeController extends SiteController
{
    public function __construct()
    {
        $this->log            = new LibActivityLog();
        $this->evaluate = new Evaluate();
        $this->imageEvaluate = new EvaluateImage();
        $this->blog            = new Blog;
        $this->blogComment     = new BlogComment();
        $this->blogCategory    = new BlogCategory;
        $this->feedback = new FeedBack();

        
    }
    public function commentblogNew(Request $request){
        $conditions = [
            'name' => 'required',
            'email' => 'required',
            'comment' => 'required',
            'blog_id' => 'required'
        ];
  
        $messages = [
            'name.required'  => 'Xin vui lòng nhập tên',
            'email.required'  => 'Xin vui lòng nhập email',
            'comment.required'  => 'Xin vui lòng nhập nội dung',
            'blog_id.required'  => 'Đã sảy ra lỗi'
        ];
        $validator = Validator::make($request->all(),
            $conditions,
            $messages
        );
        $passes = $validator->passes();
        $toastr = 'Xin vui lòng nhập đẩy đủ thông tin';
        if($passes){
        $toastr = 'Thành công';
        // thêm sp con thuộc nó
        $comment    = new BlogComment;
        if(empty($request->parent_id)){
            $request->request->add([
                'parent_id'  =>'0',
                ]);
        }
        $comment->saveComment(array_merge($request->all(),['status'=>'D']));
  
        }
        $errors = $validator->errors();
        return response()->json([
            'success' => $passes,
            'toastr' => $toastr
        ]);

        
        return response()->json([
            'data'      =>'111111111111',
            'limit'     =>'11111111111111111111'
        ]);
    }

    public function checkprice(Request $request){
        $data = Product::find($request->id);
        $gia  = empty($data->sell_price) ? $data->org_price : $data->sell_price;
        return $gia;
    }
    
    public function searchproductshow(Request $request){
        $productparent = Product::where('parent_product_id', $request->id);
        $data = $this->product->scopeEqualFeatures($productparent, $request->arr)->with('images');
        return view('Web::product.ajax.featureproduct',[
            'datas' => $data!=null ? $data->get() : null
        ]);
    }
    function searchproductseacrchbutton(Request $request){
        $product =$this->product->get_products([
            'product_id' => $request->id
            ]);
        if(count($product)<=0){
            return 'ko ton tai';
        }
        $product = $product[0];
        $love = null;
        if(Auth::check()){
            $love = $this->ProductLove->get_productloves([
                'product_id' => $product->product_id,
                'UserId' => Auth::id()
            ]);
        }
        return view('Web::product.ajax.searchproductseacrchbutton',[
            'data' => $product,
            'love' => $love

        ]);
    }
    
    public function autocomplete_ajax($name = ''){
        $limit = 8;
        if($name){
            $products =$this->product->get_products([
                'status'=>'A', 
                'name'=>$name,
                'parent_product_id' => '0',
                'limit' => $limit
            ]);
            return view('Web::search.render_search',[
                'products' => $products,
                'keyword'  => $name,
                'limit'    => $limit,
            ]);
        }
    }

    public function ajaxdanhmuc(Request $request){
        if(!empty($request->order)){
            $order = explode('-', $request->order);
            $request->request->add([
                'orderBy'            => $order
                ]);
        }
        if(!isset($request->id_FeaturesInParent)){
            $request->request->add([
                'status'            =>'A',
                'parent_product_id' => '0'
                ]);
        }else{
            $limit=  $request->limit;
           

            $request->request->add([
                'limit'  =>'',
                ]);

        }
        $data = $this->product->get_products($request->all());
        if(!empty($request->id_FeaturesInParent)&&(count($data)>0)){
            $datanew = [];
            foreach($data as $temporarilyData){
                $i=1;
                foreach($request->id_FeaturesInParent as $temporarilyFeature){
                    if(count($this->productFeature->get_productfeature(['FeatureId' =>$temporarilyFeature, 'product_parent' =>  $temporarilyData->product_id ]))<=0){
                    $i=0;
                    break;
                }
                }
                if($i==1){
                    $datanew[] =   $temporarilyData->product_id;
                }
            }
            if(count($datanew)<=0){
                $data = [];
            }else{
                $data = $this->product->get_products(['productArr_id' =>$datanew, 'limit' => $limit ]);
            }
        }
        $html = view('Web::shop.listitemdanhmuc',[
            'products' =>$data,
            'page' => isset($request->page) ? $request->page : '1'
        ])->render();
        return response()->json([
            'data'      => $html,
            'limit'     =>!empty($data) ? $data->count() : '0'
        ]);
    }

    // Handle filter sort price, name asc, desc
    public function filterShort(Request $request){
        $filterSort = $request->all();
        $sortOrder = explode('-', $filterSort['data']); 

        $filters = [
            'limit'  => 8,
            'status' => 'A',
            'orderBy'=> $sortOrder,
            'parent' => ['=', 0]
        ];

        $products = $this->product->get_products($filters);

        $html = view('Web::shop.listitemdanhmuc', compact('products'))->render();
            return response()->json([
                'success' => true,
                'html'    => $html
            ]);

    }
    function loadFeature($id, $feature = ''){
        $features = explode(",", $feature);
        $prefix_status_trans = 'Web::home.ProductShow.status.';
      
        $data = $this->product->get_products([
            'status'                =>'A', 
            'parent_product_id'     => $id,
            'EqualFeatures_exactly' => $features
            ]);
        if($data->count()==1){
            $arrfeature = [];

            foreach(@$data[0]->features()->get() as $feaParent)
            {
                if(!in_array($feaParent->id,$arrfeature)){
                  $arrfeature[] = $feaParent->id;
                }
         }
            return response()->json([
                'success'       => 1, // trường hợp ok
                'data'          =>  $data[0],
                'status'    =>  $data[0]->qty >'0' ? trans($prefix_status_trans . 'stocking') : trans($prefix_status_trans . 'noStocking'),
                'arrfeature'    => $arrfeature
            ]);
        }

         // trường hợp 2
        if(!empty($features[0])){
          $featureInManyOption = $this->feature->get_feature($features[0]);  
        }
        $parentFeatureInManyOption = @$featureInManyOption->parent_id;
        if($data->count()>1){
            $arrfeature = [];
           foreach($data as $value){
              foreach(@$value->features()->get() as $feaParent)
              {
                  if(!in_array($feaParent->id,$arrfeature)){
                    $arrfeature[] = $feaParent->id;
                  }
              }
           }
           return response()->json([
            'success'   => 2, // trường hợp có nhìu hơn 1 sp phải chọn tip
            'status'    => $parentFeatureInManyOption == '1' ? 'VUI LÒNG CHỌN SIZE' : 'VUI LÒNG CHỌN MÀU',
            'data'      =>  $arrfeature
        ]);
        }
        if($data->count()==0){
            return response()->json([
                'success'   => 3, //trường hợp lỗi ko có sp
                'status'    =>  trans($prefix_status_trans . 'none'),
                'data'      => ''
            ]);
        }
    }
    function showEvaluateProductDetail($id){
    $limit = 2;
    $data = $this->evaluate->get_evatuates([
        'limit'     => $limit,
        'productid' => $id,
        'status'    => 'A'
        ]);
    $html = view('Web::evaluate.load_more',[
    'data' => $data
    ])->render();

    $status = $limit <= count($data) ? '1' : '2';
    return response()->json([
        'status'    => $status, 
        'data'      => $html
    ]);
    }
    function ProductViewed($id){
       $id = explode(',',$id);
       if(count($id) > 4){
        $dataFull = $this->product->get_products([
            'productArr_id' => $id,
            'parent_product_id' => '0'
        ]);
           for($i = count($id) - 1; $i >=count($id) - 5; $i--){
             $productViewLimit[] =  $id[$i];
           }
           $id = $productViewLimit;
       
       }
    if(!empty($id)){
        $data = $this->product->get_products([
            'productArr_id' => $id, 
            'limit'         =>4
            ]);
        $html = view('Web::product.ProductViewed',[
            'data' => $data,
            'productViewLimit' => isset($productViewLimit) ? '1' : '0',
            'dataFull' =>  isset($dataFull) ? $dataFull : null
            ])->render();
    }else{
        $html = '';
    }
        return response()->json([
            'data' => $html
        ]);
    }
    function editLoveProduct($id){
        if(Auth::check()){
            $love = $this->ProductLove->get_productloves([
                'product_id' => $id,
                'UserId' => Auth::id()
            ]);
            if(!empty($love->toArray())){
                $love = $love[0];
                $love->delete();
            }else{
                $addLove = new ProductLove();
                $addLove->product_id = $id;
                $addLove->user_id = Auth::id();
                $addLove->save();
            }
        }
        return response()->json([
            'count' =>$this->product->get_products(['product_id' => $id])[0]->love()->count()
        ]);
    } 
    function ajaxDataHighlights($id, Request $request){
        if(!empty($id)){
                $code = [];
                $code[]         = $id;
                $categoryParent = $this->category->get_categories([
                                    'status'    => 'A', 
                                    'parent_id' => $id
                                ]);
                $category = $this->category-> get_category($id);
                if(count(@$categoryParent)>0){
                    foreach(@$categoryParent as $parent){
                        $code[] = $parent->id;
                    }
                }  
          
                $datas = $this->product->get_products([
                    'status'            =>'A',
                    'categoryarr_ids'   => $code, 
                    'parent_product_id' => '0',
                    'orderBy'           => '',
                    'limit'             => '8'
            ]);

            $html = view('Web::home.ajax.datahightlight',[
                'datas' => $datas,
                'category'  => $category,
                'type' => isset($request->type) ? $request->type : ''
                ])->render();

                return response()->json([
                    'data' => $html
                ]);
        }
        return response()->json([
            'data' => ''
        ]);

}
function loadProductsCollection($id, Request $request){
    $products = $this->product->get_products([
        'collection' => $id,
        'status'    => 'A',
        'limit'     => '12'
        ]);

       $html = view('Web::collection.ajaxList', [
            'products' => $products,
            'page'  =>isset($request->page) ? $request->page : '1'
            ])->render();
        if($products->hasMorePages()){
            $success = '1';
        }else{
            $success = '2';
        }
    return response()->json([
        'html' => $html,
        'success'   => $success
    ]);
}
public function loadCollectionsPage(Request $request){
    $collections =  $this->collection->get_collections([
        'status'  => 'A',
        'limit'    => '15'
    ]);

       $html = view('Web::collection.ajaxListCollections', [
            'collections' => $collections,
            'page'  =>isset($request->page) ? $request->page : '1'
            ])->render();
        if($collections->hasMorePages()){
            $success = '1';
        }else{
            $success = '2';
        }
    return response()->json([
        'html' => $html,
        'success'   => $success
    ]);
}
public function moreBlog($slug, Request $request){
    $limit = 16;
        $categoryBlogs = $this->blogCategory->get_category_slug($slug);

        $categories = $this->blogCategory->where('parent_id','0')->get();

        if($categoryBlogs->parent_id == '0'){
            $categoriesParents = $this->blogCategory->where('parent_id',$categoryBlogs->id)->get();
            if(count($categoriesParents)<=0){
                $data = [
                    'blog_category_id'  =>  $categoryBlogs->id,
                    'limit'             => $limit
                ];
            }else{
                $checkIdCategory[] = $categoryBlogs->id;

                foreach($categoriesParents as $categoriesParent){
                    $checkIdCategory[] = $categoriesParent->id;
                }
                $data = [
                    'blog_category_idArr' =>  $checkIdCategory,
                    'limit'               => $limit
                ];
            }
        }else{
            $data = [
                'blog_category_id'  =>  $categoryBlogs->id,
                'limit'             => $limit
            ];
        }

        $blogs          = $this->blog->get_blogs($data);
        $html = view('Web::blog.moreAjax', [
            'blogs' => $blogs
            ])->render();
        if($blogs->hasMorePages()){
            $more = 1;
        }else{
            $more = 0;
        }
    return response()->json([
        'html' => $html,
        'more'  => $more
    ]);
}
public function priceshowModalFrm(Request $request){
    $conditions = [
        'fullname' => 'required',
        'email' => 'email',
        'phone' => 'required',
        'company' => 'required',
        'type_web' => 'required',
        'price' => 'required'
    ];
    

    $messages = [
        'required'  => 'Xin vui lòng nhập đầy đủ thông tin'
    ];
    $validator = Validator::make($request->all(),
        $conditions,
        $messages
    );
    $passes = $validator->passes();
    $toastr = 'Xin vui lòng nhập đẩy đủ thông tin';
    if($passes){
        $new = $this->feedback;
        $new->fullname = $request->fullname;
        $new->email = $request->email;
        $new->phone = $request->fullname;
        $new->company = $request->company;
        $new->demo = @$request->company;
        $new->type_web = $request->type_web;
        $new->price = $request->price;
        $new->type = 'PRICE';
        
        $new->save();
    }
    $errors = $validator->errors();
 
    return response()->json([
        'passes'   => $passes
    ]);
}
}