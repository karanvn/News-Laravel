<?php

namespace App\Modules\Location\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    public $timestamps = false;
    protected $primaryKey = 'district_id';

    public function state(){
        return $this->belongsTo('App\Modules\Location\Models\State', 'state_id', 'state_id');
    }

    public function wards(){
        return $this->hasMany('App\Modules\Location\Models\Ward', 'district_id', 'district_id');
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

    public function scopeState($query, $state_id)
    {
        if(!empty($state_id))
            $query->where('state_id', $state_id);
        return $query;
    }

    public function scopeDistrict($query, $district_id)
    {
        if(!empty($district_id))
            $query->where('district_id', $district_id);
        return $query;
    }

    public function scopeOrder($query, $orderBy)
    {
        if(!empty($orderBy))
            $query->orderBy($orderBy[0], $orderBy[1]);
        else
            $query->orderBy('district_id', 'desc');
        return $query;
    }

    public function get_district($district_id){
        if(!empty($district_id)){
            return $this->where('district_id', $district_id)->get()->first();
        }
        return [];
    }

    public function get_districts($params = []){

        $districts = $this->query()
                         ->status(@$params['status'])
                         ->name(@$params['name'])
                         ->state(@$params['state_id'])
                         ->district(@$params['district_id'])
                         ->order(@$params['orderBy']);

        return !empty($params['limit']) ? $districts->paginate($params['limit']) : $districts->get();

    }
}
