<?php declare(strict_types=1);

namespace App\Actions\Categories;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Domain\Categories\Jobs\UpdateCategoryParametersJob;

final class UpdateCategoryParametersAction
{
    public function __invoke(Request $request, string $categoryId): JsonResponse
    {
        UpdateCategoryParametersJob::dispatch(
            $categoryId,
            $request->input('parameter_name_ids'),
        );

        return new JsonResponse(['status' => 'success']);
    }
}
