<?php

namespace App\Domain\Products\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Domain\Files\FileUploader;
use App\Domain\Products\ValueObjects\ProductImage;
use App\Domain\Products\Events\ProductImagesSaved;
use Illuminate\Support\Str;
use App\Domain\Files\ValueObjects\Image;

class SaveProductImages
{
    use Dispatchable, SerializesModels;

    const VARIANTS = [
        [
            'type' => Image::TYPE_ORIGINAL,
        ],
        [
            'type' => Image::TYPE_THUBMNAIL,
            'size' => [
                'width'  => 500,
            ],
        ],
        [
            'type' => Image::TYPE_MICRO,
            'size' => [
                'width'  => 100,
            ],
        ],
    ];

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
            $basePath = uniqid((string) mt_rand(), true);

            foreach (self::VARIANTS as $variant) {
                $image = ProductImage::fromUploadedFile($file);

                $image->setBasePath($basePath);
                $image->setPrefix($variant['type']);
                $image->setProductId($this->productId);

                if (isset($variant['size'])) {
                    $image->resize($variant['size']);
                }

                $fileUploader->upload($image);
            }
        }

        event(new ProductImagesSaved($this->productId));
    }
}
