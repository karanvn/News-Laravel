<?php

namespace App\Modules\Blog\Controllers;

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Modules\Blog\Models\Blog;
use App\Modules\Banner\Models\Banner;
use App\Modules\Blog\Models\BlogCategory;
use App\Modules\Blog\Models\BlogComment;
use App\Modules\Slug\Models\SlugOptimize;
use File;
use WebPConvert\WebPConvert;
use Illuminate\Foundation\Bus\DispatchesJobs;

use Illuminate\Support\Str;
class BlogController extends SiteController
{
    public function __construct()
    {
        $this->blog = new Blog();
        $this->blogCategory = new BlogCategory();
        $this->blogComment = new BlogComment();
        $this->banner = new Banner;
        $blogCategories = $this->blogCategory->get_categories();
        view()->share('blogCategories',$blogCategories);
       
    }
    function list(Request $request)
    {
        $request->request->add([
            'limit'            => '8'
            ]);
        $categories = BlogCategory::orderBy('position', 'ASC')->get();
        $blogs = $this->blog->get_blogs();
        if(!empty($request->all()))
        {
            $blogs = $this->blog->filter_blogs($request->all());
        }
        
        return view('Blog::admin.blog.list',[
            'blogs' => $blogs,
            'categories' => $categories,
            'id' => !empty($request->id) ? $request->id : '',
        'title_short' => !empty($request->title_short) ? $request->title_short : '',
        'blog_category_id' => !empty($request->blog_category_id) ? $request->blog_category_id : '',
        'status' => !empty($request->status) ? $request->status : ''
        ]);
    }
    function getAdd()
    {
        $categories = $this->blogCategory->get_categories(['parent_id' => '0']);
        return view('Blog::admin.blog.add',compact('categories'));
    }
    function postAdd(Request $request)
    {
        $pattern = [
            'title'             => 'required|max:255|unique:blog,title',
            'title_short'       => 'required|max:255|unique:blog,title_short',
            'status'            => 'required',
            'blog_category_id'  => 'required',
        ];
        $messenger = [
            'required'              =>  ':attribute '.trans('Blog::blogcategory.add.form.errors.required'),
            'title.max'             =>  ':attribute '.trans('Blog::blogcategory.add.form.errors.max'),
            'unique'                =>  ':attribute '.trans('Blog::blogcategory.add.form.errors.unique'),
        ];
        $customAttributes = [
            'title'             => 'Tên blog',
            'title_short'       => 'Tên blog ngắn',
            'status'            => 'Trạng thái',
            'blog_category_id'  => 'Danh mục'
        ];
        $validator = Validator::make($request->all(),$pattern,$messenger,$customAttributes);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $slug = url_slug(isset($request->slug)?$request->slug:$request->title_short);
        if($request->hasFile('image'))
        {
        	$file = $request->file('image');
        	$duoi = $file->getClientOriginalExtension();
        	if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
        	{
        		return redirect()->route('blog-category-add')->with('error','Bạn chỉ được chọn file có đuôi là jpg, png, jpeg');
        	}
        	$name = $slug;
        	$Hinh = Str::random(4).'-'.$name;
        	while (file_exists("storage/editor/blog".$Hinh)) {
        		# code...
        		$Hinh =   Str::random(4).'-'.$name;
        	}
        	$file->move("storage/editor/blog",$Hinh.'.'.$duoi);
            $request->image = $Hinh.'.'.$duoi;
            //dd($request->image);

            $nameImg = $Hinh;
            $options = [];

                // webp img
            $sourceWebp = 'storage/editor/blog/'.$Hinh.'.'.$duoi;
            $destination ='storage/editor/blog/'.$nameImg.'.webp';
            WebPConvert::convert($sourceWebp, $destination, $options);
        }
        else{
            $request->image = 'thumbnail_placeholder.png';
        }

        // ===========================
        $url_slug = new SlugOptimize();
        $url_slug->slug      = $slug;
        $url_slug->object_id = $request->blog_category_id;  
        $url_slug->type = 4;
        $url_slug->save();
        // ===========================

        $image = $request->image;
        $user_id = Auth::user()->id;
        $data = array_merge($request->all(),['image'=>$image,'user_id'=>$user_id]);
        $this->blog->save_blog($data);
        return redirect()->route('blog-list')->with(['message'=>'Thêm thành công']);
    }
    function getEdit($id)
    {
        $blog = $this->blog->get_blog_id($id);
        $categories = $this->blogCategory->get_categories(['parent_id' => '0']);
        $selected_categories = $blog->category()->get();
        return view('Blog::admin.blog.edit',[
            'blog' => $blog,
            'categories' => $categories,
            'selected_categories' => $selected_categories
            ]);
    }
    function postEdit(Request $request)
    {
       
       
        $id = !empty($request->id) ? $request->id : 0;
        $pattern = [
            'title'             => 'required|max:255',
            'title_short'       => 'required|max:255',
            'status'            => 'required',
            'blog_category_id'  => 'required',
        ];
        $messenger = [
            'required'              =>  ':attribute '.trans('Blog::blogcategory.add.form.errors.required'),
            'title.max'             =>  ':attribute '.trans('Blog::blogcategory.add.form.errors.max'),
            'unique'                =>  ':attribute '.trans('Blog::blogcategory.add.form.errors.unique'),
        ];
        $customAttributes = [
            'title'             => 'Tên blog',
            'title_short'       => 'Tên blog ngắn',
            'status'            => 'Trạng thái',
            'blog_category_id'  => 'Danh mục'
        ];

        if(!empty($request->slug)){
            @$slug_check = $this->blog->get_blogs(['slug' => $request->slug ])[0];
            // dd($slug_check);
            if($slug_check != null){
                if($slug_check->id != $id){
                    $conditions['slug'] = 'required';
                    $messages['slug.required'] = trans($prefix_errors_trans . 'check_slug');
                    $request->slug = "";
                }
            }
        }

        $validator = Validator::make($request->all(),$pattern,$messenger,$customAttributes);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $slug = url_slug(isset($request->slug)?$request->slug:$request->title_short);
        if($request->hasFile('image'))
        {
        	$file = $request->file('image');
        	$duoi = $file->getClientOriginalExtension();
        	if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
        	{
        		return redirect()->route('blog-category-add')->with('error','Bạn chỉ được chọn file có đuôi là jpg, png, jpeg');
        	}
        	$name = $slug;
        	$Hinh = Str::random(4).'-'.$name;
        	while (file_exists("storage/editor/blog".$Hinh)) {
        		# code...
        		$Hinh =   Str::random(4).'-'.$name;
        	}
        	$file->move("storage/editor/blog",$Hinh.'.'.$duoi);
            $request->image = $Hinh.'.'.$duoi;
            //dd($request->image);

            $nameImg = $Hinh;
            $options = [];

                // webp img
            $sourceWebp = 'storage/editor/blog/'.$Hinh.'.'.$duoi;
            $destination ='storage/editor/blog/'.$nameImg.'.webp';
            WebPConvert::convert($sourceWebp, $destination, $options);
        }
        $image = $request->image;
        $user_id = Auth::user()->id;
        $data = array_merge($request->all(),['image'=>$image,'user_id'=>$user_id]);
       
        // Handle add & update slug for table slug
        SlugOptimize::where('slug', $slug)->where('object_id', $request->id)->delete();
        $url_slug = new SlugOptimize();
        $url_slug->slug      = $slug;
        $url_slug->object_id = $request->id; 
        $url_slug->type = 4;
        $url_slug->save();
        // End andle add & update slug for table slug
        $this->blog->get_blog_id($request->id)->edit_blog($data);
        return redirect()->route('blog-list')->with(['message'=>'Sửa thành công']);
    }
    function getDelete($id)
    {
        $result = $this->blog->delete_category($id);
        $messege = 'Xóa thất bại';
        if($result){
            $messege = 'Xóa thành công';
        }
        return redirect()->route('blog-list')->with(['message'=>$messege]);
    }
   
