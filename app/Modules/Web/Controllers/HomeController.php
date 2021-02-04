<?php
namespace App\Modules\Web\Controllers;
use App\Http\Controllers\SiteController;
use App\Modules\Web\Controllers\CookieController;
use Symfony\Component\HttpFoundation\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Libraries\Upload;
use Illuminate\Support\Facades\Auth;
use App\Modules\Setting\Models\Setting;
use App\Modules\Banner\Models\Banner;
use App\Modules\Blog\Models\Blog;
use App\Modules\Schema\Models\Schema;
use App\Modules\Blog\Models\BlogCategory;
use App\Modules\Feedback\Models\Feedback;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cookie;
use App\Modules\Blog\Models\BlogComment;
use App\Modules\PageStatic\Models\PageStatic;
use App\Modules\Auth\Models\ReciveMail;
use Illuminate\Http\Response;
use App\Modules\Evaluate\Models\Evaluate;
use App\Modules\Slug\Models\SlugOptimize;
use Illuminate\Routing\UrlGenerator;
use App\Modules\Location\Models\State;
use App\Modules\Location\Models\District;
use App\Modules\Location\Models\Ward;
use App\Modules\Mail\Libraries\MailTemplate;
use Illuminate\Support\Facades\Session;
use App\User;

class HomeController extends SiteController
{
    public function __construct()
    {
        $this->evaluate        = new Evaluate();
        $this->slug_url        = new SlugOptimize();
        $this->setting         = new Setting();
        $this->banner          = new Banner();
        $this->user            = new User();
        $this->state           = new State();
        $this->district        = new District();
        $this->ward            = new Ward();
        $this->blogCategory    = new BlogCategory;
        $this->blog            = new Blog;
        $this->blogComment     = new BlogComment();
        $this->feedback        = new Feedback();
        $this->pageStatic      = new PageStatic();
        $this->reciveMail      = new ReciveMail();
    }

    public function handleURL($alias1 = '', $alias2 = '', $alias3 = ''){
        // dd($alias1);
        $slug1 = explode('.', $alias1);
        $test1 = in_array('html', $slug1);
        $slug2 = explode('.', $alias2);
        $test2 = in_array('html', $slug2);

        $page_static = $this->pageStatic->get_pages(['slug'=>$slug1[0]]);
        if(count($page_static)>0){
            return $this->pageStatic($alias1);
        }
        if(!empty($slug2)){
            $blog  = $this->blog->get_blog_slug($slug2);
            if(!empty($blog)){
                return $this->getBlogSlug([$slug1, $slug2, $slug2]);
            }
        }
        switch ($slug1[0]) {
            case 'cron_slug_cate_product':
                return $this->getSlugCateProduct();
                break;
            case 'cron_slug_cate_blog':
                return $this->getSlugCateBlog();
                break;
            case 'cron_slug_blog':
                return $this->getSlugBlog();
                break;
            case 'gioi-thieu':
                return $this->about();
                break;
            case 'lien-he':
                return $this->contact();
                break;
            case 'sitemap':
                return $this->sitemap();
                break;
            
            default:
                # code...
                break;
        }
        
        if($test1 == true){
            $slug1 =  $slug1[0];  // nếu có html thì cắt bỏ html
        }elseif($test2 == true){
            $slug2 =  $slug2[0]; // nếu có html thì cắt bỏ html
        }else{
            $slug1 =  $slug1;
            $slug2 =  $slug2;
        }
        // dd($alias1);
        
        $limit =  24;
        // dd($slug1);
        if($alias1 != null || $alias2 != null || $alias3 != null){
            $getSlug1 = SlugOptimize::slug(['slug' => $slug1])->first();
            $getSlug2 = SlugOptimize::slug(['slug' => $slug2])->first();
            $getSlug3 = SlugOptimize::slug(['slug' => $alias3])->first();
            
            @$slug1 = $getSlug1->slug;
            @$slug2 = $getSlug2->slug;
            @$slug3 = $getSlug3->slug;
            $params = [$slug1, $slug2, $slug3];

            $flag = false;  // type 1-san_pham, 2-danh_sach_san_pham, 3-danh_sach_blog, 4-blog

           if((!empty($slug2) && $getSlug2->type == 4) || (!empty($slug3) && $getSlug3->type == 4) || (!empty($slug3) && $getSlug3->type == 4) ){ // Case blog 
                $flag = $this->getBlogSlug($params);
            }elseif(!empty($alias1) && !empty($alias2) && $getSlug1->type == 3){
                $flag = $this->getCategoryBlog($params);
            }elseif((!empty($alias1) && !empty($slug1) && $getSlug1->type == 3) || !empty($alias2) && !empty($slug2) && $getSlug2->type == 3){
                $flag = $this->getCategoryBlog($params);
            }else{
                return view('Web::error.404');
            }
            return $flag;
        }
    }

