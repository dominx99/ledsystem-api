<?php

namespace App\Provider;

use App\Domain\Auth\Contracts\AuthGuardResolver as AuthGuardResolverContract;
use App\Domain\Auth\Resolvers\AuthGuardResolver;
use App\Domain\Files\FileReader;
use App\Domain\Files\FileUploader;
use App\Domain\Shared\Contracts\EventDispatcher;
use App\Filesystem\League\LeagueFileReader;
use App\Filesystem\League\LeagueFileUploader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Domain\Shared\Events\Dispatcher;

class AppServiceProvider extends ServiceProvider
{
    public array $singletons = [
        FileUploader::class => LeagueFileUploader::class,
        FileReader::class => LeagueFileReader::class,
        AuthGuardResolverContract::class => AuthGuardResolver::class,
        EventDispatcher::class => Dispatcher::class,
    ];

    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
