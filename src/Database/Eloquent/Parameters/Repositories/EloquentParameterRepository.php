<?php declare(strict_types=1);

namespace App\Database\Eloquent\Parameters\Repositories;

use App\Domain\Categories\Models\Category;
use App\Domain\Parameters\Models\ParameterName;
use App\Domain\Parameters\Repositories\ParameterRepository;
use Illuminate\Support\Collection;

final class EloquentParameterRepository implements ParameterRepository
{
    public function findAll(): Collection
    {
        return ParameterName::get();
    }

    public function findAllByCategoryIds(array $categoryIds): Collection
    {
        $parameters = Category::with('parameters.defaultValues')
            ->whereIn('id', $categoryIds)
            ->get()
            ->pluck('parameters')
            ->flatten()
            ->unique('id')
            ->values();

        return $parameters;
    }
}
