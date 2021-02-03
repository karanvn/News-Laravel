<?php

namespace App\Modules\Slug\Models;

use Illuminate\Database\Eloquent\Model;

use App\Modules\Partner\Traits\Filterable;

class SlugOptimize extends Model
{
    use Filterable;
    protected $table        = 'slug';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $filterable = [

    ];

    public function product(){
        return $this->belongsTo('App\Modules\Product\Models\Product', 'object_id', 'product_id');
    }

    public function category(){
        return $this->belongsTo('App\Modules\Product\Models\Category', 'object_id', 'id');
    }
    
    public function cate_blog(){
        return $this->belongsTo('App\Modules\Blog\Models\BlogCategory', 'object_id', 'id');
    }
    
    public function blog(){
        return $this->belongsTo('App\Modules\Product\Models\Blog', 'object_id', 'id');
    }

    public function scopeStatus($query, $status)
    {
        if(!empty($status))
            $query->where('status', $status);
        return $query;
    }

    public function scopeType($query, $type)
    {
        if(!empty($type))
            $query->where('type', $type);
        return $query;
    }

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

    public function scopeOrder($query, $orderBy)
    {
        if(!empty($orderBy))
            $query->orderBy($orderBy[0], $orderBy[1]);
        else
            $query->orderBy('id', 'desc');
        return $query;
    }

    public function scopeSlug($query, $slug)
    {
        if(!empty($slug)){
            $product = $this->where('slug', $slug);
            return $product;
        }
        return $query;
    }

    public function get_slugs($params = []){

        $slugs = $this->query()
                         ->slug(@$params['slug']);

        return !empty($params['limit']) ? $slugs->paginate($params['limit']) : $slugs->get();

    }

}
