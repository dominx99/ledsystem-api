<?php

namespace App\Database\Eloquent;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Collection;

class Model extends BaseModel
{
    public $incrementing = false;

    protected $keyType = "string";

    protected $guarded = [];

    protected Collection $events;

    public function __construct(array $attributes = [])
    {
        $this->events = new Collection();

        parent::__construct($attributes);
    }

    public function events(): Collection
    {
        return $this->events;
    }
}
