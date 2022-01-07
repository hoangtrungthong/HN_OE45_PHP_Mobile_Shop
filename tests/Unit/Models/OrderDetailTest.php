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
    protected $order_details;

    public function setUp(): void
    {
        parent::setUp();
        $this->order_details = new OrderDetail();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->order_details);
    }
    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            $this->order_details,
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
        $this->assertBelongsToRelation(
            $this->order_details->order(),
            $this->order_details,
            new Order(),
            'order_id'
        );
    }

    public function testProductRelations()
    {
        $this->assertBelongsToRelation(
            $this->order_details->product(),
            $this->order_details,
            new Product(),
            'product_id'
        );
    }

    public function testColorRelations()
    {
        $this->assertBelongsToRelation(
            $this->order_details->color(),
            $this->order_details,
            new Color(),
            'color_id'
        );
    }

    public function testMemoryRelations()
    {
        $this->assertBelongsToRelation(
            $this->order_details->memory(),
            $this->order_details,
            new Memory(),
            'memory_id'
        );
    }
}
