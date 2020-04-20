<?php declare(strict_types=1);

namespace App\Domain\Shared\Events;

use Illuminate\Events\Dispatcher as EventsDispatcher;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Log;

final class Dispatcher extends EventsDispatcher
{
    public function dispatchAll(Collection $events): void
    {
        $events->each(function ($event) {
            event($event);
        });
    }
}
