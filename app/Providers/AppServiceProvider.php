<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Resources\Json\Resource;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Resource::withoutWrapping();
        Route::resourceVerbs([
            'create' => 'tambah',
            'edit' => 'ubah',
            'show' => 'detail',
        ]);
        setlocale(LC_ALL, 'id_ID');
        Carbon::setLocale('id_ID');
    }

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
