<?php

namespace App\Domain\Products\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;

class CreateParametersOnProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $productId;
    private array $parameters;

    public function __construct(string $productId, array $parameters)
    {
        $this->productId = $productId;
        $this->parameters = $parameters;
    }

    public function handle(): void
    {
        $parameters = [];
        $parameterValues = [];

        $parameterNames = array_map(function ($parameter) use(&$parameterValues, &$parameters) {
            $parameterNameId = (string) Uuid::uuid4();
            $parameterValueIds = [];

            $parameterValues = array_merge(
                $parameterValues,
                array_map(function ($value) use ($parameterNameId, &$parameterValueIds) {
                    $parameterValueIds[] = $parameterValueId = (string) Uuid::uuid4();

                    return [
                        'id'                => $parameterValueId,
                        'parameter_name_id' => $parameterNameId,
                        'value'             => $value,
                    ];
                }, $parameter["values"])
            );

            $parameters[] = [
                'parameter_name_id'   => $parameterNameId,
                'parameter_value_ids' => $parameterValueIds,
            ];

            return [
                'id' => $parameterNameId,
                'name' => $parameter["name"],
            ];
        }, $this->parameters);

        DB::table('parameter_names')->insert($parameterNames);
        DB::table('parameter_values')->insert($parameterValues);

        AssignProductParameterValuesJob::dispatch($this->productId, $parameters);
    }
}
