<?php declare(strict_types=1);

namespace App\Domain\Products\Models;

use App\Database\Eloquent\Model;
use App\Domain\Parameters\Models\ParameterName;
use App\Domain\Parameters\Models\ParameterValue;

final class ProductParameter extends Model
{
    public function name()
    {
        return $this->belongsTo(ParameterName::class, 'parameter_name_id', 'id');
    }

    public function values()
    {
        return $this->belongsToMany(ParameterValue::class);
    }
}
