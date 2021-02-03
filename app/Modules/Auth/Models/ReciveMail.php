<?php

namespace App\Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;


class ReciveMail extends Model
{
    protected $table = 'recive_info';

    public function scopeOrder($query, $orderBy)
    {
        if(!empty($orderBy))
            $query->orderBy($orderBy[0], $orderBy[1]);
        else
            $query->orderBy('id', 'desc');
        return $query;
    }

    public function scopeEmail($query, $email)
    {
        if(!empty($email))
            $query->where('email', 'like', '%'.$email.'%');
        return $query;
    }
   
    public function get_mails($params = []){

        $mails = $this->query()
                        ->order(@$params['orderBy'])
                        ->email(@$params['email']);

        return !empty($params['limit']) ? $mails->paginate($params['limit']) : $mails->get();

    }

}
