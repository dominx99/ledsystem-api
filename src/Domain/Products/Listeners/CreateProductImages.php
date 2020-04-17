<?php declare(strict_types = 1);

namespace App\Domain\Products\Listeners;

use App\Domain\Products\Events\ProductImagesSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Domain\Files\FileReader;
use App\Domain\Files\ValueObjects\Image;
use App\Domain\Products\Repositories\ProductImageFileRepository;
use App\Domain\Products\Repositories\ProductImageRepository;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class CreateProductImages implements ShouldQueue
{
    use InteractsWithQueue;

    private FileReader $fileReader;
    private ProductImageRepository $productImages;
    private ProductImageFileRepository $productImageFiles;

    public function __construct(
        FileReader $fileReader,
        ProductImageRepository $productImages,
        ProductImageFileRepository $productImageFiles
    ) {
        $this->fileReader = $fileReader;
        $this->productImages = $productImages;
        $this->productImageFiles = $productImageFiles;
    }

    public function handle(ProductImagesSaved $event): void
    {
        $basePath = 'products' . DIRECTORY_SEPARATOR . $event->productId();

        $directories = $this->fileReader->directories($basePath);

        $productImages = [];
        $productImageFilesToSave = [];

        foreach ($directories as $directory) {
            $files = $this->fileReader->filesFromDirectory($directory);
            $productImageId = (string) Uuid::uuid4();

            $productImages[] = [
                'id'         => $productImageId,
                'product_id' => $event->productId(),
            ];

            $productImageFiles = array_map(fn ($path) => [
                'id'               => (string) Uuid::uuid4(),
                'product_image_id' => $productImageId,
                'path'             => $path,
                'type'             => $this->detectImageType($path),
                'created_at'       => Carbon::now(),
            ], $files);

            $productImageFilesToSave = array_merge($productImageFilesToSave, $productImageFiles);
        }

        $this->productImages->insert($productImages);
        $this->productImageFiles->insert($productImageFilesToSave);
    }

    private function detectImageType(string $path)
    {
        if (strpos($path, Image::TYPE_ORIGINAL)) {
            return Image::TYPE_ORIGINAL;
        }

        if (strpos($path, Image::TYPE_THUBMNAIL)) {
            return Image::TYPE_THUBMNAIL;
        }

        if (strpos($path, Image::TYPE_MICRO)) {
            return Image::TYPE_MICRO;
        }

        return Image::TYPE_ORIGINAL;
    }
}
