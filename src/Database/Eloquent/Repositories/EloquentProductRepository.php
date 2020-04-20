<?php declare(strict_types=1);

namespace App\Database\Eloquent\Repositories;

use App\Domain\Products\Repositories\ProductRepository;
use App\Domain\Categories\Models\Category;
use Illuminate\Support\Collection;
use App\Domain\Products\Models\Product;
use App\Domain\Shared\Exceptions\BusinessException;
use Illuminate\Support\Facades\DB;

final class EloquentProductRepository implements ProductRepository
{
    public function findAll(): Collection
    {
        return Product::with(['unit', 'images.original', 'images.thumbnail', 'images.micro'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function findAllByCategorySlug(string $slug): Collection
    {
        if (! $category = Category::where('slug', $slug)->first()) {
            throw new BusinessException("Category not found.");
        }

        return Product::with(['unit', 'images.original', 'images.thumbnail', 'images.micro'])
            ->join('category_product', 'products.id', '=', 'category_product.product_id')
            ->where('category_product.category_id', $category->id)
            ->select(['*', 'category_product.id as cp_id', 'products.id as id'])
            ->get();
    }

    public function findById(string $id): Product
    {
        $product = Product::with([
                'categories',
                'unit',
                'parameters.name',
                'parameters.values',
                'images.thumbnail',
                'images.original',
                'images.micro'
            ])
            ->find($id);

        if (! $product) {
            throw new BusinessException('Product not found.');
        }

        return $product;
    }

    public function findBySlug(string $slug): Product
    {
        $product = Product::with([
                'parameters.name',
                'parameters.values',
                'unit',
                'images.thumbnail',
                'images.original',
                'images.micro'
            ])
            ->where('slug', $slug)
            ->first();

        if (! $product) {
            throw new BusinessException('Product not found.');
        }

        return $product;
    }

    public function attachParameterValues(string $productId, array $parameterValueIds): void
    {
        $params = array_map(
            fn($parameterValueId) => [
                'product_id' => $productId,
                'parameter_value_id' => $parameterValueId
            ],
            $parameterValueIds
        );

        DB::table('parameter_value_prouct')->insert($params);
    }

    public function save(Product $product): void
    {
        $product->save();
    }
}
