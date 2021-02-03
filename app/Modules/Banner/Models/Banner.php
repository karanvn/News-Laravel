<?php

namespace App\Modules\Banner\Models;

use Illuminate\Database\Eloquent\Model;

use App\Modules\Partner\Traits\Filterable;

class Banner extends Model
{
    use Filterable;
    protected $table = 'banners';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function product(){
        return $this->belongsTo('App\Modules\Product\Models\Product', 'object_id', 'product_id');
    }

    public function category(){
        return $this->belongsTo('App\Modules\Product\Models\Category', 'object_id', 'id');
    }
    public function categoryBlog(){
        return $this->belongsTo('App\Modules\Blog\Models\BlogCategory', 'object_id', 'id');
    }
    public function collection(){
        return $this->belongsTo('App\Modules\Product\Models\Collection', 'object_id', 'id');
    }

    public function scopeStatus($query, $status)
    {
        if(!empty($status))
            $query->where('status', $status);
        return $query;
    }
    public function scopeShowHome($query, $ShowHome)
    {
        if(!empty($ShowHome))
            $query->where('showhome', $ShowHome);
        return $query;
    }

    public function scopeType($query, $type)
    {
        if(!empty($type))
            $query->where('type', $type);
        return $query;
    }
    public function scopeTypeArr($query, $type_arr)
    {
        if(!empty($type_arr))
            $query->whereIn('type', $type_arr);
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

    public function get_object($id){
        $banner = $this->get_banner($id);
        $object = false;
        if($banner){
            switch($banner->type){
                case 'CATEGORY':
                    $object = $banner->category()->get()->first();
                break;
                case 'PRODUCT':
                    $object = $banner->product()->get()->first();
                break;
                case 'CATEGORYBLOG':
                    $object = $banner->categoryBlog()->get()->first();
                break;
                case 'COLLECTION':
                    $object = $banner->collection()->get()->first();
                break;
            }
            return $object;
        }
    }

    public function get_banner($id){
        if(!empty($id)){
            $banner = $this->where('id', $id)->get()->first();
            return is_null($banner) ? false : $banner;
        }
        return false;
    }

    public function get_banners($params = []){

        $banners = $this->query()
                         ->status(@$params['status'])
                         ->name(@$params['name'])
                         ->type(@$params['type'])
                         ->published(@$params['published'])
                         ->Extence(@$params['Extence'])
                         ->Object_id(@$params['object_id'])
                         ->ShowHome(@$params['showhome'])
                         ->TypeArr(@$params['typearr'])
                         ->order(@$params['orderBy']);
        return !empty($params['limit']) ? $banners->paginate($params['limit']) : $banners->get();

    }

}
