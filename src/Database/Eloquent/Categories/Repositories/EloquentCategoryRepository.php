<?php declare(strict_types=1);

namespace App\Database\Eloquent\Categories\Repositories;

use App\Domain\Categories\Models\Category;
use App\Domain\Categories\Repositories\CategoryRepository;
use App\Domain\Shared\Exceptions\BusinessException;

final class EloquentCategoryRepository implements CategoryRepository
{
    public function findById(string $categoryId): Category
    {
        if (! $category = Category::find($categoryId)) {
            throw new BusinessException("Category not found.");
        }

        return $category;
    }
}