    public function search(Request $request){
        $input = $request->all();
        $limit = 12;
        $allProducts =$this->product->get_products([
            'status'            =>'A', 
            'name'              => $input['q'],
            'parent_product_id' => '0',]);
    
        if(isset($input['q'])){
            $products =$this->product->get_products([
                'status'            =>'A', 
                'name'              => $input['q'],
                'parent_product_id' => '0',
                'limit'             => $limit
            ]);
            return view('Web::search.result_search', ['keyword' => $input['q'], 'products' => $products, 'allProducts' => $allProducts, 'limit' => $limit]);
        }else{
            return view('Web::search.search');
        }
    }

    public function getAllBlog()
    {
        $categories = $this->blogCategory->where('parent_id','0')->get();
        $limit = 18;
        $blogs = $this->blog->get_blogs([
            'limit'    => $limit,
            'position' => 'BLOG'
        ]);
        return view('Web::blog.blog',compact('categories','blogs', 'limit'));
    }

    
    public function getSlugCateBlog(){  // cron slug category blog
    
        $data = $this->blogCategory->get_categories();
        
        foreach ($data as $key => $value) {
            $slug = SlugOptimize::where('slug', $value->slug)->first();
            if(empty($slug)){
                $url_slug = new SlugOptimize();
                $url_slug->slug      = $value->slug;
                $url_slug->object_id = $value->id; 
                $url_slug->type      = 3;
                $url_slug->save();
            }
        }

        return 'Thêm đữ liệu slug danh sách bài viết thành công';
    }
    
    public function getSlugBlog(){  // cron slug blog
    
        $data = $this->blog->get_blogs();
        
        foreach ($data as $key => $value) {
            $slug = SlugOptimize::where('slug', $value->slug)->first();
            if(empty($slug)){
                $url_slug = new SlugOptimize();
                $url_slug->slug      = $value->slug;
                $url_slug->object_id = $value->id; 
                $url_slug->type      = 4;
                $url_slug->save();
            }
        }
        return 'Thêm đữ liệu slug bài viết thành công';
    }

