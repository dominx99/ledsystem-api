<?php declare(strict_types=1);

namespace App\Database\Eloquent\Repositories;

use App\Domain\Products\Models\ProductUnit;
use App\Domain\Products\Repositories\ProductUnitRepository;

final class EloquentProductUnitRepository implements ProductUnitRepository
{
    public function save(ProductUnit $productUnit): void
    {
        $productUnit->save();
    }
}
