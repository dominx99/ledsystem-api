<?php

namespace App\Provider;

use App\Database\Eloquent\Repositories\EloquentProductImageRepository;
use App\Database\Eloquent\Repositories\EloquentProductRepository;
use Illuminate\Support\ServiceProvider;
use App\Domain\Products\Repositories\ProductRepository;
use App\Domain\Products\Repositories\ProductUnitRepository;
use App\Database\Eloquent\Repositories\EloquentProductUnitRepository;
use App\Domain\Products\Repositories\ProductImageRepository;
use App\Domain\Products\Repositories\ProductImageFileRepository;
use App\Database\Eloquent\Repositories\EloquentProductImageFileRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $singletons = [
        ProductRepository::class => EloquentProductRepository::class,
        ProductUnitRepository::class => EloquentProductUnitRepository::class,
        ProductImageRepository::class => EloquentProductImageRepository::class,
        ProductImageFileRepository::class => EloquentProductImageFileRepository::class,
    ];
}
