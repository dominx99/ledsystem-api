<?php declare(strict_types=1);

namespace App\Actions\Parameters;

use Illuminate\Http\JsonResponse;
use App\Domain\Parameters\Repositories\ParameterRepository;

final class FetchAllParametersAction
{
    private ParameterRepository $parameters;

    public function __construct(ParameterRepository $parameters)
    {
        $this->parameters = $parameters;
    }

    public function __invoke(): JsonResponse
    {
        return new JsonResponse(
            $this->parameters->findAll(),
        );
    }
}
