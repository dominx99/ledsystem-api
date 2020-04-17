<?php declare(strict_types=1);

namespace App\Database\Eloquent\Repositories;

use Illuminate\Support\Facades\DB;
use App\Domain\Products\Repositories\ProductImageFileRepository;

final class EloquentProductImageFileRepository implements ProductImageFileRepository
{
    public function insert(array $files): void
    {
        DB::table('product_image_files')->insert($files);
    }
}
