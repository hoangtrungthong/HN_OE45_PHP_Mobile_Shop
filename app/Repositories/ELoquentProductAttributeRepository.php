<?php

namespace App\Repositories;

use App\Contracts\Repositories\ProductAttributeRepository;
use App\Models\ProductAttribute;

class ELoquentProductAttributeRepository extends EloquentRepository implements ProductAttributeRepository
{
    public function __construct(ProductAttribute $model)
    {
        return parent::__construct($model);
    }
}
