<?php

namespace app\Repositories;

use App\Contracts\Repositories\ProductImageRepository;
use App\Models\ProductImage;

class ELoquentProductImageRepository extends EloquentRepository implements ProductImageRepository
{
    public function __construct(ProductImage $model)
    {
        return parent::__construct($model);
    }
}
