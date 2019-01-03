<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
         Route::pattern('id', '[0-9]+');
         
         parent::boot();

         // Membuat route model binding ke route
        Route::model('agenda', 'App\Agenda');
        Route::model('artikel', 'App\Artikel');
        Route::model('dana', 'App\Dana');
        Route::model('agenda', 'App\Agenda');
        Route::model('foto', 'App\Foto');
        Route::model('guru', 'App\Guru');
        Route::model('kategori', 'App\Kategori');
        Route::model('kelas', 'App\Kelas');
        Route::model('mapel', 'App\mapel');
        Route::model('materi', 'App\materi');
        Route::model('prestasi', 'App\Prestasi');
        Route::model('siswa', 'App\Siswa');
        Route::model('situs', 'App\Situs');
        Route::model('user', 'App\User');
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
