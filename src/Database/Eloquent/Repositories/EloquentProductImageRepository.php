<?php declare(strict_types=1);

namespace App\Database\Eloquent\Repositories;

use App\Domain\Products\Repositories\ProductImageRepository;
use Illuminate\Support\Facades\DB;

final class EloquentProductImageRepository implements ProductImageRepository
{
    public function insert(array $images): void
    {
        DB::table('product_images')->insert($images);
    }
}
