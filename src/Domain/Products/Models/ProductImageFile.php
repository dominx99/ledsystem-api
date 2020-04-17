<?php declare(strict_types=1);

namespace App\Domain\Products\Models;

use App\Database\Eloquent\Model;

final class ProductImageFile extends Model
{
    protected $fillable = [
        'product_image_id',
        'path',
        'type',
    ];
}
