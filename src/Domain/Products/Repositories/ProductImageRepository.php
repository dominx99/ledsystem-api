<?php declare(strict_types=1);

namespace App\Domain\Products\Repositories;

interface ProductImageRepository
{
    public function insert(array $images): void;
    public function exists(string $imageId): bool;
}
