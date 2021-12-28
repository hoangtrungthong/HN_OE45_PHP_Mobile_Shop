<?php

namespace Tests\Unit\Models;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Tests\ModelTestCase;

class OrderTest extends ModelTestCase
{
    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            new Order(),
            [
                'fillable' => [
                    'user_id',
                    'amount',
                    'phone',
                    'address',
                    'status',
                ],
            ]
        );
    }

    public function testOrderDetailsRelations()
    {
        $order = new Order();

        $this->assertHasManyRelation($order->orderDetails(), $order, new OrderDetail());
    }

    public function testUserRelations()
    {
        $order = new Order();

        $this->assertBelongsToRelation($order->user(), $order, new User(), 'user_id');
    }
}
