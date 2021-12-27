<?php

namespace App\Repositories;

use App\Contracts\Repositories\ColorRepository;
use App\Models\Color;

class ELoquentColorRepository extends EloquentRepository implements ColorRepository
{
    public function __construct(Color $model)
    {
        return parent::__construct($model);
    }
}
