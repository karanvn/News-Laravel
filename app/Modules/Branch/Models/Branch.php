<?php

namespace App\Modules\Branch\Models;

use Illuminate\Database\Eloquent\Model;

use App\Modules\Partner\Traits\Filterable;

class Branch extends Model
{
    use Filterable;
    protected $table = 'branchs';
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

    public function get_branch($branch_id){
        if(!empty($branch_id)){
            $branch = $this->where('id', $branch_id)->get()->first();
            return is_null($branch) ? false : $branch;
        }
        return false;
    }


    public function get_branches($params = []){

        $branches = $this->query()
                         ->status(@$params['status'])
                         ->name(@$params['name'])
                         ->order(@$params['orderBy']);

        return !empty($params['limit']) ? $branches->paginate($params['limit']) : $branches->get();

    }

}
