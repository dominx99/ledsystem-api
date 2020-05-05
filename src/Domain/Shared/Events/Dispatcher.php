<?php declare(strict_types=1);

namespace App\Domain\Shared\Events;

use Illuminate\Support\Collection;
use App\Domain\Shared\Contracts\EventDispatcher;

final class Dispatcher implements EventDispatcher
{
    public function dispatchAll(Collection $events): void
    {
        $events->each(function ($event) {
            event($event);
        });
    }
}
