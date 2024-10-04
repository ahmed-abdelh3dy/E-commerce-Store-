<?php

namespace App\Providers;

use App\Events\OrederCreated;
use App\Http\Responses\CustomLoginViewResponse;
use App\Jobs\DeletedExpiredOrders;
use App\Listeners\DeductProductQuantity;
use App\Listeners\EmptyCart;
use App\Listeners\SendOrderCreatedNotification;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginViewResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->singleton(LoginViewResponse::class, CustomLoginViewResponse::class);
        $this->app->register(\App\Providers\FortifyServiceProvider::class);
    }

    /**
     * Bootstrap any application services.()
     */
    public function boot(): void
    {

        foreach (config('abilities') as $code => $label) {

            Gate::define($code, function ($user) use ($code) {
                return $user->hasAbility($code);
                // return true;
            });
        }

        Schedule::job(new DeletedExpiredOrders)->everyMinute();



        Validator::extend('Filter', function ($attribute, $value, $params) {
            return ! in_array(strtolower($value), $params);
        }, "you cant use this word");





        Event::listen(
            OrederCreated::class,
            [EmptyCart::class, 'handle'],

        );


        // Event::listen('order.created', [DeductProductQuantity::class, 'handle']);
        // Event::listen('order.created', [EmptyCart::class, 'handle']);

        Paginator::useBootstrap();
    }
}
