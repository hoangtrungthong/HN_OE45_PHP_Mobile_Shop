<?php

namespace App\Repositories;

use App\Contracts\Repositories\OrderDetailRepository;
use App\Models\OrderDetail;

class ELoquentOrderDetailRepository extends EloquentRepository implements OrderDetailRepository
{
    public function __construct(OrderDetail $model)
    {
        return parent::__construct($model);
    }
}
