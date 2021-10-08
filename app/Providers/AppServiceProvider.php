<?php

namespace App\Providers;

use App\Services\AlbumCompiler;
use Digi\Services\DigiAlbumCompiler;
use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(AlbumCompiler::class, DigiAlbumCompiler::class);
    }
}
