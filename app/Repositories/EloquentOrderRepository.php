<?php

namespace App\Repositories;

use App\Contracts\Repositories\OrderRepository;
use App\Models\Order;

class ELoquentOrderRepository extends EloquentRepository implements OrderRepository
{
    public function __construct(Order $model)
    {
        return parent::__construct($model);
    }
}
