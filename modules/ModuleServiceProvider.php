<?php
namespace Modules;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Facades\File;
use Modules\User\src\Http\Middlewares\DemoMiddleware;
use Psy\ConfigPaths;
use Modules\User\src\Commands\TestCommand;
use Modules\User\src\Repositories\UserRepositoryInterface;
use Modules\User\src\Repositories\UserRepository;

class ModuleServiceProvider extends ServiceProvider
{
    private $middlewares = [
        'demo' => DemoMiddleware::class
    ];

    private $commands = [
        TestCommand::class
    ];

    public function boot()
    {
        $modules = $this->getModules();
        
        if (!empty($modules))
        {
            foreach ($modules as $module)
            {
                $this->registerModule($module);
            }
        }
    }

    public function register()
    {
        //Khai báo config
        $modules = $this->getModules();
        if (!empty($modules))
        {
            foreach ($modules as $module)
            {
                $this->registerConfig($module);
            }
        }

        //Khai báo Middleware
        $this->registerMiddleware();

        //Khai báo Commands
        $this->commands($this->commands);

        //Đăng kí dịch vụ vào Service Container
        $this->registerService();
    }

    private function getModules()
    {
        $directories = array_map('basename', File::directories(__DIR__)); //lấy tên các thư mục cùng cấp file này
        return $directories;
    }

    //Register Module
    private function registerModule($module)
    {
        $modulePath = __DIR__."/{$module}";

        //Khai báo các thành phần của Modules

        //Khai báo Routes
        if (File::exists($modulePath. '/routes/routes.php'))
        {
            $this->loadRoutesFrom($modulePath. '/routes/routes.php');
        }

        //Khai báo Migration
        if (File::exists($modulePath. '/migrations'))
        {
            $this->loadMigrationsFrom($modulePath. '/migrations');
        }

        //Khai báo Language
        if (File::exists($modulePath. '/resources/lang'))
        {
            $this->loadTranslationsFrom($modulePath. '/resources/lang', strtolower($module));
            $this->loadJsonTranslationsFrom($modulePath. '/resources/lang');
        }

        //Khai báo views
        if (File::exists($modulePath. '/resources/views'))
        {
            $this->loadViewsFrom($modulePath. '/resources/views', strtolower($module));
        }

        //Khai báo helpers
        if (File::exists($modulePath. '/helpers'))
        {
            $helperList = File::allFiles($modulePath. '/helpers');
            if (!empty($helperList))
            {
                foreach ($helperList as $helper)
                {
                    $file = $helper->getPathname(); //lấy đường dẫn của file
                    require $file;
                }
            }
        }
    }

    //Register Config
    private function registerConfig($module)
    { 
        $configPath = __DIR__. "/{$module}". '/configs';

        if (File::exists($configPath))
        {
            $configFiles = array_map('basename', File::allFiles($configPath));
            
            foreach ($configFiles as $config)
            {
                $alias = basename($config, '.php');
                $this->mergeConfigFrom($configPath. "/{$config}", $alias);
            }
        }
    }

    //Register Middleware
    private function registerMiddleware()
    {
        if (!empty($this->middlewares))
        {
            foreach ($this->middlewares as $key => $middleware)
            {
                $this->app['router']->pushMiddlewareToGroup($key, $middleware);
            }
        }
    }

    //Đăng kí dịch vụ vào Service Container
    private function registerService()
    {
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );
    }
}