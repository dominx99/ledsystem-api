<?php declare(strict_types=1);

namespace App\Domain\Products\Events;

final class ProductImagesSaved
{
    private string $productId;

    public function __construct(string $productId)
    {
        $this->productId = $productId;
    }

    public function productId(): string
    {
        return $this->productId;
    }
}
