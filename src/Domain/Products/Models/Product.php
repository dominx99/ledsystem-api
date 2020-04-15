<?php declare(strict_types=1);

namespace App\Domain\Products\Models;

use App\Database\Eloquent\Model;
use App\Domain\Categories\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Uuid;
use App\Domain\Products\Events\ProductCreated;

final class Product extends Model
{
    const STATUS_NEW = 'new';
    const STATUS_READY = 'ready';

    protected $fillable = [
        'id',
        'name',
        'status',
        'product_unit_id',
        'product_image_id',
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(ProductUnit::class, 'product_unit_id', 'id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public static function new(array $data): self
    {
        $productUnitId = (string) Uuid::uuid4();

        $product = new static([
            'id'              => $data['id'],
            'name'            => $data['name'],
            'product_unit_id' => $productUnitId,
            'status'          => self::STATUS_NEW,
        ]);

        $product->events->add(new ProductCreated(array_merge($data, [
            'product_unit_id' => $productUnitId,
        ])));

        return $product;
    }
}
