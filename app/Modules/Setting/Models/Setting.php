<?php

namespace App\Modules\Setting\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    public $timestamps = false; 


    public function get_setting($id){
        if(!empty($id)){
            $setting = $this->where('id', $id)->get()->first();
            return is_null($setting) ? false : $setting;
        }
        return false;
    }

    public function get_type_setting($type){
        if(!empty($type)){
            $setting = $this->where('type', $type)->get()->first();
            return is_null($setting) ? false : $setting;
        }
        return false;
    }

    public function get_settings(){

        return $this->query()->get();
        
    }
}
