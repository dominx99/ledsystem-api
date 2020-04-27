<?php declare(strict_types=1);

namespace App\Actions\Categories;

use Illuminate\Http\JsonResponse;
use App\Domain\Categories\Jobs\UpdateCategoryJob;
use App\Domain\Categories\Requests\UpdateCategoryRequest;
use App\Domain\Shared\Exceptions\BusinessException;
use App\Domain\Categories\Repositories\CategoryRepository;

final class UpdateCategoryAction
{
    private CategoryRepository $categories;

    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    public function __invoke(UpdateCategoryRequest $request, string $categoryId): JsonResponse
    {
        // TODO: Move this code in better location
        if (
            is_string($request->input('parent_id')) &&
            $this->categories->isDescendantOf($request->input('parent_id'), $categoryId)
        ) {
            throw new BusinessException(
                'Ekhm? Próbujesz ustawić kategorię podrzędną aktualnej jako nadrzędną. Matrix!'
            );
        }

        UpdateCategoryJob::dispatch($categoryId, $request->only([
            'name',
            'slug',
            'parent_id',
        ]));

        return new JsonResponse(['status' => 'success']);
    }
}
