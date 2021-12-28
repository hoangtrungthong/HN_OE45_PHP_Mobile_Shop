<?php

namespace Tests\Unit\Models;

use App\Models\Color;
use App\Models\Memory;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Tests\ModelTestCase;

class OrderDetailTest extends ModelTestCase
{
    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            new OrderDetail(),
            [
                'fillable' => [
                    'product_id',
                    'order_id',
                    'color_id',
                    'memory_id',
                    'image',
                    'price',
                    'quantity',
                ],
            ]
        );
    }

    public function testOrderRelations()
    {
        $order_details = new OrderDetail();

        $this->assertBelongsToRelation(
            $order_details->order(),
            $order_details,
            new Order(),
            'order_id'
        );
    }

    public function testProductRelations()
    {
        $order_details = new OrderDetail();

        $this->assertBelongsToRelation(
            $order_details->product(),
            $order_details,
            new Product(),
            'product_id'
        );
    }

    public function testColorRelations()
    {
        $order_details = new OrderDetail();

        $this->assertBelongsToRelation(
            $order_details->color(),
            $order_details,
            new Color(),
            'color_id'
        );
    }

    public function testMemoryRelations()
    {
        $order_details = new OrderDetail();

        $this->assertBelongsToRelation(
            $order_details->memory(),
            $order_details,
            new Memory(),
            'memory_id'
        );
    }
}
