<?php

namespace App\Providers;

use App\Contracts\BrandContract;
use App\Repositories\BrandRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
//        CategoryContract::class         =>          CategoryRepository::class,
//        AttributeContract::class        =>          AttributeRepository::class,
        BrandContract::class            =>          BrandRepository::class
//        ProductContract::class          =>          ProductRepository::class,
//        OrderContract::class            =>          OrderRepository::class,
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BrandContract::class , BrandRepository::class);

//        foreach ($this->repositories as $interface => $implementation)
//        {
//            $this->app->bind($interface, $implementation);
//        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
