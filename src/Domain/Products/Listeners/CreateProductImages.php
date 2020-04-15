<?php declare(strict_types = 1);

namespace App\Domain\Products\Listeners;

use App\Domain\Products\Events\ProductImagesSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Domain\Files\FileReader;
use App\Domain\Products\Repositories\ProductImageRepository;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class CreateProductImages implements ShouldQueue
{
    use InteractsWithQueue;

    private FileReader $fileReader;
    private ProductImageRepository $productImages;

    public function __construct(FileReader $fileReader, ProductImageRepository $productImages)
    {
        $this->fileReader = $fileReader;
        $this->productImages = $productImages;
    }

    public function handle(ProductImagesSaved $event): void
    {
        $paths = $this->fileReader->filesFromDirectory(
            'products' . DIRECTORY_SEPARATOR . $event->productId(),
        );

        $images = array_map(fn ($path) => [
            'id'         => (string) Uuid::uuid4(),
            'path'       => $path,
            'product_id' => $event->productId(),
            'created_at' => Carbon::now(),
        ], $paths);

        $this->productImages->insert($images);
    }
}
