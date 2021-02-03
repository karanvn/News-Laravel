<?php

namespace App\Modules\Mail\Models;

use Illuminate\Database\Eloquent\Model;

class Tpl extends Model
{
    protected $table = 'mail_templates';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    protected $primaryKey = 'tpl_id';

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function blocks(){
        return $this->belongsToMany('App\Modules\Mail\Models\Block', 'App\Modules\Mail\Models\BlockTpl', 'tpl_id', 'block_id');
    }

    public function scopeOrder($query, $orderBy)
    {
        if(!empty($orderBy))
            $query->orderBy($orderBy[0], $orderBy[1]);
        else
            $query->orderBy('tpl_id', 'desc');
        return $query;
    }

    public function get_template($tpl_id){
        if(!empty($tpl_id)){
            $tpl = $this->where('tpl_id', $tpl_id)->get()->first();
            return is_null($tpl) ? false : $tpl;
        }
        return false;
    }

    public function get_by_type_template($type){
        if(!empty($type)){
            $tpl = $this->where('type', $type)->get()->first();
            return is_null($tpl) ? false : $tpl;
        }
        return false;
    }

    public function get_templates($params = []){

        $templates = $this->query()
                         ->order(@$params['orderBy']);

        return !empty($params['limit']) ? $templates->paginate($params['limit']) : $templates->get();

    }

}
