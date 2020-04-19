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
        $params = [
            'id'    => $data['id'],
            'type'  => $data['type'],
            'price' => $data['price'],
        ];

        if (isset($data['base'])) {
            $params['base'] = $data['base'];
        }

        if (isset($data['step'])) {
            $params['step'] = $data['step'];
        }

        return new static($params);
    }
}
