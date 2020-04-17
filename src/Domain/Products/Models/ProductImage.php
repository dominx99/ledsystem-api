<?php declare(strict_types=1);

namespace App\Domain\Products\Models;

use App\Database\Eloquent\Model;
use App\Domain\Files\ValueObjects\Image;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class ProductImage extends Model
{
    protected $fillable = [
        'product_id',
    ];

    public function files(): HasMany
    {
        return $this->hasMany(ProductImageFile::class);
    }

    public function original()
    {
        return $this->hasOne(ProductImageFile::class)->where('type', Image::TYPE_ORIGINAL);
    }

    public function thumbnail()
    {
        return $this->hasOne(ProductImageFile::class)->where('type', Image::TYPE_THUBMNAIL);
    }

    public function micro()
    {
        return $this->hasOne(ProductImageFile::class)->where('type', Image::TYPE_MICRO);
    }
}
