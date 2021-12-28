<?php

namespace Tests\Unit\Models;

use App\Models\Memory;
use App\Models\OrderDetail;
use App\Models\ProductAttribute;
use Tests\ModelTestCase;

class MemoryTest extends ModelTestCase
{
    protected $memory;

    public function setUp(): void
    {
        parent::setUp();
        $this->memory = new Memory();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->memory);
    }
    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            $this->memory,
            [
                'fillable' => [
                    'rom',
                ],
            ]
        );
    }

    public function testProductAttributeRelations()
    {
        $this->assertBelongsToRelation(
            $this->memory->productAttribute(),
            $this->memory,
            new ProductAttribute(),
            'product_attribute_id'
        );
    }

    public function testOrderDetailsRelations()
    {
        $this->assertHasManyRelation($this->memory->orderDetails(), $this->memory, new OrderDetail());
    }
}
