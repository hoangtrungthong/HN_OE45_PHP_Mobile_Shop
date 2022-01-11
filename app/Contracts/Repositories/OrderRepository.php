<?php

namespace App\Contracts\Repositories;

interface OrderRepository extends Repository
{
    public function getOrderApproveOfMonth();
}
