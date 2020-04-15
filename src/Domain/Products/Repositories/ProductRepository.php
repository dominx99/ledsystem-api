<?php declare(strict_types=1);

namespace App\Domain\Products\Repositories;

use Illuminate\Support\Collection;
use App\Domain\Products\Models\Product;

interface ProductRepository
{
    public function findAllByCategorySlug(string $categoryId): Collection;
    public function save(Product $product): void;
}
