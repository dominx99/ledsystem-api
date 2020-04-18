<?php declare(strict_types=1);

namespace App\Domain\Shared\JWT;

use Firebase\JWT\JWT;
use App\Domain\Users\Models\User;

final class JWTEncoder extends JWT
{
    public static function fromUser(User $user): string
    {
        return static::encode([
            'id' => $user->id,
        ], getenv('JWT_KEY'));
    }
}
