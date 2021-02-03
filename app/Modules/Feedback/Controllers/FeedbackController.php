<?php


namespace App\Modules\Feedback\Controllers;

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Auth;

use App\Libraries\Upload;
use App\Modules\Feedback\Models\FeedBack;

use Config;

class FeedbackController extends SiteController
{

    public function __construct()
    {
        $this->feedback = new Feedback();
    }

   
}

