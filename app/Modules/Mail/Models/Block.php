<?php

namespace App\Modules\Mail\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $table = 'mail_blocks';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    protected $primaryKey = 'block_id';

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function tpls(){
        return $this->belongsToMany('App\Modules\Mail\Models\Tpl', 'App\Modules\Mail\Models\BlockTpl', 'block_id', 'tpl_id');
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
            $query->orderBy('block_id', 'desc');
        return $query;
    }

    public function get_block($block_id){
        if(!empty($block_id)){
            $block = $this->where('block_id', $block_id)->get()->first();
            return is_null($block) ? false : $block;
        }
        return false;
    }

    public function get_blocks($params = []){

        $blocks = $this->query()
                         ->status(@$params['status'])
                         ->order(@$params['orderBy']);

        return !empty($params['limit']) ? $blocks->paginate($params['limit']) : $blocks->get();

    }

}
