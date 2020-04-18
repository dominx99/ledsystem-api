<?php declare(strict_types=1);

namespace App\Domain\Auth\Guards;

use App\Domain\Auth\Contracts\AuthGuard;
use App\Domain\Auth\DTO\AuthResult;
use App\Domain\Shared\Exceptions\BusinessException;
use App\Domain\Shared\JWT\JWTEncoder;
use App\Domain\Users\Repositories\UserRepository;

final class CredentialAuthGuard implements AuthGuard
{
    const TYPE = "credentials";

    private UserRepository $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function authenticate(array $params, AuthResult &$result): void
    {
        try {
            $user = $this->users->findByEmail($params['email']);
        } catch (BusinessException $e) {
            throw new BusinessException("Zły login lub hasło.");
        }

        if (! password_verify($params['password'], $user->password)) {
            throw new BusinessException("Zły login lub hasło.");
        }

        $accessToken = JWTEncoder::fromUser($user);

        $this->users->updateAccessToken($user->id, $accessToken);

        $result->fill(['accessToken' => $accessToken]);
    }
}
