<?php declare(strict_types = 1);

namespace App\Domain\Categories\Jobs;

use App\Domain\Categories\Repositories\CategoryRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Bus\Queueable;
use App\Domain\Categories\Models\Category;
use App\Domain\Shared\Contracts\EventDispatcher;

class CreateCategoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    private array $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function handle(CategoryRepository $categories, EventDispatcher $events): void
    {
        $category = Category::new($this->params);

        $categories->persist($category);
        $events->dispatchAll($category->events());
    }
}
