<?php declare(strict_types = 1);

namespace App\Domain\Categories\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class AssignCategoryParametersJob implements ShouldQueue
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
        $params = array_map(fn($parameterNameId) => [
            'category_id'       => $this->categoryId,
            'parameter_name_id' => $parameterNameId,
        ], $this->parameterNameIds);

        DB::table('category_parameter_name')->insert($params);
    }
}
