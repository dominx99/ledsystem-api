<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParameterValueProductParameterTable extends Migration
{
    public function up(): void
    {
        Schema::create('parameter_value_product_parameter', function (Blueprint $table) {
            $table->uuid('product_parameter_id');
            $table->uuid('parameter_value_id');
            $table->primary(['product_parameter_id', 'parameter_value_id'], 'product_parameter_identifier');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parameter_value_product_parameter');
    }
}
