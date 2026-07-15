<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Brand;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        View::composer('components.footer', function ($view) {

            $view->with([
                'footerCategories' => Category::take(5)->get(),

                'footerBrands' => Brand::where('status', true)
                    ->take(5)
                    ->get(),
            ]);
        });
    }
}