    //Page tĩnh
    function getStaticPage()
    {
        $blogs = Blog::orderBy('blog_category_id', 'ASC')->get();
        return view('Blog::admin.static-page.list',compact('blogs'));
    }
    function getAddStaticPage()
    {
        $categories = BlogCategory::where('parent_id',35)->get();
        
        return view('Blog::admin.static-page.add',compact('categories'));
    }
    function postAddStaticPage(Request $request)
    {
        $pattern = [
            'title'             => 'required|max:255',
            'title_short'       => 'required|max:255',
            'content'           => 'required',
            'status'            => 'required',
            'blog_category_id'  => 'required'
        ];
        $messenger = [
            'required'              =>  ':attribute '.trans('Blog::blogcategory.add.form.errors.required'),
            'max'                   =>  ':attribute '.trans('Blog::blogcategory.add.form.errors.max'),
        ];
        $customAttributes = [
            'title'             => 'Tên Page tĩnh',
            'title_short'       => 'Tên Page Tĩnh ngắn',
            'content'           => 'Nội dung',
            'status'            => 'Trạng thái',
            'blog_category_id'  => 'Danh mục'
        ];
        $validator = Validator::make($request->all(),$pattern,$messenger,$customAttributes);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $slug = url_slug(isset($request->slug)?$request->slug:$request->title_short);
        if($request->hasFile('image'))
        {
        	$file = $request->file('image');
        	$duoi = $file->getClientOriginalExtension();
        	if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
        	{
        		return redirect()->route('blog-category-add')->with('error','Bạn chỉ được chọn file có đuôi là jpg, png, jpeg');
        	}
        	$name = $slug;
        	$Hinh = Str::random(4).'-'.$name;
        	while (file_exists("storage/editor/blog".$Hinh)) {
        		# code...
        		$Hinh =   Str::random(4).'-'.$name;
        	}
        	$file->move("storage/editor/blog",$Hinh.'.'.$duoi);
            $request->image = $Hinh.'.'.$duoi;
            //dd($request->image);
        }
        else{
            $request->image = 'thumbnail_placeholder.png';
        }
        $image = $request->image;
        $user_id = Auth::user()->id;
        $data = array_merge($request->all(),['image'=>$image,'user_id'=>$user_id]);
        $staticPage = new Blog;
        $staticPage->save_blog($data);
        return  redirect()->route('static-page')->with(['messenger'=>'Thêm thành công!']);
    }
    function getEditStaticPage($id)
    {
        $blog = $this->blog->get_blog_id($id);
        $categories = $this->blogCategory->get_categories();
        return view('Blog::admin.static-page.edit',compact('blog','categories'));
    }
    function postEditStaticPage(Request $request)
    {
        $pattern = [
            'title'             => 'required|max:255',
            'title_short'       => 'required|max:255',
            'content'           => 'required',
            'status'            => 'required',
            'blog_category_id'  => 'required',
        ];
        $messenger = [
            'required'              =>  ':attribute '.trans('Blog::blogcategory.add.form.errors.required'),
            'title.max'             =>  ':attribute '.trans('Blog::blogcategory.add.form.errors.max'),
            'unique'                =>  ':attribute '.trans('Blog::blogcategory.add.form.errors.unique'),
        ];
        $customAttributes = [
            'title'             => 'Tên blog',
            'title_short'       => 'Tên blog ngắn',
            'content'           => 'Nội dung',
            'status'            => 'Trạng thái',
            'blog_category_id'  => 'Danh mục'
        ];
        $validator = Validator::make($request->all(),$pattern,$messenger,$customAttributes);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $slug = url_slug(isset($request->slug)?$request->slug:$request->title_short);
        if($request->hasFile('image'))
        {
        	$file = $request->file('image');
        	$duoi = $file->getClientOriginalExtension();
        	if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
        	{
        		return redirect()->route('blog-category-add')->with('error','Bạn chỉ được chọn file có đuôi là jpg, png, jpeg');
        	}
        	$name = $slug;
        	$Hinh = Str::random(4).'-'.$name;
        	while (file_exists("storage/editor/blog".$Hinh)) {
        		# code...
        		$Hinh =   Str::random(4).'-'.$name;
        	}
        	$file->move("storage/editor/blog",$Hinh.'.'.$duoi);
            $request->image = $Hinh.'.'.$duoi;
            //dd($request->image);
        }
        $image = $request->image;
        $user_id = Auth::user()->id;
        $data = array_merge($request->all(),['image'=>$image,'user_id'=>$user_id]);
        dd($this->blog->get_blog_id($request->id));
        $this->blog->get_blog_id($request->id)->edit_blog($data);
        
        return redirect()->route('static-page')->with(['message'=>'Sửa thành công']);
    }

    function treeblog($id, Request $request){
        $categories = $this->blogCategory->get_categories(['parent_id' => $id]);
        if(!empty($categories)){
            $result = [
                'success' =>  true,
                'html' => view('Blog::admin.blog.form.tree', ['categories' => $categories, 'flag' => $request->flag])->render()
            ];
        }else{
            $result = [
                'success' => false,
            ];
        }
        return response()->json($result);
    }
    function seachAddCategory($name = ''){
        if(!empty($name)){
            $blogs = $this->blog->get_blogs([
                'title' => $name,
                'limit' => '7',
                'status'    =>'A'
            ]);
        $html = view('Blog::admin.blog.pages.searchBlogInCategory', [
            'blogs'     =>$blogs
        ])->render();

            $result = [
                'data' => $html,
            ];
        }else{
            $result = [
                'data' => '',
            ];
        }

        return response()->json($result);
    }
}