    public function getCateProductSlug($params = []){ 
        $limit =  24;
        $slug = ($params[1] != '') ? $params[1] : $params[0];
        $category = $this->category->get_categories(['slug' => $slug, 'status'=>'A'])->first();

        $code[]         = @$category->id;
        $categoryParent = $this->category->get_categories([
            'status'    => 'A', 
            'parent_id' => @$category->id
        ]);
        if(count(@$categoryParent)>0){
            foreach(@$categoryParent as $parent){
                $code[] = $parent->id;
            }
        }
        $features = $this->feature->get_features(['status'=>'A', 'categoryarr_ids' => @$code]);
        $data = $this->product->get_products([
                'status'            =>'A',
                'categoryarr_ids'   => $code, 
                'parent_product_id' => '0',
                'orderBy'           => '',
                'limit'             => '1',
                'name'              => @$request->name
        ]);

        $image  = isset($data->images) ? asset('storage/editor/thumbs/'.@$schema->product_id.'/'.@$schema->images->first()->image_path) : '';
       
        $schemaCategory = [
            "@context" => "http://schema.org",
            "@type"    => "Category",
            "description" => @$schema->description,
            "name"        => @$schema->name,
            "image"       => [ $image ],
            "url" => route('optimize_slug', ['alias1' => @$schema->slug . '.html']),
            "aggregateRating" => [
                "@type" =>      "AggregateRating",
                "bestRating" =>   "5",
                "ratingCount" =>  "24",
                "ratingValue" => "4.6"
            ],
            "offers" => [
                "@type" => "AggregateOffer",
                "highPrice"     =>     @$schema->org_price,
                "lowPrice"      =>      @$schema->sell_price,
                "priceCurrency" => "VND",
                "offerCount"    =>    "2000",
                "offers" => [
                    [
                        "@type"       =>      "Offer",
                        "itemOffered" => "Product",
                        "name"        => @$schema->name,
                        "url"         => route('optimize_slug', ['alias1' => @$schema->slug . '.html'])
                    ],
                    [   "@type"       => "Offer",
                        "itemOffered" => "Product",
                        "name"        => @$schema->name,
                        "url"         => route('optimize_slug', ['alias1' => @$schema->slug . '.html'])
                    ]
                ]
            ]    
        ];
        $schemaCategory = json_encode($schemaCategory);
        $list_category = Category::where('parent_id', @$category->id)->where('status', 'A')->get();

        if(!empty($_GET['color'])){
            $ArrColor = $this->feature->get_features(['slug' => explode(",", $_GET['color'])]);
        }
        if(!empty($_GET['size'])){
            $ArrSize = $this->feature->get_features(['slug' => explode(",",$_GET['size'])]);
        }
        if(!empty($_GET['pattern'])){
            $ArrPattern = $this->feature->get_features(['slug' => explode(",", $_GET['pattern'])]);
        }
        // dd($request->all());
        // dd($category->parent->first()->slug);

        // slide banner
        $slideCategorys = $this->banner->get_banners([
            'status'    => 'A',
            'type'      => 'CATEGORY',
            'published' => 'A',
            'object_id' => @$category->id,
            'extension' => 'image'
        ]);

        return view('Web::danhmuc',[
            'schemaCategory'  => $schemaCategory,
            'products'        => $data,
            'list_category'   => $list_category,
            'features'        => $features,
            'category'        => isset($category) ? $category : '',
            'limit'           => $limit,
            'name'            => isset($request->name) ? @$request->name : '',
            'categoryarr_ids' => isset($code) ? $code : '',
            'color'           => isset($_GET['color']) ? ','.$_GET['color'] : '',
            'size'            => isset($_GET['size']) ? ','.$_GET['size'] : '',
            'pattern'         => isset($_GET['pattern'] ) ? ','.$_GET['pattern'] : '',
            'price'           => isset($_GET['price'] ) ? ($_GET['price'] )  : '',
            'ArrColor'        => isset($ArrColor) ? $ArrColor : '',
            'ArrSize'         => isset($ArrSize) ? $ArrSize : '',
            'ArrPattern'      => isset($ArrPattern) ? $ArrPattern : '',
            'slideCategorys'  => isset($slideCategorys) ? $slideCategorys : ''
        ]);
    }

    public function getCategoryBlog($params = []){
        // dd($params);
        $limit = 18;
        $slug          = ($params[1] != '') ? $params[1] : $params[0];
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
                $checkIdCategory = [];
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
        $slideCategorys = $this->banner->get_banners([
            'status'    => 'A',
            'type'      => 'CATEGORYBLOG',
            'published' => 'A',
            'object_id' => $categoryBlogs->id,
            'extension' => 'image'
        ]);
        // dd($blogs);
        $nameCategory = $categoryBlogs->title_short;
        return view('Web::blog.category_blog', compact('blogs','categoryBlogs','categories','nameCategory','slideCategorys', 'limit'));
    }

