<?php

namespace App\Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;


class Shipping extends Model
{
    protected $table = 'shippings';

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function state(){
        return $this->belongsTo('App\Modules\Location\Models\State', 'state_id', 'state_id');
    }

    public function district(){
        return $this->belongsTo('App\Modules\Location\Models\District', 'district_id', 'district_id');
    }

    public function ward(){
        return $this->belongsTo('App\Modules\Location\Models\Ward', 'ward_id', 'ward_id');
    }

    public function scopeUserID($query, $user_id)
    {
        if(!empty($user_id)){
            $query->where('user_id', $user_id);
        }
        return $query;
    }
    public function scopeState($query, $state_id)
    {
        if(!empty($state_id)){
            $query->where('state_id', $state_id);
        }
        return $query;
    }
    public function scopeDistrict($query, $district_id)
    {
        if(!empty($district_id)){
            $query->where('district_id', $district_id);
        }
        return $query;
    }
    public function scopeWard($query, $ward_id)
    {
        if(!empty($ward_id)){
            $query->where('ward_id', $ward_id);
        }
        return $query;
    }
    public function scopeAddress($query, $Address)
    {
        if(!empty($Address)){
            $query->where('address', $Address);
        }
        return $query;
    }



    public function scopeOrder($query)
    {
        return $query->orderBy('position', 'asc');
    }

    public function get_shipping($id){
        if(!empty($id)){
            $shipping = $this->where('id', $id)->get()->first();
            return is_null($shipping) ? false : $shipping;
        }
        return false;
    }


    public function get_shippings($user_id){

        $partners = $this->query()
                         ->userID($user_id)
                         ->order();

        return $partners->get();

    }
    public function get_shippings_new($params = []){

        $ship = $this->query()
                        ->userID(@$params['user_id'])
                         ->State(@$params['state'])
                         ->District(@$params['district'])
                         ->Address(@$params['address'])
                         ->Ward(@$params['ward']);

        return !empty($params['limit']) ? $ship->paginate($params['limit']) : $ship->get();

    }
    public function save_shipping($params = [])
    {
        $this->user_id  = @$params['user_id'];
        $this->name         = @$params['name'];
        $this->phone        = @$params['phone'];
        $this->address      = @$params['address'];
        $this->state_id     = @$params['state_id'];
        $this->district_id  = @$params['district_id'];
        $this->ward_id      = @$params['ward_id'];
        $this->status       = @$params['status'];
        $this->save();
        return true;
    }
    public function edit_shipping($params = [])
    {
        $this->name         = @$params['name'];
        $this->phone        = @$params['phone'];
        $this->address      = @$params['address'];
        $this->state_id     = @$params['state_id'];
        $this->district_id  = @$params['district_id'];
        $this->ward_id      = @$params['ward_id'];
        $this->status       = @$params['status'];
        $this->save();
        return true;
    }

}
