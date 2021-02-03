<?php

namespace App\Modules\Location\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table = 'wards';
    public $timestamps = false;
    protected $primaryKey = 'ward_id';

    public function district(){
        return $this->belongsTo('App\Modules\Location\Models\District', 'district_id', 'district_id');
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

    public function scopeDistrict($query, $district_id)
    {
        if(!empty($district_id))
            $query->where('district_id', $district_id);
        return $query;
    }

    public function scopeWard($query, $ward_id)
    {
        if(!empty($ward_id))
            $query->where('ward_id', $ward_id);
        return $query;
    }

    public function scopeOrder($query, $orderBy)
    {
        if(!empty($orderBy))
            $query->orderBy($orderBy[0], $orderBy[1]);
        else
            $query->orderBy('ward_id', 'desc');
        return $query;
    }

    public function get_ward($ward_id){
        if(!empty($ward_id)){
            return $this->where('ward_id', $ward_id)->get()->first();
        }
        return [];
    }

    public function get_wards($params = []){

        $wards = $this->query()
                         ->status(@$params['status'])
                         ->name(@$params['name'])
                         ->district(@$params['district_id'])
                         ->ward(@$params['ward_id'])
                         ->order(@$params['orderBy']);

        return !empty($params['limit']) ? $wards->paginate($params['limit']) : $wards->get();

    }

}
