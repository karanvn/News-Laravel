<?php

namespace App\Modules\Policy\Models;

use Illuminate\Database\Eloquent\Model;

use App\Modules\Partner\Traits\Filterable;

class Policy extends Model
{
    use Filterable;
    protected $table        = 'policy';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $filterable = [

    ];

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function scopeStatus($query, $status)
    {
        if(!empty($status))
            $query->where('status', $status);
        return $query;
    }

    public function scopeName($query, $name)
    {
        if(!empty($name))
            $query->where('name', 'like', '%'.$name.'%');
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

    public function get_policy($policy_id){
        if(!empty($policy_id)){
            $policy = $this->where('id', $policy_id)->get()->first();
            return is_null($policy) ? false : $policy;
        }
        return false;
    }

    public function get_policies($params = []){

        $policies = $this->query()
                         ->status(@$params['status'])
                         ->name(@$params['name'])
                         ->order(@$params['orderBy']);

        return !empty($params['limit']) ? $policies->paginate($params['limit']) : $policies->get();

    }

}
