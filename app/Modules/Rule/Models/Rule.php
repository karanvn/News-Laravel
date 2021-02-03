<?php

namespace App\Modules\Rule\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $table = 'rules';

    public function roles(){
        return $this->hasMany('App\Modules\Rule\Models\MRole', 'rule_id', 'id');
    }


    public function scopeName($query, $name)
    {
        if(!empty($name))
            $query->where('name', 'like', '%'.$name.'%');
        return $query;
    }

    public function scopeStatus($query, $status)
    {
        if(!empty($status))
            $query->where('status', $status);
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

    public function get_rule($id){
        if(!empty($id)){
            $rule = $this->where('id', $id)->get()->first();
            return is_null($rule) ? false : $rule;
        }
        return false;
    }


    public function get_rules($params = []){

        $rules = $this->query()
                         ->name(@$params['name'])
                         ->status(@$params['status'])
                         ->order(@$params['orderBy']);

        return !empty($params['limit']) ? $rules->paginate($params['limit']) : $rules->get();

    }
}
