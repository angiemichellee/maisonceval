<?php

namespace App\Providers;

use App\Models\Contact;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Every page (navigation, footer, order buttons) needs the shop's
        // contact details. Loaded once per request, only when a view renders.
        View::composer('*', function ($view) {
            $view->with('contact', once(fn () => Contact::current()));
        });
    }
}
