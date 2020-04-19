<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductParameters extends Migration
{
    public function up(): void
    {
        Schema::create('product_parameters', function (Blueprint $table) {
            $table->uuid('id')->primary;
            $table->uuid('product_id');
            $table->uuid('parameter_name_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_parameters');
    }
}
