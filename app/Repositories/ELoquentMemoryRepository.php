<?php

namespace App\Repositories;

use App\Contracts\Repositories\MemoryRepository;
use App\Models\Memory;

class ELoquentMemoryRepository extends EloquentRepository implements MemoryRepository
{
    public function __construct(Memory $model)
    {
        return parent::__construct($model);
    }
}
