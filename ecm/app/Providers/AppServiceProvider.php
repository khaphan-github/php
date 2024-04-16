<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;


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
        // Sử dụng View Composer để chia sẻ biến $categories với tất cả các view
        View::composer('*', function ($view) {
            $categories = DB::table('category')->get();
            $view->with('category', $categories);
        });
    }
}
