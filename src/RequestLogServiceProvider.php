<?php

namespace Wufly\Log;

use Illuminate\Support\ServiceProvider;

class RequestLogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // if (!config('requestLog.enabled')) {
        //     return;
        // }
        //publish
        $this->publishes([
            __DIR__ . '/config/requestLog.php' => config_path('requestLog.php'),
        ]);
        // 加载数据迁移文件
        $this->loadMigrationsFrom(__DIR__ . '/Storage/migrations');
    }
}
