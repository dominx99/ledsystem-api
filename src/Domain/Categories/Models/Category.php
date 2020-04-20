<?php declare(strict_types=1);

namespace App\Domain\Categories\Models;

use App\Database\Eloquent\Model;
use App\Domain\Parameters\Models\ParameterName;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Domain\Products\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Category extends Model
{
    protected $fillable = [
        'name',
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
}
