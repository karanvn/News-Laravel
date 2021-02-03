<?php

namespace App\Modules\Schema\Models;

use Illuminate\Database\Eloquent\Model;

use App\Modules\Partner\Traits\Filterable;

class Schema extends Model
{
    use Filterable;
    protected $table        = 'schema';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

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
            $query->orderBy('id', 'desc');
        return $query;
    }

    public function get_schema($id){
        if(!empty($id)){
            $schema = $this->where('id', $id)->get()->first();
            return is_null($schema) ? false : $schema;
        }
        return false;
    }

    public function get_schemas($params = []){

        $schemas = $this->query()
                         ->status(@$params['status'])
                         ->order(@$params['orderBy']);
        return !empty($params['limit']) ? $schemas->paginate($params['limit']) : $schemas->get();

    }

}
