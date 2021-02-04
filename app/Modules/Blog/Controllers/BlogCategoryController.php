<?php

namespace App\Modules\Blog\Controllers;

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Modules\Blog\Models\BlogCategory;
use App\Modules\Blog\Models\Blog;
use Illuminate\Support\Str;
use App\Modules\Banner\Models\Banner;
use App\Libraries\Upload;
use App\Modules\Slug\Models\SlugOptimize;


class BlogCategoryController extends SiteController
{
    function __construct()
    {
        $this->blogCategory = new BlogCategory;
        $this->banner = new Banner();
        $this->blog = new Blog;
        $blogCategories = $this->blogCategory->get_categories();
        view()->share('blogCategories',$blogCategories);
        
    }
    function list()
    {   
        $blogCategories = $this->blogCategory->get_categories();
        $blogCategories = BlogCategory::where('parent_id','0')->orderBy('position', 'ASC')->get();
        //dd($blogCategory);
        return view('Blog::admin.blog-category.list',compact('blogCategories'));
    }
    function getAdd()
    {
        //$categoriesparent = $this->blogCategory->get_categories_parent(null);
        //dd($categoriesparent);
        $categoriesparent = BlogCategory::where('parent_id','0')->get();
        return view('Blog::admin.blog-category.add',compact('categoriesparent'));
    }
    function processBanner($banner_id = 'NONE'){
        $result = [];
        if($banner_id != 'NONE'){
            $banner = $banner_id != 'ADD' ?  $this->banner->get_banner($banner_id) : $this->banner;
            $result['html'] = view('Blog::admin.blog-category.banner', ['banner' => $banner])->render();
            $result['banner'] = $banner;
        }else{
            $result['banner'] = false;
            $result['html'] ='------';
        }
        $result['success'] = true;
        return response()->json($result);
    }

