<?php

namespace App\Domain\Products\Jobs;

use App\Domain\Products\Repositories\ProductImageRepository;
use App\Domain\Products\Repositories\ProductRepository;
use App\Domain\Shared\Exceptions\BusinessException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Domain\Products\Broadcasting\ProductImageUpdated;

class SetProductMainImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $productId;
    private string $imageId;

    public function __construct(string $productId, string $imageId)
    {
        $this->productId = $productId;
        $this->imageId = $imageId;
    }

    public function handle(ProductRepository $products, ProductImageRepository $productImages): void
    {
        if (! $productImages->existS($this->imageId)) {
            throw new BusinessException("Image does not exist.");
        }

        if (! $products->hasImage($this->productId, $this->imageId)) {
            throw new BusinessException("This image is not attached to the product.");
        }

        $products->updateMainImage($this->productId, $this->imageId);

        broadcast(new ProductImageUpdated($this->productId));
    }
}
