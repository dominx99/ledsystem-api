<?php

namespace App\Provider;

use App\Database\Eloquent\Categories\Repositories\EloquentCategoryRepository;
use App\Database\Eloquent\Parameters\Repositories\EloquentParameterRepository;
use App\Database\Eloquent\Repositories\EloquentProductImageRepository;
use App\Database\Eloquent\Repositories\EloquentProductRepository;
use Illuminate\Support\ServiceProvider;
use App\Domain\Products\Repositories\ProductRepository;
use App\Domain\Products\Repositories\ProductUnitRepository;
use App\Database\Eloquent\Repositories\EloquentProductUnitRepository;
use App\Domain\Products\Repositories\ProductImageRepository;
use App\Domain\Products\Repositories\ProductImageFileRepository;
use App\Database\Eloquent\Repositories\EloquentProductImageFileRepository;
use App\Database\Eloquent\Users\Repositories\EloquentUserRepository;
use App\Domain\Categories\Repositories\CategoryRepository;
use App\Domain\Parameters\Repositories\ParameterRepository;
use App\Domain\Users\Repositories\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $singletons = [
        ProductRepository::class => EloquentProductRepository::class,
        ProductUnitRepository::class => EloquentProductUnitRepository::class,
        ProductImageRepository::class => EloquentProductImageRepository::class,
        ProductImageFileRepository::class => EloquentProductImageFileRepository::class,
        UserRepository::class => EloquentUserRepository::class,
        CategoryRepository::class => EloquentCategoryRepository::class,
        ParameterRepository::class => EloquentParameterRepository::class,
    ];
}
