<?php declare(strict_types=1);

namespace App\Domain\Products\Repositories;

use Illuminate\Support\Collection;
use App\Domain\Products\Models\Product;

interface ProductRepository
{
    public function findAll(): Collection;
    public function findById(string $id): Product;
    public function findBySlug(string $slug): Product;
    public function findAllByCategorySlug(string $categoryId): Collection;
    public function hasImage(string $productId, string $imageId): bool;

    public function save(Product $product): void;
    public function attachParameterValues(string $productId, array $parameterValueIds): void;
    public function updateMainImage(string $productId, string $imageId): void;
}
