<?php declare(strict_types=1);

namespace App\Domain\Products\ValueObjects;

use App\Domain\Files\ValueObjects\Image;
use App\Domain\Shared\Exceptions\SystemException;

final class ProductImage extends Image
{
    const BASE_PATH = 'products';

    private string $productId;

    public function setProductId(string $productId): void
    {
        $this->productId = $productId;
    }

    protected function path(): string
    {
        if (! isset($this->productId)) {
            throw new SystemException("Product id is not set");
        }

        return parent::path() . DIRECTORY_SEPARATOR . self::BASE_PATH . DIRECTORY_SEPARATOR . $this->productId;
    }
}
