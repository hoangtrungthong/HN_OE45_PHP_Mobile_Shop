<?php

namespace App\Repositories;

use App\Contracts\Repositories\OrderRepository;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ELoquentOrderRepository extends EloquentRepository implements OrderRepository
{
    public function __construct(Order $model)
    {
        return parent::__construct($model);
    }

    public function getOrderApproveOfMonth()
    {
        return $this->model->with(
            [
                'orderDetails' => function ($q) {
                    $q->with('product', 'color', 'memory');
                }
            ]
        )
            ->whereStatus(config('const.approve'))
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->get();
    }
}
