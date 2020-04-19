<?php declare(strict_types=1);

namespace App\Domain\Categories\Repositories;

use App\Domain\Categories\Models\Category;

interface CategoryRepository
{
    public function findById(string $categoryId): Category;
}
