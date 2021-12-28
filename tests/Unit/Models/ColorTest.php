<?php

namespace Tests\Unit\Models;

use App\Models\Color;
use App\Models\OrderDetail;
use App\Models\ProductAttribute;
use Tests\ModelTestCase;

class ColorTest extends ModelTestCase
{
    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            new Color(),
            [
                'fillable' => [
                    'name',
                ],
            ]
        );
    }

    public function testProductAttributeRelations()
    {
        $color = new Color();

        $this->assertBelongsToRelation(
            $color->productAttribute(),
            $color,
            new ProductAttribute(),
            'product_attribute_id'
        );
    }


    public function testOrderDetailsRelations()
    {
        $color = new Color();

        $this->assertHasManyRelation($color->orderDetails(), $color, new OrderDetail());
    }
}
