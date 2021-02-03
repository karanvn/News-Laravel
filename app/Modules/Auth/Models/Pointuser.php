<?php

namespace App\Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;


class Pointuser extends Model
{
    protected $table = 'point_user';

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function scopeOrder($query, $orderBy)
    {
        if(!empty($orderBy))
            $query->orderBy($orderBy[0], $orderBy[1]);
        else
            $query->orderBy('id', 'desc');
        return $query;
    }
    public function scopeUserid($query, $id)
    {
        if(!empty($id))
            $query->where('user_id', $id);
        return $query;
    }

    public function get_points($params = []){

        $points = $this->query()
                         ->userid(@$params['user_id'])
                         ->order(@$params['orderBy']);

        return !empty($params['limit']) ? $points->paginate($params['limit']) : $points->get();

    }

}
