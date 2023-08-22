<?php

namespace App\Providers;

use App\Models\Message;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        // $title = 'Sản phẩm';
        // View::share('title', $title);
        $message = Message::all();
        view()->share('message', $message);
    }
}
