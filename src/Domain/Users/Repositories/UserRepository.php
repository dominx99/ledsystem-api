<?php declare(strict_types=1);

namespace App\Domain\Users\Repositories;

use App\Domain\Users\Models\User;

interface UserRepository
{
    public function findByEmail(string $email): User;
    public function updateAccessToken(string $userId, string $accessToken): void;
}
