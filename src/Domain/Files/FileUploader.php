<?php declare(strict_types=1);

namespace App\Domain\Files;

use App\Domain\Files\Contracts\Uploadable;

interface FileUploader
{
    public function upload(Uploadable $file): void;
}
