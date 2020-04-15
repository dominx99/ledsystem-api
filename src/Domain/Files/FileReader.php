<?php declare(strict_types=1);

namespace App\Domain\Files;

interface FileReader
{
    public function filesFromDirectory(string $path): array;
}
