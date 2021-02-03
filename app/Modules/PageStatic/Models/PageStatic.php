<?php

namespace App\Modules\PageStatic\Models;

use Illuminate\Database\Eloquent\Model;

use App\Modules\Partner\Traits\Filterable;

class PageStatic extends Model
{
    use Filterable;
    protected $table = 'page_static';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


    public function scopeStatus($query, $status)
    {
        if(!empty($status))
            $query->where('status', $status);
        return $query;
    }

    // public function scopeType($query, $type)
    // {
    //     if(!empty($type))
    //         $query->where('type', $type);
    //     return $query;
    // }

    public function scopeName($query, $name)
    {
        if(!empty($name))
            $query->where('name', 'like', '%'.$name.'%');
        return $query;
    }
    public function scopeExtence($query, $Extence)
    {
        if(!empty($Extence))
            $query->whereIn('extension', $Extence);
        return $query;
    }
    public function scopeObject_id($query, $object_id)
    {
        if(!empty($object_id))
            $query->where('object_id', $object_id);
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

    public function scopePublished($query, $published)
    {
        $current = date('Y-m-d H:i:s');

        switch($published){
            case 'A':
                $query->where('published_start', '<=', $current);
                $query->where('published_end', '>=', $current);
            break;
            case 'H':
                $query->where('published_start', '>', $current);
            break;
            case 'E':
                $query->where('published_end', '<', $current);
            break;
        }
        return $query;
    }

    // public function get_page_slug($slug){
    //     if(!empty($slug)){
    //         $page = $this->where('slug', $slug)->get()->first();
    //         return is_null($page) ? false : $page;
    //     }
    //     return false;
    // }

    public function get_page($id){
        if(!empty($id)){
            $page = $this->where('id', $id)->get()->first();
            return is_null($page) ? false : $page;
        }
        return false;
    }

    public function scopeSlug($query, $slug)
    {
        if(!empty($slug)){
            $page = $this->where('slug', $slug);
            return $page;
        }
        return $query;
    }

    public function get_pages($params = []){

        $pages = $this->query()
                         ->status(@$params['status'])
                         ->name(@$params['name'])
                         ->slug(@$params['slug']);
                        //  ->order(@$params['orderBy']);
        return !empty($params['limit']) ? $pages->paginate($params['limit']) : $pages->get();

    }

}
