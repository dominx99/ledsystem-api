<?php declare(strict_types=1);

namespace App\Domain\Products\Models;

use App\Database\Eloquent\Model;

final class ProductUnit extends Model
{
    const PIECE_TYPE = 'piece';
    const METERS_TYPE = 'meters';

    protected $fillable = [
        'id',
        'type',
        'price',
        'base',
        'step',
    ];

    public static function new(array $data): self
    {
        return new static([
            'id'    => $data['id'],
            'type'  => $data['type'],
            'price' => $data['price'],
            'base'  => $data['base'],
            'step'  => $data['step'],
        ]);
    }
}
