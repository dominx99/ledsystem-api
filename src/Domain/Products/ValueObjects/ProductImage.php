<?php declare(strict_types=1);

namespace App\Domain\Products\ValueObjects;

use App\Domain\Files\ValueObjects\Image;
use App\Domain\Shared\Exceptions\SystemException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as InterventionImageFacade;
use Intervention\Image\Image as InterventionImage;

final class ProductImage extends Image
{
    private string $basePath;
    private string $productId;
    private string $prefix;
    private InterventionImage $image;

    public static function fromUploadedFile(UploadedFile $uploadedFile): self
    {
        $file = parent::fromUploadedFile($uploadedFile);

        $file->image = InterventionImageFacade::make($uploadedFile);

        return $file;
    }

    public function content(): string
    {
        return (string) $this->image->stream();
    }

    public function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }

    public function setProductId(string $productId): void
    {
        $this->productId = $productId;
    }

    public function setBasePath(string $basePath): void
    {
        $this->basePath = $basePath;
    }

    public function filename(): string
    {
        return $this->prefix . '_' . parent::filename();
    }

    public function resize(array $size): void
    {
        $this->image->resize(
            $size['width'] ?? null,
            $size['height'] ?? null,
            fn ($constraint) => $constraint->aspectRatio(),
        );
    }

    protected function path(): string
    {
        if (! isset($this->productId, $this->basePath)) {
            throw new SystemException("Product id or base path is not set");
        }

        return parent::path() . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . $this->productId . DIRECTORY_SEPARATOR . $this->basePath;
    }
}
