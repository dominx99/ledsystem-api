<?php

use App\Domain\Products\Models\ProductUnit;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductUnitsTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('product_units', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type')->default(ProductUnit::PIECE_TYPE);
            $table->integer('base')->default(1);
            $table->integer('step')->default(1);
            $table->bigInteger('price');
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_units');
    }
}
