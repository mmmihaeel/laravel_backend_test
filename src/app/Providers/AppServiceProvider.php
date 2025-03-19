<?php

namespace App\Providers;

use App\Services\CommentService;
use App\Services\Interfaces\CommentServiceInterface;
use App\Services\Interfaces\ProductServiceInterface;
use App\Services\Interfaces\PurchaseItemServiceInterface;
use App\Services\Interfaces\PurchaseServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\ProductService;
use App\Services\PurchaseItemService;
use App\Services\PurchaseService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(CommentServiceInterface::class, CommentService::class);
        $this->app->bind(PurchaseServiceInterface::class, PurchaseService::class);
        $this->app->bind(PurchaseItemServiceInterface::class, PurchaseItemService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
