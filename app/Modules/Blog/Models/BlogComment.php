<?php

namespace App\Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $table = 'blog_comment';
    public function blog(){
        return $this->belongsTo('App\Modules\Blog\Models\Blog', 'blog_id', 'id');
    }

    public function child()
    {
        return $this->hasMany('App\Modules\Blog\Models\BlogComment', 'parent_id','id');
    }
    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function scopeNameBlog($query, $name)
    {
        if(!empty($name))
            return $query->whereHas('blog', function($q) use($name) {
                $q->where('blog.title','like', '%'.$name.'%');
            });
    }
    public function scopeId($query, $id)
    {
        if(!empty($id)){
            $query->where('id',$id);
        }
        return $query;
    }
    public function scopeParentID($query, $parent_id)
    {
        if(isset($parent_id)){
            $query->where('parent_id',$parent_id);
        }
        return $query;
    }
    public function scopeUserId($query, $user_id)
    {
        if(!empty($user_id)){
            $query->where('user_id',$user_id);
        }
        return $query;
    }
    public function scopeBlogId($query, $blog_id)
    {
        if(!empty($blog_id)){
            $query->where('blog_id',$blog_id);
        }
        return $query;
    }
    public function scopeName($query, $name)
    {
        if(!empty($name)){
            $query->where('name',$name);
        }
        return $query;
    }
    public function scopeEmail($query, $email)
    {
        if(!empty($email)){
            $query->where('email',$email);
        }
        return $query;
    }

    public function scopeOrder($query, $orderBy)
    {
        if(!empty($orderBy))
            $query->orderBy($orderBy[0], $orderBy[1]);
        else
            $query->orderBy('id', 'desc');
        return $query;
    }

    public function scopeParent($query, $parent)
    {
        if(isset($parent))
            $query->where('parent_id', $parent);
        return $query;
    }

    public function scopeStatus($query, $status)
    {
        if(!empty($status))
           {
            $query->where('status', $status);
           }
        return $query;
    }
    public function scopeComment($query, $comment)
    {
        if(!empty($comment)){
            $query->where('comment',$comment);
        }
        return $query;
    }
    function getCommentBlogs($blog_id)
    {
        if(!empty($blog_id)){
            $commentBlogs = $this->query()
                                    ->BlogId(@$blog_id)
                                    ->get();
            return is_null($commentBlogs) ? false : $commentBlogs;
        }
    }
    function getComment($id)
    {
        if(!empty($id)){
            $comment = $this->query()
                        ->id(@$id)
                        ->first();
            return is_null($comment) ? false : $comment;
        }
    }
    function getParentID($parent_id)
    {
        if(!empty($id)){
            $comment = $this->query()
                        ->ParentID(@$parent_id)
                        ->get();
            return is_null($comment) ? false : $comment;
        }
    }
    function deleteComment($id)
    {
        if(isset($id)){
            $comment = $this->query()->id(@$id)->delete();
            return true;
        }
        return false;
    }
    function saveComment($params = [])
    {
        $this->id           = @$params['id'];
        $this->parent_id    = @$params['parent_id'];
        $this->user_id      = @$params['user_id'];
        $this->blog_id      = @$params['blog_id'];
        $this->name         = @$params['name'];
        $this->email        = @$params['email'];
        $this->comment      = @$params['comment'];
        $this->status       = @$params['status'];
        $this->save();
    }
    function editStatus($params = [])
    {
        $this->status       = @$params['status'];
        $this->save();
    }

      public function get_comments($params = []){
        $get_comments = $this->query()
        ->status(@$params['status'])
        ->NameBlog(@$params['nameBlog'])
        ->parent(@$params['parent'])
        ->order(@$params['orderBy']);
        return !empty($params['limit']) ? $get_comments->paginate($params['limit']) : $get_comments->get();
    }


}
