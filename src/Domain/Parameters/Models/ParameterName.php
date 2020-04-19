<?php declare(strict_types=1);

namespace App\Domain\Parameters\Models;

use App\Database\Eloquent\Model;

final class ParameterName extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'id', 'name',
    ];

    public function defaultValues()
    {
        return $this->hasMany(ParameterValue::class);
    }

    public function values()
    {
        return $this->belongsToMany(ParameterValue::class);
    }
}
