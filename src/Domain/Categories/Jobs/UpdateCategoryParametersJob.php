<?php declare(strict_types = 1);

namespace App\Domain\Categories\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use App\Domain\Categories\Broadcasting\CategoryParametersUpdated;

class UpdateCategoryParametersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $categoryId;
    private array $parameterNameIds;

    public function __construct(string $categoryId, array $parameterNameIds)
    {
        $this->categoryId = $categoryId;
        $this->parameterNameIds = $parameterNameIds;
    }

    public function handle(): void
    {
        try {
            DB::beginTransaction();

            DeleteCategoryParametersJob::dispatch($this->categoryId);
            AssignCategoryParametersJob::dispatch($this->categoryId, $this->parameterNameIds);
            broadcast(new CategoryParametersUpdated($this->categoryId));

            DB::commit();
        } catch (\Throwable $t) {
            DB::rollBack();

            throw $t;
        }
    }
}
