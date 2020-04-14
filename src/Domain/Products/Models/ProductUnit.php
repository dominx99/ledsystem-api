<?php declare(strict_types=1);

namespace App\Domain\Products\Models;

use App\Database\Eloquent\Model;

final class ProductUnit extends Model
{
    const PIECE_TYPE = 'piece';
    const METERS_TYPE = 'meters';

    protected $fillable = [
        'type',
        'price',
        'base',
        'step',
    ];
}
