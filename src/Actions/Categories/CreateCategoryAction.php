<?php declare(strict_types=1);

namespace App\Actions\Categories;

use Illuminate\Http\JsonResponse;
use App\Domain\Categories\Jobs\CreateCategoryJob;
use App\Domain\Categories\Requests\CreateCategoryRequest;

final class CreateCategoryAction
{
    public function __invoke(CreateCategoryRequest $request): JsonResponse
    {
        CreateCategoryJob::dispatch($request->only([
            'name',
            'slug',
            'parent_id',
        ]));

        return new JsonResponse(['status' => 'success']);
    }
}
