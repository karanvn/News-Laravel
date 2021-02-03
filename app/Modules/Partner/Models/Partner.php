<?php

namespace App\Modules\Partner\Models;

use Illuminate\Database\Eloquent\Model;


class Partner extends Model
{
    protected $table = 'partners';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';


    public function users(){
        return $this->hasMany('App\User', 'partner_id', 'id');
    }

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

    public function scopeName($query, $name)
    {
        if(!empty($name)){
            $query->where('name', 'like', '%'.$name.'%');
        }
        return $query;
    }

    public function scopeId($query, $id)
    {
        if(!empty($id)){
            $query->where('id', $id);
        }
        return $query;
    }

    public function scopeEmail($query, $email)
    {
        if(!empty($email))
            $query->where('email', $email);
        return $query;
    }

    public function scopePhone($query, $phone)
    {
        if(!empty($phone))
            $query->where('phone', $phone);
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

    public function get_partner($id){
        if(!empty($id)){
            $partner = $this->where('id', $id)->get()->first();
            return is_null($partner) ? false : $partner;
        }
        return false;
    }


    public function get_partners($params = []){

        $partners = $this->query()
                         ->id(@$params['id'])
                         ->name(@$params['name'])
                         ->email(@$params['email'])
                         ->phone(@$params['phone'])
                         ->status(@$params['status'])
                         ->order(@$params['orderBy']);

        return !empty($params['limit']) ? $partners->paginate($params['limit']) : $partners->get();

    }

}
