<?php

namespace App\Contracts\Repositories;

interface OrderDetailRepository extends Repository
{
    public function getOrderApproveOfMonth();

    public function showDetailsOrders($id);
}
