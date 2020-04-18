<?php declare(strict_types=1);

namespace App\Domain\Auth\Contracts;

interface AuthGuardResolver
{
    public function resolve(string $grantType): AuthGuard;
}
