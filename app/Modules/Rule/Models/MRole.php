<?php

namespace App\Modules\Rule\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class MRole extends Role
{
    public function rule(){
        return $this->belongsTo('App\Modules\Rule\Models\Rule', 'rule_id', 'id');
    }

    public function scopeName($query, $name)
    {
        if(!empty($name)){
            $filter_name = Str::contains($name, '%') ? $name : '%'.$name.'%';
            $query->where('name', 'like', $filter_name);
        }
        return $query;
    }

    public function scopeRule($query, $rule_id)
    {
        if(!empty($rule_id))
            $query->where('rule_id', $rule_id);
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

    public function get_role($id){
        if(!empty($id)){
            $role = $this->where('id', $id)->get()->first();
            return is_null($role) ? false : $role;
        }
        return false;
    }

    public function get_name_role($name){
        if(!empty($name)){
            $role = $this->where('name', $name)->get()->first();
            return is_null($role) ? false : $role;
        }
        return false;
    }


    public function get_roles($params = []){

        $roles = $this->query()
                         ->name(@$params['name'])
                         ->rule(@$params['rule_id'])
                         ->order(@$params['orderBy']);

        return !empty($params['limit']) ? $roles->paginate($params['limit']) : $roles->get();

    }
}
