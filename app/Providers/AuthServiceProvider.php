<?php

namespace App\Providers;

use App\Artikel;
use App\Policies\ArtikelPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Artikel' => 'App\Policies\ArtikelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Membuat Gate untuk Admin
        Gate::define('isAdmin', function ($user) {
            return $user->type == 'admin';
        });
        // Membuat Gate untuk Guru
        Gate::define('isGuru', function ($user) {
            return $user->type == 'guru';
        });

        // Laravel Passposrt API Auth
        Passport::routes();
    }
}
