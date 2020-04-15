<?php declare(strict_types=1);

namespace App\Domain\Files\Contracts;

interface Uploadable
{
    public function fullPath(): string;
    public function content(): string;
}
