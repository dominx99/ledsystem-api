<?php declare(strict_types=1);

namespace App\Actions\Products;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Domain\Products\Repositories\ProductRepository;

final class FetchProductsByCategory
{
    private ProductRepository $products;

    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }

    public function __invoke(Request $request, string $categoryId): JsonResponse
    {
        return new JsonResponse(
            $this->products->findAllByCategorySlug($categoryId)
        );
    }
}
