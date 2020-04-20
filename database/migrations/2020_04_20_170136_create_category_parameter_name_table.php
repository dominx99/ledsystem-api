<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryParameterNameTable extends Migration
{
    public function up(): void
    {
        Schema::create('category_parameter_name', function (Blueprint $table) {
            $table->uuid('category_id');
            $table->uuid('parameter_name_id');
            $table->primary(['category_id', 'parameter_name_id'], 'category_parameters_identifier');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_parameter_name');
    }
}
