<?php

namespace App\Repositories;

use App\Contracts\Repositories\OrderDetailRepository;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ELoquentOrderDetailRepository extends EloquentRepository implements OrderDetailRepository
{
    public function __construct(OrderDetail $model)
    {
        return parent::__construct($model);
    }

    public function getOrderApproveOfMonth()
    {
        $orderDetails = $this->model->distinct('product_id', 'color_id', 'memory_id')
            ->get(['product_id', 'color_id', 'memory_id', 'price']);

        return $this->model->select(
            'product_id',
            'color_id',
            'memory_id',
            'price',
            DB::raw('SUM(quantity) as total_qty')
        )
            ->with(['product', 'color', 'memory'])
            ->whereHas(
                'order',
                function ($query) {
                    $query->whereStatus(config('const.approve'))
                        ->whereYear('created_at', Carbon::now()->year)
                        ->whereMonth('created_at', Carbon::now()->month);
                }
            )
        ->whereIn('product_id', $orderDetails)
        ->groupBy(['product_id', 'color_id', 'memory_id', 'price'])
        ->get();
    }

    public function showDetailsOrders($id)
    {
        return $this->model->with(['order', 'product', 'color', 'memory'])
            ->where('order_id', $id)
            ->get();
    }
}
