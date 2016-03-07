<?php

namespace App\Providers;

use App\Account;
use App\Category;
use App\Company;
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
        view()->composer('transactions._form', function($view) {
            $view->with([
                'companies'     => Company::lists('name','id'),
                'accounts'      => Account::lists('name', 'id'),
                'categories'     => Category::Parents()
            ]);
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
