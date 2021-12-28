<?php

namespace Tests\Unit\Models;

use App\Models\Color;
use App\Models\OrderDetail;
use App\Models\ProductAttribute;
use Tests\ModelTestCase;

class ColorTest extends ModelTestCase
{
    protected $color;

    public function setUp(): void
    {
        parent::setUp();
        $this->color = new Color();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->color);
    }

    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            $this->color,
            [
                'fillable' => [
                    'name',
                ],
            ]
        );
    }

    public function testProductAttributeRelations()
    {
        $this->assertBelongsToRelation(
            $this->color->productAttribute(),
            $this->color,
            new ProductAttribute(),
            'product_attribute_id'
        );
    }


    public function testOrderDetailsRelations()
    {
        $this->assertHasManyRelation($this->color->orderDetails(), $this->color, new OrderDetail());
    }
}
