<?php declare(strict_types=1);

namespace App\Domain\Categories\Repositories;

use App\Domain\Categories\Models\Category;
use Illuminate\Support\Collection;

interface CategoryRepository
{
    public function findAll(): Collection;
    public function findAllParent(): Collection;
    public function findById(string $categoryId): Category;
    public function isDescendantOf(string $categoryId, string $parentId): bool;

    public function persist(Category $category): void;
}
