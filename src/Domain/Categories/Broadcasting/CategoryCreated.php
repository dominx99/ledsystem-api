<?php declare(strict_types=1);

namespace App\Domain\Categories\Broadcasting;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

final class CategoryCreated implements ShouldBroadcast
{
    public string $categoryId;

    public function __construct(string $categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function broadcastOn()
    {
        return ['categories'];
    }

    public function broadcastAs(): string
    {
        return 'category.created';
    }
}
