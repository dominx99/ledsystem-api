<?php declare(strict_types=1);

namespace App\Domain\Files\ValueObjects;

class Image extends File
{
    const TYPE_ORIGINAL = 'original';
    const TYPE_THUBMNAIL = 'thumbnail';
    const TYPE_MICRO = 'micro';
}
