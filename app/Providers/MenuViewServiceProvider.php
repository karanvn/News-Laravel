<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\SliderModel;
use App\Modules\Banner\Models\Banner;
use App\Modules\Branch\Models\Branch;
use App\Modules\Log\Libraries\LibActivityLog;
use App\Modules\Log\Models\ActivityLog;
use App\Modules\Blog\Models\BlogCategory;
use App\Modules\Evaluate\Models\Evaluate;
use App\Modules\Discount\Models\Discount;
use App\Modules\Blog\Models\Blog;
use App\Modules\PageStatic\Models\PageStatic;
use App\Role;
use App\User;

class MenuViewServiceProvider extends ServiceProvider
{
    public function __construct($app)
    {
        parent::__construct($app);
        $this->blog     = new Blog();
        $this->blogCategory = new BlogCategory();
        $this->user     = new User();
        $this->branch   = new Branch();
        $this->banner   = new Banner();
        $this->user     = new User();
        $this->Evaluate = new Evaluate();
        $this->pageStatic = new PageStatic();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('admin.aside-menu', function($view){
            
            $view->with([
                'routeName' => \Route::currentRouteName(),
                'customer_total' => $this->user->get_users(['limit' => 1, 'user_type' => 'C', 'status' => 'A'])->total(),
                'admin_total' => $this->user->get_users(['limit' => 1, 'user_type' => 'A', 'status' => 'A'])->total(),
                'branch_total' => $this->branch->get_branches(['limit' => 1, 'status' => 'A'])->total(),
                'banner_total' => $this->banner->get_banners(['limit' => 1, 'published' => 'A'])->total(),
                'Evaluate_total'  =>$this->Evaluate->get_evatuates(['status' => 'A'])->count(),
                'page_static_total' => $this->pageStatic->get_pages(['status' => 1])->count(),
                'blog_total' =>  $this->blog->get_blogs(['status' => 'A'])->count(),


            ]);
        });
        view()->composer('admin.main', function($view){
            $model = new ActivityLog();
            $user_id = Auth::user()->id;
            $lib = new LibActivityLog();
            $logs = $model->get_logs(['user_id' => $user_id,'limit' => 20, 'offset' => 0]);
            $view->with([
                'logs' => $logs,
                'lib' => $lib
            ]);
        });
     
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
