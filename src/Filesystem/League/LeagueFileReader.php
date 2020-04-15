<?php declare(strict_types=1);

namespace App\Filesystem\League;

use App\Domain\Files\FileReader;
use Illuminate\Contracts\Filesystem\Filesystem;

final class LeagueFileReader implements FileReader
{
    private Filesystem $storage;

    public function __construct(Filesystem $storage)
    {
        $this->storage = $storage;
    }

    public function filesFromDirectory(string $path): array
    {
        return $this->storage->files($path);
    }
}
