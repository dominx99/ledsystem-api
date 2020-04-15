<?php declare(strict_types=1);

namespace App\Database\Eloquent\Repositories;

use App\Domain\Products\Repositories\ProductRepository;
use App\Domain\Categories\Models\Category;
use Illuminate\Support\Collection;
use App\Domain\Products\Models\Product;

final class EloquentProductRepository implements ProductRepository
{
    public function findAllByCategorySlug(string $slug): Collection
    {
        if (! $category = Category::where('slug', $slug)->first()) {
            throw new \Exception("Category not found");
        }

        return Product::with(['unit', 'images'])
            ->join('category_product', 'products.id', '=', 'category_product.product_id')
            ->where('category_product.category_id', $category->id)
            ->select(['*', 'category_product.id as cp_id', 'products.id as id'])
            ->get();
    }

    public function save(Product $product): void
    {
        $product->save();
    }
}
