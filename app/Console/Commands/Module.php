<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Module extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create module CLI';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $modulesFolder = base_path('modules');
        if (!File::exists($modulesFolder))
        {
            File::makeDirectory($modulesFolder);
        }

        //ServiceProvider
        $serviceProviderFile = base_path("modules/ModuleServiceProvider.php");

        if (!File::exists($serviceProviderFile))
        {
            File::put($serviceProviderFile, $this->getContentServiceProviderFile());
        }

        $name = $this->argument('name');
        
        if (File::exists(base_path('modules/'. $name)))
        {
            $this->error('Module already exists!');
        }
        else
        {
            File::makeDirectory(base_path('modules/'.$name));

            //config
            $configFolder = base_path('modules/'.$name.'/confis');

            if (!File::exists($configFolder))
            {
                File::makeDirectory($configFolder);
            }

            //helper
            $helperFolder = base_path('modules/'.$name.'/helpers');

            if (!File::exists($helperFolder))
            {
                File::makeDirectory($helperFolder);
            }

            //migrations
            $migraionFolder = base_path('modules/'.$name.'/migrations');

            if (!File::exists($migraionFolder))
            {
                File::makeDirectory($migraionFolder);
            }

            //resources
            $resourceFolder = base_path('modules/'.$name.'/resources');

            if (!File::exists($resourceFolder))
            {
                File::makeDirectory($resourceFolder);

                //lang
                $langFolder = base_path('modules/'.$name.'/resources/lang');

                if (!File::exists($langFolder))
                {
                    File::makeDirectory($langFolder);
                }

                //views
                $viewsFolder = base_path('modules/'.$name.'/resources/views');

                if (!File::exists($viewsFolder))
                {
                    File::makeDirectory($viewsFolder);
                }
            }

            //routes
            $routesFolder = base_path('modules/'.$name.'/routes');

            if (!File::exists($routesFolder))
            {
                File::makeDirectory($routesFolder);

                //Tạo file routes.php
                $routesFile = base_path('modules/'.$name.'/routes/routes.php');

                if (!File::exists($routesFile))
                {
                    File::put($routesFile, $this->getContentRouteFile($name));
                }
            }

            //src
            $srcFolder = base_path('modules/'.$name.'/src');

            if (!File::exists($srcFolder))
            {
                File::makeDirectory($srcFolder);

                //Commands
                $commandsFolder = base_path('modules/'.$name.'/src/Commands');

                if (!File::exists($commandsFolder))
                {
                    File::makeDirectory($commandsFolder);
                }

                //Http
                $httpFolder = base_path('modules/'.$name.'/src/Http');

                if (!File::exists($httpFolder))
                {
                    File::makeDirectory($httpFolder);

                    //Controllers
                    $controllersFolder = base_path('modules/'.$name.'/src/Http/Controllers');

                    if (!File::exists($controllersFolder))
                    {
                        File::makeDirectory($controllersFolder);
                    }

                    //Middleware
                    $middlewaresFolder = base_path('modules/'.$name.'/src/Http/Middlewares');

                    if (!File::exists($middlewaresFolder))
                    {
                        File::makeDirectory($middlewaresFolder);
                    }
                }

                //Models
                $modelsFolder = base_path('modules/'.$name.'/src/Models');

                if (!File::exists($modelsFolder))
                {
                    File::makeDirectory($modelsFolder);
                }
            }
            $this->info('Module created successfully');
        }
    }

    private function getContentRouteFile($module)
    {
        $module = strtolower($module);
        return 
        "<?php
use Illuminate\Support\Facades\Route;
        
Route::get('/{$module}', function() {

});";
    }

    private function getContentServiceProviderFile()
    {
        return
        "<?php
namespace Modules;
use Carbon\Laravel\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    private \$middlewares = [ 

    ];

    private \$commands = [
       
    ];

    public function register()
    {

    }

    public function boot()
    {

    }
}";
    }
}
