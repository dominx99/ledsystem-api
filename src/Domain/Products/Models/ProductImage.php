<?php declare(strict_types=1);

namespace App\Domain\Products\Models;

use App\Database\Eloquent\Model;

final class ProductImage extends Model
{
    protected $fillable = [
        'path',
        'product_id',
    ];
}
