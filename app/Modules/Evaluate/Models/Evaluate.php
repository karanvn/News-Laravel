<?php

namespace App\Modules\Evaluate\Models;

use Illuminate\Database\Eloquent\Model;

use App\Modules\Partner\Traits\Filterable;

class Evaluate extends Model
{
    use Filterable;
    protected $table = 'evaluate';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    public function evaluateimage()
    {
        return $this->hasMany('App\Modules\Evaluate\Models\EvaluateImage', 'evaluate_id', 'id');
    }
    public function product()
    {
        return $this->hasOne('App\Modules\Product\Models\Product', 'product_id', 'product_id');
    }
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
 
    function add_evaluate($params = []){
        $this->product_id = @$params['product_id'];
        $this->user_id = @$params['user_id'];
        $this->star = @$params['star'];
        $this->name =@$params['name'];
        $this->email =@$params['email'];
        $this->content = @$params['content'];
        $this->review = @$params['review'];
        $this->status = 'A';
        $this->save();
        return $this->id;
     }
    public function changestatus(){
        if($this->status == 'A'){
            $this->status = 'D';
        }else{
            $this->status = 'A';
        }
        $this->save();
    }
    public function get_evatuate($id){
        return $this->where('id',$id);
    }
    function get_evatuatecontinueserialstatus($query,$status){
        return $query->where('status',$status);
    }
    
    function get_limitoffsetevatuate($query, $number, $page){
        return $query->limit($number)->offset($number*($page-1))->get();
    }
    function selectallevatuate(){
        return $this->all();
    }
    public function scopeId($query, $id)
    {
        if(!empty($id)){
            $query->where('id',$id);
        }
        return $query;
    }
    public function scopeEmail($query, $email)
    {
        if(!empty($email)){
            $query->where('email',$email);
        }
        return $query;
    }
    public function scopeReview($query, $review)
    {
        if(!empty($review)){
            $query->where('review',$review);
        }
        return $query;
    }
    public function scopeProductId($query, $productid)
    {
        if(!empty($productid)){
            $query->where('product_id',$productid);
        }
        return $query;
    }
    public function scopeStatus($query, $status)
    {
        if(!empty($status)){
            $query->where('status',$status);
        }
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

    function get_evatuates($params = []){
            $evatuates = $this->query()
            ->Id(@$params['id'])
            ->Email(@$params['email'])
            ->ProductId(@$params['productid'])
            ->Status(@$params['status'])
            ->Review(@$params['review'])
            ->order(@$params['orderBy']);
            return !empty($params['limit']) ? $evatuates->paginate($params['limit']) : $evatuates->get();
    }
   
}
