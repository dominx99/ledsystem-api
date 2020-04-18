<?php declare(strict_types=1);

namespace App\Domain\Auth\Resolvers;

use App\Domain\Auth\Contracts\AuthGuard;
use App\Domain\Auth\Contracts\AuthGuardResolver as AuthGuardResolverContract;
use App\Domain\Shared\Exceptions\SystemException;
use App\Domain\Users\Repositories\UserRepository;
use App\Domain\Auth\Guards\CredentialAuthGuard;

final class AuthGuardResolver implements AuthGuardResolverContract
{
    private UserRepository $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function resolve(string $grantType): AuthGuard
    {
        if ($grantType === CredentialAuthGuard::TYPE) {
            return new CredentialAuthGuard($this->users);
        }

        throw new SystemException(sprintf('Grant type %s not supported.', $grantType));
    }
}
