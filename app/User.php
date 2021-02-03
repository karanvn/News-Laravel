<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function partner(){
        return $this->belongsTo('App\Modules\Partner\Models\Partner', 'partner_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function shippings(){
        return $this->hasMany('App\Modules\Auth\Models\Shipping', 'user_id', 'id');
    }
    public function mailLogs(){
        return $this->hasMany('App\Modules\Mail\Models\MailLog', 'user_id', 'id');
    }
    public function historypoint(){
        return $this->hasMany('App\Modules\Auth\Models\Pointuser', 'user_id', 'id');
    }

    public function orders(){
        return $this->hasMany('App\Modules\Order\Models\Order', 'user_id', 'id');
    }
    public function blogs(){
        return $this->hasMany('App\Modules\Blog\Models\Blog', 'user_id', 'id');
    }

    public function scopeName($query, $name)
    {
        if(!empty($name))
            $query->where('name', 'like',  '%'.$name.'%');
        return $query;
    }

    public function scopeId($query, $id)
    {
        if(!empty($id))
            $query->where('id', $id);
        return $query;
    }


    public function scopeEmail($query, $email)
    {
        if(!empty($email)){
            if(Str::contains($email, '%')){
                $query->where('email', 'like',  $email);
            }else{
                $query->where('email', $email);
            }
        }
        return $query;
    }

    public function scopeTerm($query, $term)
    {
        if(!empty($term)){
            $query->where('name', 'like' , $term );
            $query->orWhere('email', 'like' , $term );
        }
        return $query;
    }

    public function scopeStatus($query, $status)
    {
        if(!empty($status))
            $query->where('status', $status);
        return $query;
    }
    public function scopeCountOrder($query, $count)
    {
        if(!empty($count))
            $query->where('count_order', $count);
        return $query;
    }

    public function scopeType($query, $user_type)
    {
        if(!empty($user_type))
            $query->where('user_type', $user_type);
        return $query;
    }

    public function scopePhone($query, $phone)
    {
        if(!empty($phone))
            $query->where('phone', $phone);
        return $query;
    }
    public function scopeBod($query, $Bod)
    {
        if(!empty($Bod))
            $query->where('bod', $Bod);
        return $query;
    }
    public function scopePoint($query, $point)
    {
        if(!empty($point))
            $query->where('point', '<=',$point);
        return $query;
    }
    public function scopeshowhome($query, $showhome)
    {
        if(!empty($showhome))
            $query->where('show_home',$showhome);
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

    public function get_user($id){
        if(!empty($id)){
            $user = $this->where('id', $id)->get()->first();
            return is_null($user) ? false : $user;
        }
        return false;
    }

    public function get_email_user($email){
        if(!empty($email)){
            $user = $this->where('email', $email)->get()->first();
            return is_null($user) ? false : $user;
        }
        return false;
    }


    public function get_users($params = []){

        $users = $this->query()
                        ->id(@$params['id'])
                        ->term(@$params['term'])
                         ->name(@$params['name'])
                         ->status(@$params['status'])
                         ->email(@$params['email'])
                         ->type(@$params['user_type'])
                         ->phone(@$params['phone'])
                         ->bod(@$params['bod'])
                         ->point(@$params['point'])
                         ->showhome(@$params['show_home'])
                         ->CountOrder(@$params['count_order'])
                         ->order(@$params['orderBy']);

        return !empty($params['limit']) ? $users->paginate($params['limit']) : $users->get();

    }
    function minuspoint($point){
        if(Auth::check()){
            $user = $this->find(Auth::id());
        $user->point = $user->point - $point >=0 ? $user->point - $point : '0';
        $user->save();
        return true;
        }
        return false;
    }
    function adduser($request){
        $this->name     = @$request->fullname;
        $this->bod      = date('Y-m-d', strtotime(@$request->birthday));
        $this->email    = @$request->email;
        $this->phone    = @$request->phone;
        $this->password = bcrypt($request->password);
        $this->user_type= 'C';
        $this->status   = 'A';
        $this->point    = '0';
        $this->save();
        return $this->id;
    }
    function editUserCustomer($request) {
        //dd($request);
        if(isset($request->password)){
            $this->password = bcrypt(@$request->password);
            $this->save();
            return true;
        }
        $this->name     = @$request->fullname;
        // $this->email= $request->email;
        $this->phone    = @$request->phone;
        $this->gender   = @$request->gender;
        $this->bod      = @$request->bod;
        $this->avatar   = !empty($request->image)? $request->image :  $this->avatar;
        $this->save();
        return true;
    }
}
