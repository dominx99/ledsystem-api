<?php declare(strict_types=1);

namespace App\Database\Eloquent\Categories\Repositories;

use App\Domain\Categories\Models\Category;
use App\Domain\Categories\Repositories\CategoryRepository;
use App\Domain\Shared\Exceptions\BusinessException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class EloquentCategoryRepository implements CategoryRepository
{
    public function findAll(): Collection
    {
        return Category::get();
    }

    public function findAllParent(): Collection
    {
        return Category::whereNull('parent_id')->get();
    }

    public function findById(string $categoryId): Category
    {
        if (! $category = Category::with(['parameters', 'parent'])->find($categoryId)) {
            throw new BusinessException("Category not found.");
        }

        return $category;
    }

    public function persist(Category $category): void
    {
        $category->save();
    }

    public function isDescendantOf(string $categoryId, string $parentId): bool
    {
        $childrenIds = $this->getChildrenIds($parentId);

        foreach ($childrenIds as $childId) {
            if ($childId === $categoryId) {
                Log::info("child is child");
                return true;
            }

            if ($this->isDescendantOf($categoryId, $childId)) {
                Log::info("is descendant");
                return true;
            }
        }

        return false;
    }

    private function getChildrenIds(string $categoryId): Collection
    {
        return DB::table('categories')
            ->where('parent_id', $categoryId)
            ->get()
            ->pluck('id');
    }
}
