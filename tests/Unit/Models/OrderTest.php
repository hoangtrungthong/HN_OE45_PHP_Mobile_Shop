<?php

namespace Tests\Unit\Models;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Tests\ModelTestCase;

class OrderTest extends ModelTestCase
{
    protected $order;

    public function setUp(): void
    {
        parent::setUp();
        $this->order = new Order();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->order);
    }

    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            $this->order,
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
        $this->assertHasManyRelation($this->order->orderDetails(), $this->order, new OrderDetail());
    }

    public function testUserRelations()
    {
        $this->assertBelongsToRelation($this->order->user(), $this->order, new User(), 'user_id');
    }
}
