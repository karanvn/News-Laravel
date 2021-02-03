<?php

namespace App\Modules\Mail\Models;

use Illuminate\Database\Eloquent\Model;

class MailLog extends Model
{
    protected $table = 'mail_logs';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    protected $primaryKey = 'id';


    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function scopeStatus($query, $status){
        if(!empty($status))
            $query->where('status', $status);
        return $query;
    }
    
    public function scopeDate($query, $date){
        if(!empty($date))
            $query->where('bod', $date);
        return $query;
    }

    public function scopeOrder($query, $orderBy){
        if(!empty($orderBy))
            $query->orderBy($orderBy[0], $orderBy[1]);
        else
            $query->orderBy('id', 'desc');
        return $query;
    }

    public function getMailLog($id){
        if(!empty($id)){
            $mail = $this->where('user_id', $id)->get()->first();
            return is_null($mail) ? false : $mail;
        }
        return false;
    }

    public function getMailLogs($params = []){

        $mails = $this->query()
                         ->status(@$params['status'])
                         ->order(@$params['orderBy'])
                         ->date(@$params['bod']);

        return !empty($params['limit']) ? $mails->paginate($params['limit']) : $mails->get();

    }

}
