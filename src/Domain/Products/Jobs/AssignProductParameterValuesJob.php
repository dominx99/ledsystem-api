<?php

namespace App\Domain\Products\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class AssignProductParameterValuesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $productId;
    private array $parameters;

    public function __construct(string $productId,  array $parameters)
    {
        $this->productId = $productId;
        $this->parameters = $parameters;
    }

    public function handle(): void
    {
        $productParameterValues = [];

        $productParameters = array_map(function (array $parameter) use (&$productParameterValues) {
            $productParameterId = (string) Uuid::uuid4();

            $productParameterValues = array_merge($productParameterValues, array_map(fn($value) => [
                'product_parameter_id' => $productParameterId,
                'parameter_value_id'   => $value,
            ], $parameter['parameter_value_ids']));

            return [
                'id'                => $productParameterId,
                'product_id'        => $this->productId,
                'parameter_name_id' => $parameter['parameter_name_id'],
            ];
        }, $this->parameters);

        DB::table('product_parameters')->insert($productParameters);
        DB::table('parameter_value_product_parameter')->insert($productParameterValues);
    }
}
