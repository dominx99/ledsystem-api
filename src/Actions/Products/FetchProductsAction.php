<?php declare(strict_types=1);

namespace App\Actions\Products;

use App\Domain\Products\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;

final class FetchProductsAction
{
    private ProductRepository $products;

    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }

    public function __invoke(): JsonResponse
    {
        return new JsonResponse(
            $this->products->findAll(),
        );
    }
}
