<?php declare(strict_types=1);

namespace App\Domain\Categories\Models;

use App\Database\Eloquent\Model;
use App\Domain\Parameters\Models\ParameterName;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Domain\Products\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Uuid;
use App\Domain\Categories\Broadcasting\CategoryCreated;

final class Category extends Model
{
    protected $fillable = [
        'id',
        'name',
        'slug',
        'parent_id',
    ];

    public function children()
    {
        return $this->oneNestedChildren()->with('children');
    }

    public function oneNestedChildren(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function parameters(): BelongsToMany
    {
        return $this->belongsToMany(ParameterName::class);
    }

    public static function new(array $data): self
    {
        $categoryId = (string) Uuid::uuid4();

        $category = new static([
            'id'              => $categoryId,
            'name'            => $data['name'],
            'slug'            => $data['slug'],
            'parent_id'       => $data['parent_id'],
        ]);

        $category->events->add(new CategoryCreated($categoryId));

        return $category;
    }
}
