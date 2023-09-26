<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('spAdmin', function ($user) {
            return $user->roleid == 0;
        });
        Gate::define('isAdmin', function ($user) {
            return $user->roleid == 1 || $user->roleid == 2;
        });
        Gate::define('isSale', function ($user) {
            return $user->roleid == 4;
        });
        Gate::define('isManager', function ($user) {
            return $user->roleid == 3;
        });
        //Quyền khách hàng
        Gate::define('view-guests', function ($user) {
            return $user->roleid == 1 || $user->roleid == 2 || $user->roleid == 4;
        });
        //Quyền nhà cung cấp
        Gate::define('view-provides', function ($user) {
            return $user->roleid == 1 || $user->roleid == 2 || $user->roleid == 3;
        });
        //Quyền đơn xuất
        Gate::define('view-exports', function ($user) {
            return $user->roleid == 1 || $user->roleid == 2 || $user->roleid == 4;
        });
        //Quyền đơn nhập
        Gate::define('view-orders', function ($user) {
            return $user->roleid == 1 || $user->roleid == 2 || $user->roleid == 3;
        });
    }
}
