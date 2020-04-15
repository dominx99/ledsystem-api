<?php

namespace App\Domain\Products\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Domain\Files\FileUploader;
use App\Domain\Products\ValueObjects\ProductImage;
use App\Domain\Products\Events\ProductImagesSaved;

class SaveProductImages
{
    use Dispatchable, SerializesModels;

    private string $productId;
    private array $images;

    /**
     * @return void
     */
    public function __construct(string $productId, array $images)
    {
        $this->productId = $productId;
        $this->images = $images;
    }

    /**
     * @return void
     */
    public function handle(FileUploader $fileUploader)
    {
        foreach ($this->images as $file) {
            $image = ProductImage::fromUploadedFile($file);
            $image->setProductId($this->productId);

            $fileUploader->upload($image);
        }

        event(new ProductImagesSaved($this->productId));
    }
}