    function postAdd(Request $request)
    {
        // dd($request->slug);
        $pattern = [
            'title'       => 'required|max:255',
            'title_short' => 'required|max:255',
            'description' => 'required',
            'status'      => 'required',
        ];
        $messenger = [
            'required'              =>  ':attribute '.trans('Blog::blogcategory.add.form.errors.required'),
            'max'                   =>  ':attribute '.trans('Blog::blogcategory.add.form.errors.max'),
            'title.unique'          =>  ':attribute '.trans('Blog::blogcategory.add.form.errors.unique'),
            'status.required'       =>  ':attribute '.trans('Blog::blogcategory.add.form.errors.required'),
        ];
        $customAttributes = [
            'title'  => 'Tên danh mục',
            'description' => 'Mô tả',
            'title_short' => 'Tên danh mục ngắn',
            'status'     => 'Trạng thái'
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
        	while (file_exists("storage/editor/blog/category".$Hinh)) {
        		# code...
        		$Hinh =   Str::random(4).'-'.$name;
        	}
        	$file->move("storage/editor/blog/category",$Hinh.'.'.$duoi);
            $request->image = $Hinh.'.'.$duoi;
            //dd($request->image);
        }
        else{
            $request->image = 'thumbnail_placeholder.png';
        }

        
        $image = $request->image;
        $data = array_merge($request->all(),['image'=>$image]);
        $blogCategory = $this->blogCategory->save_category($data);
        
        // ===========================
        SlugOptimize::where('slug', $request->slug)->where('object_id', $blogCategory)->delete();
        $url_slug = new SlugOptimize();
        $url_slug->slug      = $request->slug;
        $url_slug->object_id = $blogCategory; 
        $url_slug->type = 3;
        $url_slug->save();
        // ===========================
        // banner
      
        // end banner
        //dd($request->all());
        return redirect()->route('blog-category-list')->with(['message'=>'Thêm thành công']);
    }
    function getEdit($id)
    {
        $category = $this->blogCategory->get_categories(['id'=>$id])->first();
        $categoriesparent = BlogCategory::where('parent_id','0')->get();
        //dd($category);
        return view('Blog::admin.blog-category.edit', compact('category','categoriesparent'));
    }
    function postEdit(Request $request)
    {
       
        $pattern = [
            'title'       => 'required|max:255',
            'title_short' => 'required|max:255',
            'status'      => 'required',
        ];
        $messenger = [
            'required'        =>  ':attribute '.trans('Blog::blogcategory.add.form.errors.required'),
            'max'                   =>  ':attribute '.trans('Blog::blogcategory.add.form.errors.max'),
            'status.required'       =>  ':attribute '.trans('Blog::blogcategory.add.form.errors.required'),
        ];
        $customAttributes = [
            'title'  => 'Tên danh mục',
            'description' => 'Mô tả',
            'title_short' => 'Tên danh mục ngắn',
            'status'     => 'Trạng thái'
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
        	// if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
        	// {
        	// 	return redirect()->route('blog-category-add')->with('error','Bạn chỉ được chọn file có đuôi là jpg, png, jpeg');
        	// }
        	$name = $slug;
        	$Hinh = Str::random(4).'-'.$name;
        	while (file_exists("storage/editor/blog/category".$Hinh)) {
        		# code...
        		$Hinh =   Str::random(4).'-'.$name;
        	}
        	$file->move("storage/editor/blog/category",$Hinh.'.'.$duoi);
            $request->image = $Hinh.'.'.$duoi;
            //dd($request->image);
        }
        $image = $request->image;
        $data = array_merge($request->all(),['image'=>$image]);
        $blogCategory = $this->blogCategory->get_category($request->id)->edit_category($data);
       
        
        // Handle add & update slug for table slug
        SlugOptimize::where('slug', $request->slug)->where('object_id', $blogCategory)->delete();
        $url_slug = new SlugOptimize();
        $url_slug->slug      = $request->slug;
        $url_slug->object_id = $blogCategory; 
        $url_slug->type = 3;
        $url_slug->save();
        // End handle add & update slug for table slug
        
        // check banner
      
      
     




        return redirect()->route('blog-category-list')->with(['message'=>'Sửa thành công']);
    }
    function getDelete($id)
    {
        $result = $this->blogCategory->delete_category($id);
        $messege = 'Xóa thất bại';
        if($result){
            $messege = 'Xóa thành công';
        }
        return redirect()->route('blog-category-list')->with(['message'=>$messege]);
    }
    function getCategoryBlog($slug)
    {
        //$categories = $this->blogCategory->get_categories_parent();
        $categories = $this->blogCategory->where('parent_id','0')->get();
        //dd($categories);
        $categoryBlogs = $this->blogCategory->get_category_slug($slug);
        if($categoryBlogs->parent_id == '0'){
            $categoriesParents = $this->blogCategory->where('parent_id',$categoryBlogs->id)->get();
            if(count($categoriesParents)<=0){
                $data = [
                    'blog_category_id'  =>  $categoryBlogs->id,
                    'limit'             => 24
                ];
            }else{
                $checkIdCategory = [];
                foreach($categoriesParents as $categoriesParent){
                    $checkIdCategory[] = $categoriesParent->id;
                }
                $data = [
                    'blog_category_idArr'  =>  $checkIdCategory,
                    'limit'             => 24
                ];
            }
        }else{
            $data = [
                'blog_category_id'  =>  $categoryBlogs->id,
                'limit'             => 24
            ];
        }
        $blogs = $this->blog->get_blogs($data);
        $nameCategory = $categoryBlogs->title_short;
        return view('Blog::home.category-blog', compact('blogs','categoryBlogs','categories','nameCategory'));
    }
    function categoryselected($category){
        $category =BlogCategory::where('id',$category)->first();
        // dd($category);
        if(!empty($category)){
         
                $result = [
                    'id' => $category->id,
                    'text' =>$category->title,
                    'position' => $category->position
                ];
            return response()->json($result);
        }
    }
}
