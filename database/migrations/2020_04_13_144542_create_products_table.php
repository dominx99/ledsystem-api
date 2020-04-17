<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Products\Models\Product;

class CreateProductsTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_unit_id');
            $table->string('name');
            $table->string('slug');
            $table->string('status')->default(Product::STATUS_NEW);
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