    public function getBlogSlug($params = []){
        $slug              = ($params[2] != '') ? $params[2] : $params[1];
        $categoryBlogs     = $this->blogCategory->get_category_slug($params[1]);
        $blog              = $this->blog->get_blog_slug($params[2]);
        if(empty($blog)){
            $blog      = $this->blog->get_blog_slug($params[1]);
        }
        if(empty($blog)){
            return view('Web::error.404');
        }
        $comments          = $this->blogComment->getCommentBlogs($blog->id);
        $blogsCare         = $this->blog->get_blogs_care(10);
        $blogCategoriesall = $this->blog->filter_blogs(['category_id' => $blog->category_id,
                                                        'limit'       => 5
                                                        ]);
        $blogCates         = $this->blog->random_blogs_ref(['blog_category_id' => $blog->blog_category_id,
                                                            'limit' => 6,
                                                            'id'    => $blog->id
                                                        ]);
        $banner = $this->banner->where('type','BLOG')->inRandomOrder()->limit(1)->first();
        $schema = [
            "@context" => "http://schema.org",
            "@type"    => "WebPage",
            "name"     => @$blog->title,
            "mainContentOfPage"  => @$blog->description,
            "primaryImageOfPage" => [
                "@type"     => "ImageObject",
                "caption"   => @$blog->title,
                "contentUrl"=> asset("/storage/editor/blog/category/".$blog->image)
            ],
            "lastReviewed" => "10/22/2020 9:11:02 PM",
            "speakable" =>[
                    "@type"       => "SpeakableSpecification",
                    "cssSelector" => [
                                        "artheadline", 
                                        "spk"
                                    ]
            ],
            "url"=> url()->current()
        ];
        $schema = json_encode($schema);
        $breadcrumb = $this->blogCategory->get_category($blog->blog_category_id);
        // ===============SCHEMA BREADRUMB===============
        $schemaBreadcrumbList = [
            "@context" => "http://schema.org",
            "@type"    => "BreadcrumbList",
            "itemListElement" => [
                [
                    "@type"    => "ListItem",
                    "position" => 1,
                    "item" =>[
                        "@id"  => route('home'),
                        "name" => "Home"
                    ]
                ],
                [
                    "@type"    => "ListItem",
                    "position" => 2,
                    "item" => [
                        "@id"  => route('optimize_slug'),
                        "name" => "Blog"
                    ]
                ],
                [
                    "@type"    => "ListItem",
                    "position" => 3,
                    "item" => [
                            "@id"  => route("optimize_slug",['alias1' => @$breadcrumb->slug.'.html']),
                            "name" => @$breadcrumb->title_short
                        ]
                    ],
                [
                    "@type"    => "ListItem",
                    "position" => 4,
                    "item" => [
                            "@id"  => url()->current(), 
                            "name" => @$blog->title
                        ]
                    ]
                ]
            ];
        $schemaBreadcrumbList = json_encode($schemaBreadcrumbList);
        // ==============================================
        // check amp
       if(strpos(url()->current(), 'amp')!=''){
        return view('Web::amp.blog.blog_detail', compact('blog','blogsCare','breadcrumb','comments','blogCategoriesall','banner', 'schema', 'blogCates', 'schemaBreadcrumbList', 'categoryBlogs'));
       }else{
        return view('Web::blog.blog_detail', compact('blog','blogsCare','breadcrumb','comments','blogCategoriesall','banner', 'schema', 'blogCates', 'schemaBreadcrumbList', 'categoryBlogs'));

       }
    }


    
    public function index(){

        $slides    = $this->banner->get_banners([
            'type' => 'SLIDE',
            'status' => 'A',
            'published'=>'A'
            ]);
        $topblogs = $this->blog->get_blogs([
            'show_home' => 'A'
        ]);
        $whatWedos = $this->blog->get_blogs([
            'show_home' => 'D',
            'position'  => 'HOME'
        ]);
        $userAdmins = $this->user->get_users([
            'user_type' => 'A',
            'show_home' => 'A'
        ]);
        $blogFooters = $this->blog->get_blogs([
            'show_home' => 'D',
            'limit'     =>'4'
        ]);
        $galleris = $this->banner->get_banners([
            'typearr' => ['PROJECT', 'DESIGN','GRAPHIC'], 
            'status' => 'A',
            'published'=>'A',
            'Extence'  =>['image'],
            'limit'     => '6'
            ]);
            $raitings = $this->evaluate->get_evatuates([
                    'review' => 'A',
                    'status' => 'A'
            ]);
        $schema = Schema::where('type', 1)->orderBy('id', 'desc')->first();
       
        return view('Web::home.index',[
            'slides'         => $slides,
            'topblogs'      => $topblogs,
            'whatWedos'     => $whatWedos,
            'userAdmins'    => $userAdmins,
            'galleris'       => $galleris,
            'raitings'      => $raitings,
            'blogFooters'   => $blogFooters,
            'schema'        => $schema
        ]);
    }
    
