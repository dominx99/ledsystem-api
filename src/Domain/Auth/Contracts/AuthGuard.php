<?php declare(strict_types=1);

namespace App\Domain\Auth\Contracts;

use App\Domain\Auth\DTO\AuthResult;

interface AuthGuard
{
    public function authenticate(array $params, AuthResult &$result): void;
}
