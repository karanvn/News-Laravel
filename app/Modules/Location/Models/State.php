<?php

namespace App\Modules\Location\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';
    public $timestamps = false;
    protected $primaryKey = 'state_id';

    public function districts(){
        return $this->hasMany('App\Modules\Location\Models\District', 'state_id', 'state_id');
    }

    public function scopeStatus($query, $status)
    {
        if(!empty($status))
            $query->where('status', $status);
        return $query;
    }

    public function scopeState($query, $state_id)
    {
        if(!empty($state_id))
            $query->where('state_id', $state_id);
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
            $query->orderBy('state_id', 'desc');
        return $query;
    }

    public function get_state($state_id){
        if(!empty($state_id)){
            return $this->where('state_id', $state_id)->get()->first();
        }
        return [];
    }

    public function get_states($params = []){

        $states = $this->query()
                         ->status(@$params['status'])
                         ->name(@$params['name'])
                         ->state(@$params['state_id'])
                         ->order(@$params['orderBy']);

        return !empty($params['limit']) ? $states->paginate($params['limit']) : $states->get();

    }

}
