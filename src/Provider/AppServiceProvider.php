<?php

namespace App\Provider;

use App\Domain\Auth\Contracts\AuthGuardResolver as AuthGuardResolverContract;
use App\Domain\Auth\Resolvers\AuthGuardResolver;
use App\Domain\Files\FileReader;
use App\Domain\Files\FileUploader;
use App\Domain\Shared\Events\Dispatcher as EventsDispatcher;
use App\Filesystem\League\LeagueFileReader;
use App\Filesystem\League\LeagueFileUploader;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public array $singletons = [
        Dispatcher::class => EventsDispatcher::class,
        FileUploader::class => LeagueFileUploader::class,
        FileReader::class => LeagueFileReader::class,
        AuthGuardResolverContract::class => AuthGuardResolver::class,
    ];

    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
