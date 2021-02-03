<?php

namespace App\Modules\Evaluate\Models;

use Illuminate\Database\Eloquent\Model;

use App\Modules\Partner\Traits\Filterable;

class EvaluateImage extends Model
{
    use Filterable;
    protected $table = 'evaluate_image';
    public $timestamps = false;
}
