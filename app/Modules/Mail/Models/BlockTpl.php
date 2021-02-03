<?php

namespace App\Modules\Mail\Models;

use Illuminate\Database\Eloquent\Model;

class BlockTpl extends Model
{
    protected $table = 'mail_block_templates';
    public $timestamps = false;

    public function block(){
        return $this->belongsTo('App\Modules\Mail\Models\Block', 'block_id', 'block_id');
    }

    public function tpl(){
        return $this->belongsTo('App\Modules\Mail\Models\Tpl', 'tpl_id', 'tpl_id');
    }

    public function delete($params = []){
        if(!empty($params['block_id'])){
            $this->where('block_id', $params['block_id'])->delete();
        }
        if(!empty($params['tpl_id'])){
            $this->where('tpl_id', $params['tpl_id'])->delete();
        }
    }

}
