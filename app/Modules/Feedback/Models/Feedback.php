<?php

namespace App\Modules\Feedback\Models;

use Illuminate\Database\Eloquent\Model;

use App\Modules\Partner\Traits\Filterable;

class Feedback extends Model
{
    use Filterable;
    protected $table        = 'feedback';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $filterable = [

    ];

    public function scopeStatus($query, $status)
    {
        if(!empty($status))
            $query->where('status', $status);
        return $query;
    }
    public function scopeType($query, $type)
    {
        if(!empty($type))
            $query->where('type', $type);
        return $query;
    }


    public function get_feedbacks($params = []){

        $slugs = $this->query()
        ->status(@$params['status'])
        ->type(@$params['type'])
        ->orderBy('id','DESC');

        return !empty($params['limit']) ? $slugs->paginate($params['limit']) : $slugs->get();

    }


}
