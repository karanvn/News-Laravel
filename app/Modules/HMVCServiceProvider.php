<?php

namespace App\Modules;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class HMVCServiceProvider extends ServiceProvider
{
    /**
     * Register config file here
     * alias => path
     */
    private $configFile = [
        'dashboard'   => 'Dashboard/Configs/dashboard.php',
        'partner'     => 'Partner/Configs/partner.php',
        'auth_'       => 'Auth/Configs/auth_.php',
        'branch'      => 'Branch/Configs/branch.php',
        'banner'      => 'Banner/Configs/banner.php',
        'mail'        => 'Mail/Configs/mail.php',
        'page_static' => 'PageStatic/Configs/page_static.php'
    ];

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        // register your config file here
        foreach ($this->configFile as $alias => $path) {
            $this->mergeConfigFrom(__DIR__ . "/" . $path, $alias);
        }
    }

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $directories = array_map('basename', File::directories(__DIR__));

        foreach ($directories as $moduleName) {
            $this->_registerModule($moduleName);
        }
    }

    private function _registerModule($moduleName) {
        $modulePath = __DIR__ . "/$moduleName/";

        // boot Routes
        if (File::exists($modulePath . "routes.php")) {
            $this->loadRoutesFrom($modulePath . "routes.php");
        }

        // boot helpers
        foreach (glob(app_path() . '/Modules/' . $moduleName . '/Helpers/*.php') as $filename){
            require_once($filename);
        }

        // boot Migration
        if (File::exists($modulePath . "Migrations")) {
            $this->loadMigrationsFrom($modulePath . "Migrations");
        }

        // boot Languages
        if (File::exists($modulePath . "Languages")) {
            $this->loadTranslationsFrom($modulePath . "Languages", $moduleName);
        }

        // boot Views
        if (File::exists($modulePath . "Views")) {
            $this->loadViewsFrom($modulePath . "Views", $moduleName);
        }
    }
}
