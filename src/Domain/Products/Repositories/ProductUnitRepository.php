<?php declare(strict_types=1);

namespace App\Domain\Products\Repositories;

use App\Domain\Products\Models\ProductUnit;

interface ProductUnitRepository
{
    public function save(ProductUnit $productUnit): void;
}
