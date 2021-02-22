<?php

namespace App\Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    //
    protected $table= 'questions';
    public function scopeCategory($query, $category)
    {
        if(!empty($category)){
            $query->where('category_id',$category);
        }
        return $query;
    }
    function get_questions($params = []){
        $questions = $this->query()
                ->category(@$params['category_id']);
        return !empty($params['limit']) ? $questions->paginate($params['limit']) : $questions->get();
    }
}