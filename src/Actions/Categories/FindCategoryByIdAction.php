<?php declare(strict_types=1);

namespace App\Actions\Categories;

use Illuminate\Http\JsonResponse;
use App\Domain\Categories\Repositories\CategoryRepository;

final class FindCategoryByIdAction
{
    private CategoryRepository $categories;

    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    public function __invoke(string $categoryId): JsonResponse
    {
        return new JsonResponse(
            $this->categories->findById($categoryId),
        );
    }
}
