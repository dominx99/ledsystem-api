<?php declare(strict_types=1);

namespace App\Domain\Products\Repositories;

interface ProductImageFileRepository
{
    public function insert(array $files): void;
}
