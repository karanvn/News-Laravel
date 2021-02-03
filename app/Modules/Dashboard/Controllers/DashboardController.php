<?php


namespace App\Modules\Dashboard\Controllers;

use App\Http\Controllers\SiteController;
use App\Modules\Dashboard\Models\Home;
use App\Modules\Log\Libraries\LibActivityLog;
use App\Modules\Log\Models\ActivityLog;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\URL;
use App\User;

class DashboardController extends SiteController
{

    function __construct()
    {
        $this->home = new Home();
        $this->log = new ActivityLog();
    }

    function index() {
        $user = $this->get_auth();
        if(!$user->can('view homes'))
            return redirect()->route('AdminEdit', [$user->id, 'general']);
        $logs = $this->log->get_logs(['limit' => 10, 'orderBy' => ['id', 'desc']]);
        return view('Dashboard::dashboard.index', [
            'tabs' => $this->home->get_tabs(),
            'titles' => get_label_times(),
            'startPage' => 1,
            'lib' => new LibActivityLog(),
            'logs' => $logs
        ]);
    }
    function DashboardOrder() {
 
        $logs = $this->log->get_logs(['type'=> 'ORDER','limit' => 10, 'orderBy' => ['id', 'desc']]);
        return view('Dashboard::dashboardorder.index', [
            'tabs' => $this->home->get_tabs(),
            'titles' => get_label_times(),
            'startPage' => 1,
            'lib' => new LibActivityLog(),
            'logs' => $logs
        ]);
    }
    function dashboardexcel(){
        return view('Dashboard::dashboardexcel');
    }

}
