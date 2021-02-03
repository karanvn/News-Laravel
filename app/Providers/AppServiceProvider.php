<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
//use App\Modules\Setting\Models\Setting;
use App\Modules\Blog\Models\BlogCategory;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
        view()->composer('*', function($view){
            $view->with([
                'auth'           => Auth::user(),
                
            ]);
        });

    }
   
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*$setting  = new Setting; 
        $settings = @$setting->get_settings();
        $generals = [];
        if(count(@$settings) > 0){
            foreach($settings as $setting){
                $generals[$setting->type] = unserialize($setting->data);
            }
        }
        $this->blogCategory = new BlogCategory;

        $blogCategories = $this->blogCategory->get_categories(['status' => 'A']);

        view()->share([
                        'generals'       => $generals, 
                        'blogCategories' => $blogCategories
                    ]); */
    
    }
}
