<?php declare(strict_types = 1);

namespace App\Domain\Categories\Jobs;

use App\Domain\Categories\Repositories\CategoryRepository;
use App\Domain\Shared\Exceptions\BusinessException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Bus\Queueable;
use App\Domain\Categories\Broadcasting\CategoryUpdated;

class UpdateCategoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    private string $categoryId;
    private array $params;

    public function __construct(string $categoryId, array $params)
    {
        $this->categoryId = $categoryId;
        $this->params = $params;
    }

    public function handle(CategoryRepository $categories): void
    {
        try {
            $category = $categories->findById($this->categoryId);
            $category->fill($this->params);
            $categories->persist($category);

            broadcast(new CategoryUpdated($this->categoryId));
        } catch(BusinessException $e) {
            //TODO: throw broadcast exception

            throw $e;
        }
    }
}
