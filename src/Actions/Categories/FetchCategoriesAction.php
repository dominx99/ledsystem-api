<?php declare(strict_types=1);

namespace App\Actions\Categories;

use App\Domain\Categories\Models\Category;
use Illuminate\Http\JsonResponse;

final class FetchCategoriesAction
{
    public function __invoke(): JsonResponse
    {
        $categories = Category::whereNull('parent_id')->get();

        return new JsonResponse($categories);
    }
}
