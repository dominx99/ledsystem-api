<?php

namespace App\Provider;

use App\Database\Eloquent\Repositories\EloquentProductRepository;
use Illuminate\Support\ServiceProvider;
use App\Domain\Products\Repositories\ProductRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $singletons = [
        ProductRepository::class => EloquentProductRepository::class,
    ];
}
