<?php

namespace App\Modules\Log\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';


    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function banner(){
        return $this->belongsTo('App\Modules\Banner\Models\Banner', 'object_id', 'id');
    }

    public function branch(){
        return $this->belongsTo('App\Modules\Branch\Models\Branch', 'object_id', 'id');
    }

    public function category(){
        return $this->belongsTo('App\Modules\Product\Models\Category', 'object_id', 'id');
    }

    public function feature(){
        return $this->belongsTo('App\Modules\Product\Models\Feature', 'object_id', 'id');
    }

    public function product(){
        return $this->belongsTo('App\Modules\Product\Models\Product', 'object_id', 'product_id');
    }

    public function state(){
        return $this->belongsTo('App\Modules\State\Models\State', 'object_id', 'state_id');
    }

    public function district(){
        return $this->belongsTo('App\Modules\District\Models\District', 'object_id', 'district_id');
    }

    public function ward(){
        return $this->belongsTo('App\Modules\Ward\Models\Ward', 'object_id', 'ward_id');
    }

    public function rule(){
        return $this->belongsTo('App\Modules\Rule\Models\Rule', 'object_id', 'id');
    }

    public function role(){
        return $this->belongsTo('App\Modules\Rule\Models\MRole', 'object_id', 'id');
    }

    public function permission(){
        return $this->belongsTo('App\Modules\Rule\Models\MPermission', 'object_id', 'id');
    }

    public function order(){
        return $this->belongsTo('App\Modules\Order\Models\Order', 'object_id', 'order_id');
    }


    public function scopeType($query, $type)
    {
        if(!empty($type))
            $query->where('type', $type);
        return $query;
    }

    public function scopeUser($query, $user_id)
    {
        if(!empty($user_id))
            $query->where('user_id', $user_id);
        return $query;
    }

    public function scopeObject($query, $object)
    {
        if(!empty($object))
            $query->where('object_id', $object);
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

    public function get_log($id){
        if(!empty($id)){
            $log = $this->where('id', $id)->get()->first();
            return is_null($log) ? false : $log;
        }
        return false;
    }


    public function get_logs($params = []){

        $logs = $this->query()
                         ->type(@$params['type'])
                         ->object(@$params['object_id'])
                         ->user(@$params['user_id'])
                         ->order(@$params['orderBy']);

        return !empty($params['limit']) ? $logs->paginate($params['limit']) : $logs->get();

    }
}
