<?php

namespace App\Modules\Blog\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Blog\Models\Blog;
use App\Modules\Blog\Models\BlogComment;
use App\Modules\Blog\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogCommentController extends Controller
{
    //
    function __construct()
    {
        $this->blog = new Blog;
        $this->comment = new BlogComment;
        $this->blogCategory = new BlogCategory;
        $blogCategories = $this->blogCategory->get_categories();
        view()->share('blogCategories',$blogCategories);
    }
    function list($blog_id)
    {
        $blog = $this->blog->get_blog_id($blog_id);
        $comments = $blog->comments;
        //dd($comments);
        return view('Blog::admin.blog-comment.list',compact('comments'));
    }
    function detail($id)
    {
        $comment = $this->comment->getComment($id);
        $replies = $this->comment->where('parent_id',$id)->get();
        //dd($reply);
        return view('Blog::admin.blog-comment.detail',compact('comment','replies'));
    }
    function postAdd(Request $request)
    {
        $pattern = [
            'comment'    => 'required|max:255',
        ];
        $messenger = [
            'required'   =>  ':attribute '.trans('Blog::blogcategory.add.form.errors.required'),
        ];
        $customAttributes = [
            'comment'    => 'Bình luận ',
        ];
        //dd($request->all());

        $this->comment->saveComment(array_merge($request->all(),['status'=>'A']));
        return redirect()->back()->with('message','Bạn đã trả lời thành công!');
    }
    function getDelete($id)
    {
        $blog_id = $this->comment->getComment($id)->blog_id;
        //dd($blog_id);
        $this->comment->deleteComment($id);
        return redirect()->route('comment-list',$blog_id)->with('message','Xóa thành công');
    }
    function getStatus($id)
    {
        $comment = $this->comment->getComment($id);
        $status = 'D';
        if($comment->status == 'D')
            $status = 'A';
        $comment->editStatus(['status' => $status]);
        return redirect()->back()->with('message','Thay đổi trạng thái thành công');
    }
    function postComment(Request $request)
    {
        $pattern = [
            'name'       => 'required|max:255',
            'email'      => 'required|max:255',
            'comment'    => 'required|max:255',
        ];
        $messenger = [
            'required'   =>  ':attribute '.trans('Blog::blogcategory.add.form.errors.required'),
        ];
        $customAttributes = [
            'name'       => 'Tên ',
            'email'      => 'Địa chỉ email ',
            'comment'    => 'Bình luận ',
        ];
        $validator = Validator::make($request->all(),$pattern,$messenger,$customAttributes);
        if ($validator->fails()) {
            return redirect()->back()->with('error','Xin hảy điền đầy đủ thông tin!');
        }
        //dd($request->all());
        $comment    = new BlogComment;
        if(empty($request->parent_id)){
            $request->request->add([
                'parent_id'  =>'0',
                ]);
        }
        $comment->saveComment(array_merge($request->all(),['status'=>'D']));
        return redirect()->back()->with('success','Bạn đã bình luận thành công!');
        
    }

    public function lists(Request $request){
       
        if(!isset($request->parent)){
        $request->request->add(['parent' => '0']);
    }
        $request->request->add(['limit' => '5']);
    if(!isset($request->page)){
        $request->request->add(['page' => '1']);
    }
       $data = $this->comment->get_comments($request->all());
      
    return view('Blog::admin.blog-comment.lists',[
        'datas' => $data,
        'status' => !empty($request->status) ? $request->status : '',
        'nameBlog' => !empty($request->nameBlog) ? $request->nameBlog : ''
    ]);
    }
    public function editStatusCommentBlog($id){
        $data = BlogComment::find($id);
        if($data->status == 'A'){
            $data->status = 'D';
        }else{
            $data->status = 'A';
        }
        $data->save();
        return redirect()->back()->with(['success' => 'Đã chỉnh sửa thành công']);
    }
    public function deleteStatusCommentBlog($id){
        $data = BlogComment::find($id);
        $data->delete();
        return redirect()->back()->with(['success' => 'Đã xoá thành công']);
     }
}
