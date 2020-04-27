<?php declare(strict_types=1);

namespace App\Domain\Categories\Broadcasting;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

final class CategoryUpdated implements ShouldBroadcast
{
    public string $categoryId;

    public function __construct(string $categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function broadcastOn()
    {
        return ['category.' . $this->categoryId];
    }

    public function broadcastAs(): string
    {
        return 'category.updated';
    }
}
