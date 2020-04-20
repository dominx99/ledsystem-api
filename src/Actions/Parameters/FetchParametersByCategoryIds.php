<?php declare(strict_types=1);

namespace App\Actions\Parameters;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Domain\Parameters\Repositories\ParameterRepository;

final class FetchParametersByCategoryIds
{
    private ParameterRepository $parameters;

    public function __construct(ParameterRepository $parameters)
    {
        $this->parameters = $parameters;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $request->validate(['category_ids' => 'required|array']);

        return new JsonResponse(
            $this->parameters->findAllByCategoryIds($request->input('category_ids')),
        );
    }
}
