<?php

use App\Domain\Files\ValueObjects\Image;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImageFilesTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('product_image_files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_image_id');
            $table->string('path');
            $table->string('type')->default(Image::TYPE_ORIGINAL);
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_image_files');
    }
}
