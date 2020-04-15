<?php declare(strict_types=1);

namespace App\Filesystem\League;

use App\Domain\Files\Contracts\Uploadable;
use App\Domain\Files\FileUploader;
use Illuminate\Contracts\Filesystem\Filesystem;

final class LeagueFileUploader implements FileUploader
{
    private Filesystem $storage;

    public function __construct(Filesystem $storage)
    {
        $this->storage = $storage;
    }

    public function upload(Uploadable $file): void
    {
        $this->storage->put($file->fullPath(), $file->content());
    }
}
