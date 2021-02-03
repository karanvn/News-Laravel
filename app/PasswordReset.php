<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $table = 'password_resets';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = null;
    protected $primaryKey = 'token';
    public function user(){
        return $this->belongsTo('App\User', 'email', 'email');
    }
    public function delete($params = []){
        if(!empty($params['token'])){
            $this->where('token', $params['token'])->delete();
        }
        if(!empty($params['email'])){
            $this->where('email', $params['email'])->delete();
        }
    }
    public function get_password_reset($token){
        if(!empty($token)){
            $reset = $this->where('token', $token)->get()->first();
            return is_null($reset) ? false : $reset;
        }
        return false;
    }
}
