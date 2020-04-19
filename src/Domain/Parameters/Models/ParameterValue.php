<?php declare(strict_types=1);

namespace App\Domain\Parameters\Models;

use App\Database\Eloquent\Model;

final class ParameterValue extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'id', 'parameter_name_id', 'name',
    ];
}
