<?php

namespace App\Domain\Products\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class AssignProductParametersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $productId;
    private array $parameters;
    private array $newParameters;

    public function __construct(string $productId, array $parameters, array $newParameters)
    {
        $this->productId = $productId;
        $this->parameters = $parameters;
        $this->newParameters = $newParameters;
    }

    public function handle(): void
    {
        try {
            DB::beginTransaction();

            AssignProductParameterValuesJob::dispatch($this->productId, $this->parameters);
            CreateParametersOnProduct::dispatch($this->productId, $this->newParameters);

            DB::commit();
        } catch (\Throwable $t) {
            DB::rollBack();

            throw $t;
        }
    }
}
