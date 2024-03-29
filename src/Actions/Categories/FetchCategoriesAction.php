<?php declare(strict_types=1);

namespace App\Actions\Categories;

use App\Domain\Categories\Repositories\CategoryRepository;
use Illuminate\Http\JsonResponse;

final class FetchCategoriesAction
{
    private CategoryRepository $categories;

    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    public function __invoke(): JsonResponse
    {
        return new JsonResponse(
            $this->categories->findAll(),
        );
    }
}
