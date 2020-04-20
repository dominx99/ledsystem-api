<?php declare(strict_types=1);

namespace App\Domain\Products\Broadcasting;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

final class ProductCreated implements ShouldBroadcast
{
    public string $productId;

    public function __construct(string $productId)
    {
        $this->productId = $productId;
    }

    public function broadcastOn()
    {
        return ['products'];
    }

    public function broadcastAs(): string
    {
        return 'product.created';
    }
}
