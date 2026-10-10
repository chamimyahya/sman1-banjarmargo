<?php

namespace App\Providers;

use App\Models\MenuSitus;
use App\Support\Atur;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Throwable;

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
        View::composer('layouts.sekolah', function ($view) {
            try {
                $menu = MenuSitus::query()->where('aktif', true)->orderBy('urutan')->get();
            } catch (Throwable) {
                $menu = collect();
            }
            $view->with('menuSitus', $menu);
            $view->with('deskripsiSitus', Atur::ambil('seo', 'Situs resmi SMAN 1 Banjar Margo'));
        });
    }
}
