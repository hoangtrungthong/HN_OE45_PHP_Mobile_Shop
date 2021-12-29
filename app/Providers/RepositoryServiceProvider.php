<?php

namespace App\Providers;

use App\Contracts\Repositories\CategoryRepository;
use App\Contracts\Repositories\ColorRepository;
use App\Contracts\Repositories\MemoryRepository;
use App\Contracts\Repositories\ProductAttributeRepository;
use App\Contracts\Repositories\ProductImageRepository;
use App\Contracts\Repositories\ProductRepository;
use App\Repositories\ELoquentCategoryRepository;
use App\Repositories\ELoquentColorRepository;
use App\Repositories\ELoquentMemoryRepository;
use App\Repositories\ELoquentProductAttributeRepository;
use App\Repositories\ELoquentProductImageRepository;
use App\Repositories\EloquentProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
    * The repository mappings for applications.
    */
    protected $repository = [
        CategoryRepository::class => ELoquentCategoryRepository::class,
        ColorRepository::class => ELoquentColorRepository::class,
        MemoryRepository::class => ELoquentMemoryRepository::class,
        ProductRepository::class => EloquentProductRepository::class,
        ProductAttributeRepository::class => ELoquentProductAttributeRepository::class,
        ProductImageRepository::class => ELoquentProductImageRepository::class,
    ];

     /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repository as $interface => $class) {
            $this->app->singleton($interface, $class);
        }
    }
}
