<?php declare(strict_types=1);

namespace App\Domain\Products\Repositories;

use Illuminate\Support\Collection;

interface ProductRepository
{
    public function findAllByCategorySlug(string $categoryId): Collection;
}
