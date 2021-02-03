<?php

namespace App\Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    //
    protected $table = "blog_category";
    public function blogs(){
        return $this->HasMany('App\Modules\Blog\Models\Blog', 'blog_category_id', 'id');
    }
    public function parent(){
        return $this->hasOne('App\Modules\Blog\Models\BlogCategory', 'id', 'parent_id');
    }
    public function banners(){
        return $this->hasMany('App\Modules\Banner\Models\Banner', 'object_id', 'id');
    }
   
    public function categories(){
        return $this->hasMany('App\Modules\Blog\Models\BlogCategory', 'parent_id', 'id');
    }
    public function scopeId($query, $id)
    {
        if(!empty($id)){
            $query->where('id',$id);
        }
        return $query;
    }
    public function scopeParentId($query, $parent_id)
    {
        if(!empty($parent_id)){
            $query->where('parent_id',$parent_id);
        }
        return $query;
    }
    public function scopeTitle($query, $categoryid)
    {
        if(!empty($id)){
            $query->where('title',$id);
        }
        return $query;
    }
    public function scopeTitleShort($query, $title_short)
    {
        if(!empty($title_short)){
            $query->where('title_short',$title_short);
        }
        return $query;
    }
    public function scopeDescription($query, $description)
    {
        if(!empty($description)){
            $query->where('description',$description);
        }
        return $query;
    }
    public function scopeSlug($query, $slug)
    {
        if(!empty($slug)){
            $query->where('slug',$slug);
        }
        return $query;
    }
    public function scopeShowHome($query, $home)
    {
        if(!empty($home)){
            $query->where('showHome', $home);
        }
        return $query;
    }
    public function scopeStatus($query, $status)
    {
        if(!empty($status)){
            $query->where('status',$status);
        }
        return $query;
    }
    public function scopeSeoTitle($query, $seo_title)
    {
        if(!empty($seo_title)){
            $query->where('seo_title',$seo_title);
        }
        return $query;
    }
    public function scopeSeoDescription($query, $seo_description)
    {
        if(!empty($seo_description)){
            $query->where('seo_description',$seo_description);
        }
        return $query;
    }
    public function scopeSeoLink($query, $seo_link)
    {
        if(!empty($seo_link)){
            $query->where('seo_link',$seo_link);
        }
        return $query;
    }
    
    public function scopePosition($query, $position)
    {
        if(!empty($position)){
            $query->where('position',$position);
        }
        return $query;
    }
    public function scopeParent($query, $Parent)
    {
        if(isset($Parent)){
            $query->where('parent_id',$Parent);
        }
        return $query;
    }
    
    function get_categories($params = []){
        $blog_category = $this->query()
                ->id(@$params['id'])
                ->title(@$params['title'])
                ->Parent(@$params['parent_id'])
                ->Position(@$params['Position'])
                ->ShowHome(@$params['showHome'])
                ->status(@$params['status']);
        return !empty($params['limit']) ? $blog_category->paginate($params['limit']) : $blog_category->get();
    }
    // function get_categories_parent(){
    //     $blog_category = $this->query()
    //              ->ParentId(null)->get();
    //     return is_null($blog_category) ? false : $blog_category;
    // }
    function get_category($id)
    {
        if(!empty($id)){
            $category = $this->query()->id(@$id)->first();
            return is_null($category) ? false : $category;
        }
        return false;
    }
    function get_category_slug($slug) 
    {
        if(!empty($slug)){
            $category = $this->query()->slug(@$slug)->first();
            return is_null($category) ? false : $category;
        }
        return false;
    }
    function edit_category($params=[])
    {
        //dd($request);
        $slug = url_slug(isset($params['slug'])? $params['slug']:$params['title_short']);
        $this->parent_id       = @$params['parent_id'];
        $this->title           = $params['title'];
        $this->title_short     = @$params['title_short'];
        $this->description     = @$params['description'];
        $this->showHome     = @$params['showHome'];
        //dd($params['image']);
        if($params['image']!=null)
        $this->image           = $params['image'];
        $this->slug            = @$slug;
        $this->status          = @$params['status'];
        $this->position        = @$params['position'];
        $this->seo_title       = @$params['seo_title'];
        $this->seo_description = @$params['seo_description'];
        $this->seo_link        = @$params['seo_link'];
         $this->seo_keywords   = @$params['seo_keywords'];
        $this->type            = @$params['type'];
        $this->save();
        return $this->id;
    }
    function delete_category($id)
    {
        if(isset($id)){
            $category = $this->query()->id(@$id)->delete();
            return true;
        }
        return false;
    }
    
    function save_category($params = []){
        //dd($params);
        $slug = url_slug(isset($params['slug'])? $params['slug']:$params['title_short']);
        $this->title           = $params['title'];
        $this->parent_id       = @$params['parent_id'];
        $this->title_short     = @$params['title_short'];
        $this->description     = @$params['description'];
        $this->image           = $params['image'];
        $this->slug            = @$slug;
        $this->showHome     = @$params['showHome'];
        $this->status          = @$params['status'];
        $this->position        = @$params['position'];
        $this->seo_title       = @$params['seo_title'];
        $this->seo_description = @$params['seo_description'];
        $this->seo_link        = @$params['seo_link'];
        $this->seo_keywords   = @$params['seo_keywords'];
        $this->type            = @$params['type'];
        $this->save();
        return $this->id;
    }

}
