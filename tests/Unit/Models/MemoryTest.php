<?php

namespace Tests\Unit\Models;

use App\Models\Memory;
use App\Models\OrderDetail;
use App\Models\ProductAttribute;
use Tests\ModelTestCase;

class MemoryTest extends ModelTestCase
{
    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            new Memory(),
            [
                'fillable' => [
                    'rom',
                ],
            ]
        );
    }

    public function testProductAttributeRelations()
    {
        $memory = new Memory();

        $this->assertBelongsToRelation(
            $memory->productAttribute(),
            $memory,
            new ProductAttribute(),
            'product_attribute_id'
        );
    }

    public function testOrderDetailsRelations()
    {
        $memory = new Memory();

        $this->assertHasManyRelation($memory->orderDetails(), $memory, new OrderDetail());
    }
}
