<?php declare(strict_types=1);

namespace App\Actions\Categories;

use App\Domain\Categories\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class UpdateCategoryParametersctio
{
    public function __invoke(Request $request): JsonResponse
    {
        if (! $category = Category::where('slug', $request->input('slug'))->first()) {
            throw new \Exception('Category not found');
        }

        return new JsonResponse($category->oneNestedChildren()->get());
    }
}
