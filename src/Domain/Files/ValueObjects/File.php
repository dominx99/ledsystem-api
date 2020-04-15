<?php declare(strict_types=1);

namespace App\Domain\Files\ValueObjects;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use App\Domain\Shared\Exceptions\SystemException;
use App\Domain\Files\Contracts\Uploadable;

class File implements Uploadable
{
    protected string $extension;
    protected string $filename;
    protected string $content;

    private function __construct()
    {
    }

    public static function fromUploadedFile(UploadedFile $uploadedFile)
    {
        $file = new static();

        $file->extension = $uploadedFile->getClientOriginalExtension();

        if (($file->content = $uploadedFile->get()) === false) {
            throw new SystemException("Could not get file content");
        }

        $file->filename = Carbon::now()->getTimestamp() . '.' . $file->extension;

        return $file;
    }

    public function fullPath(): string
    {
        if ($this->path() === '') {
            return $this->filename();
        }

        return $this->path() . DIRECTORY_SEPARATOR . $this->filename();
    }

    public function content(): string
    {
        return $this->content;
    }

    protected function path(): string
    {
        return '';
    }

    protected function filename(): string
    {
        return $this->filename;
    }
}
