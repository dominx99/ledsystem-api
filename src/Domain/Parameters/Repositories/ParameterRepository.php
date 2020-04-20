<?php declare(strict_types=1);

namespace App\Domain\Parameters\Repositories;

use Illuminate\Support\Collection;

interface ParameterRepository
{
    public function findAllByCategoryIds(array $categoryIds): Collection;
}
