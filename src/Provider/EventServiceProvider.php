<?php

namespace App\Provider;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Domain\Products\Events\ProductCreated;
use App\Domain\Products\Listeners\CreateProductImages;
use App\Domain\Products\Listeners\CreateProductUnit;
use App\Domain\Products\Events\ProductImagesSaved;
use App\Domain\Products\Listeners\AttachProductToCategories;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ProductCreated::class => [
            CreateProductUnit::class,
            AttachProductToCategories::class,
        ],
        ProductImagesSaved::class => [
            CreateProductImages::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
