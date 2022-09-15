<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\ViewComposers\CategoriesComposer;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('index', CategoriesComposer::class);
        View::composer('search', CategoriesComposer::class);
    }
}
