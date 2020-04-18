<?php declare(strict_types=1);

namespace App\Domain\Auth\DTO;

use App\Domain\Shared\Exceptions\SystemException;

final class AuthResult
{
    private string $accessToken;

    public function fill(array $data)
    {
        if (empty($data['accessToken'])) {
            throw new SystemException("Access token is not present in auth result.");
        }

        $this->accessToken = $data['accessToken'];
    }

    public function accessToken(): string
    {
        return $this->accessToken;
    }
}
