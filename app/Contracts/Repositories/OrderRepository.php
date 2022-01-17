<?php

namespace App\Contracts\Repositories;

interface OrderRepository extends Repository
{
    public function getAllOrders();

    public function getAllOrderPending();

    public function getOrderUserApprove();
}
