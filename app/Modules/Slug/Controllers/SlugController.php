<?php


namespace App\Modules\Slug\Controllers;

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Auth;

use App\Libraries\Upload;
use App\Modules\Slug\Models\Slug;

use Config;

class SlugController extends SiteController
{

    public function __construct()
    {
        $this->slug = new Slug();
    }

   
}

