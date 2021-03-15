<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\MongoDB\AccountTransaction;
use App\Core\MongoAccountTransaction;

class AccountTransactionServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Core\MongoAccountTransaction', function ($app) {
            return new MongoAccountTransaction(
                new AccountTransaction
            );
        });

        $this->app->bind('App\Core\AccountTransaction', 'App\Core\MongoAccountTransaction');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}