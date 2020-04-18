<?php declare(strict_types=1);

namespace App\Database\Eloquent\Users\Repositories;

use App\Domain\Shared\Exceptions\BusinessException;
use App\Domain\Users\Models\User;
use App\Domain\Users\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

final class EloquentUserRepository implements UserRepository
{
    public function findByEmail(string $email): User
    {
        if (! $user = User::where('email', $email)->first()) {
            throw new BusinessException("User not found.");
        }

        return $user;
    }

    public function updateAccessToken(string $userId, string $accessToken): void
    {
        DB::table('users')
            ->where('id', $userId)
            ->update(['access_token' => $accessToken]);
    }
}
