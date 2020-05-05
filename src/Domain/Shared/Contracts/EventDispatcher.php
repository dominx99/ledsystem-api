<?php declare(strict_types=1);

namespace App\Domain\Shared\Contracts;

use Illuminate\Support\Collection;

interface EventDispatcher
{
    public function dispatchAll(Collection $events): void;
}
