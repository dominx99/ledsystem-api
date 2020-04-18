<?php declare(strict_types=1);

namespace App\Actions\Auth;

use Illuminate\Http\JsonResponse;
use App\Domain\Products\Requests\LoginRequest;
use App\Domain\Auth\DTO\AuthResult;
use App\Domain\Auth\Contracts\AuthGuardResolver;

final class LoginAction
{
    private AuthGuardResolver $authResolver;

    public function __construct(AuthGuardResolver $authResolver)
    {
        $this->authResolver = $authResolver;
    }

    public function __invoke(LoginRequest $request): JsonResponse
    {
        $guard = $this->authResolver->resolve($request->input('grant_type'));

        $result = new AuthResult();
        $guard->authenticate($request->validated(), $result);

        return new JsonResponse([
            'status'       => 'success',
            'access_token' => $result->accessToken(),
        ]);
    }
}
