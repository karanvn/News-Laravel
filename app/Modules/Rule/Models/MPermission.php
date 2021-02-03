<?php

namespace App\Modules\Rule\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use App\Modules\Partner\Traits\Filterable;

class MPermission extends Permission
{

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

    public function get_permission($id){
        if(!empty($id)){
            $permission = $this->where('id', $id)->get()->first();
            return is_null($permission) ? false : $permission;
        }
        return false;
    }

    public function get_name_permission($name){
        if(!empty($name)){
            $permission = $this->where('name', $name)->get()->first();
            return is_null($permission) ? false : $permission;
        }
        return false;
    }


    public function get_permissions($params = []){

        $permissions = $this->query()
                         ->name(@$params['name'])
                         ->order(@$params['orderBy']);

        return !empty($params['limit']) ? $permissions->paginate($params['limit']) : $permissions->get();

    }
}