    public function sitemap(){
        $blogs       = $this->blog->get_blogs();
        $products    = $this->product->get_products(['status', 'A', 'parent_product_id', '0']);
        $category    = $this->category->get_categories(['status' => 'A']);
        $cateParents = $category->where('parent_id','0');
        return response()->view('Web::home.sitemap', compact('blogs', 'cateParents', 'category', 'products'))->header('Content-Type', 'text/xml');
    }

    public function getPages($slug){
        $footerPage = $this->blog->get_blog_slug($slug);
        $categoryLefts =  $this->blogCategory->get_categories([
            'Position' => 'FOOTER',
            'status'   =>'A'
        ]);
        $split_slug = explode('/', url()->current())[4];
        if($split_slug == 'cau-hoi-thuong-gap.html'){
            return view('Web::pages-footer.question_frequently',compact('footerPage','slug','categoryLefts'));
        }else{
            return view('Web::pages-footer.pages',compact('footerPage','slug','categoryLefts'));
        }
    }

    public function getPagesNone($slug)
    {
        $footerPage = $this->blog->get_blog_slug($slug);
        return view('Web::pages-footer.none',compact('footerPage','slug'));
    }

    public function get404()
    {
        return view('Web::error.404');
    }
  
    public function about(){
        
        return view('Web::home.about');
    }
    
    public function contact(){
        $sliders = $this->banner->get_banners(['type' => 'SLIDE_CONCTACT']);
    
        return view('Web::home.contact', ['sliders' => $sliders]);
    }
    
    public function postContact(Request $request){
        $data = $request->except('_token');
        // dd($data['contact_email']);
        $this->feedback->fullname = $data['fullname'];
        $this->feedback->email    = $data['email'];
        $this->feedback->phone    = $data['phone'];
        $this->feedback->content  = $data['content'];
        $this->feedback->save();
        
        $mail = new MailTemplate();
        $user = $this->feedback;
        $user->email = 'duc.ntd@gmail.com';
        $mail->sendMail([
            'type'   => 'FEEDBACK_CUSTOMER',
            'object' => $user
        ]);
        return redirect()->back()->with('success', 'Cảm ơn bạn đã gửi phản hồi đến chúng tôi!');
    }

    public function pageStatic($alias){
        $alias = explode('.', $alias);
        return view('PageStatic::html.'.$alias[0]);
    }
    
    
    public function reciveInfoMail(Request $request){
        $data = $request->except('_token');
        $check_mail_duplicate = $this->reciveMail->get_mails(['email' => $data['email']]);
        if(count($check_mail_duplicate) > 0){
            return redirect()->back()->with('error', 'Bạn đã đăng ký nhận thông tin rồi mà!');
        }else{
            $this->reciveMail->email = $data['email'];
            $this->reciveMail->save();
            $mail = new MailTemplate();
            $user = $this->reciveMail;
            $user->email = $data['email'];
            $mail->sendMail([
                'type'   => 'RECIVE_INFO',
                'object' => $user
            ]);
            return redirect()->back()->with('success', 'Cảm ơn bạn đã đăng ký nhận thông tin từ chúng tôi!');
        }
    
    }

}