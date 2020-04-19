<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;

class ParameterSeeder extends Seeder
{
    public function run(): void
    {
        $parameters = [
            [
                'name' => 'Barwa',
                'values' => [
                    'Ciepła', 'Zimna',
                ],
            ],
            [
                'name' => 'Kolor',
                'values' => [
                    'czerwony', 'czarny', 'zielony',
                ],
            ],
            [
                'name' => 'rodzaj',
                'values' => [
                    'normalny',
                ],
            ],
        ];

        $parameterValues = [];

        $parameterNames = array_map(function ($parameter) use (&$parameterValues) {
            $parameterNameId = (string) Uuid::uuid4();

            $parameterValues = array_merge($parameterValues, array_map(fn($value) => [
                'id'                => (string) Uuid::uuid4(),
                'parameter_name_id' => $parameterNameId,
                'value'             => $value,
            ], $parameter['values']));

            return [
                'id'   => $parameterNameId,
                'name' => $parameter['name'],
            ];
        }, $parameters);

        DB::table('parameter_names')->insert($parameterNames);
        DB::table('parameter_values')->insert($parameterValues);
    }
}
