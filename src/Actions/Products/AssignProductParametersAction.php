<?php declare(strict_types=1);

namespace App\Actions\Products;

use Illuminate\Http\JsonResponse;
use App\Domain\Products\Jobs\AssignProductParametersJob;
use Illuminate\Http\Request;

final class AssignProductParametersAction
{
    public function __invoke(Request $request, string $productId): JsonResponse
    {
        AssignProductParametersJob::dispatch(
            $productId,
            $request->input('parameters'),
            $request->input('new_parameters'),
        );

        return new JsonResponse(['status' => 'success']);
    }
}
