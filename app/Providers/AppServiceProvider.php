<?php

namespace App\Providers;

use App\Account;
use App\Category;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials.side-nav', function($view) {
            $view->with([
                'accounts'      => Account::all(),
                'totalBalance'  => Account::get()->lists('balance')->sum(),
            ]);
        });
        view()->composer('settings.categories._form', function($view) {

           $view->with([
               'categories'     => Category::Parents()->lists('name', 'id')
           ]) ;
        });
    }

//    $employees = Employee::where('branch_id', 9)->get()->lists('full_name', 'id');

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
