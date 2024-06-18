<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Opcodes\LogViewer\Facades\LogViewer;

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
        Schema::defaultStringLength(191);

        LogViewer::auth(function ($request) {
            return $request->user()
                && in_array($request->user()->email, [
                    'fa-development@rpxholding.com',
                ]);
        });

        Builder::macro('whereLike', function ($columns, $search) {
            $this->where(function ($query) use ($columns, $search) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'like', '%' . $search . '%');
                }
            });
            return $this;
        });
    }
}
