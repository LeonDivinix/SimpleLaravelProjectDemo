<?php
/**
 * Created by leon
 * Date: 2016-11-02 16:01
 */

namespace App\Providers;


use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class SingletonServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        // RBAC
        $this->app->singleton(\Library\Service\RBAC\MenuService::class);
        $this->app->singleton(\Library\Service\RBAC\RoleService::class);
        $this->app->singleton(\Library\Service\RBAC\RoleMenuService::class);
        $this->app->singleton(\Library\Service\RBAC\UserService::class);
        $this->app->singleton(\Library\Service\RBAC\ViewUserMenuService::class);
    }

    /**
     * 延迟加载必须要配置此函数
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            // RBAC
            \Library\Service\RBAC\MenuService::class,
            \Library\Service\RBAC\RoleMenuService::class,
            \Library\Service\RBAC\RoleService::class,
            \Library\Service\RBAC\UserService::class,
            \Library\Service\RBAC\ViewUserMenuService::class,
        ];
    }
}
