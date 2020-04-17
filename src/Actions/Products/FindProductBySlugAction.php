<?php declare(strict_types=1);

namespace App\Actions\Products;

use App\Domain\Products\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class FindProductBySlugAction
{
    private ProductRepository $products;

    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }

    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->products->findBySlug($request->input('slug')),
        );
    }
}
