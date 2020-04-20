<?php declare(strict_types=1);

namespace App\Database\Eloquent\Parameters\Repositories;

use App\Domain\Categories\Models\Category;
use App\Domain\Parameters\Repositories\ParameterRepository;
use Illuminate\Support\Collection;

final class EloquentParameterRepository implements ParameterRepository
{
    public function findAllByCategoryIds(array $categoryIds): Collection
    {
        $parameters = Category::with('parameters.defaultValues')
            ->whereIn('id', $categoryIds)
            ->get()
            ->pluck('parameters')
            ->flatten();

        return $parameters;
    }
}
