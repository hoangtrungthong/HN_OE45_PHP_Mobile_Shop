<?php

namespace Tests\Unit\Models;

use App\Models\Color;
use App\Models\Memory;
use App\Models\Product;
use App\Models\ProductAttribute;
use Tests\ModelTestCase;

class ProductAttributeTest extends ModelTestCase
{
    protected $product_attribute;

    public function setUp(): void
    {
        parent::setUp();
        $this->product_attribute = new ProductAttribute();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->product_attribute);
    }
    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            $this->product_attribute,
            [
                'fillable' => [
                    'product_id',
                    'color_id',
                    'memory_id',
                    'price',
                    'quantity',
                ],
            ]
        );
    }

    public function testProductRelations()
    {
        $this->assertBelongsToRelation(
            $this->product_attribute->product(),
            $this->product_attribute,
            new Product(),
            'product_id'
        );
    }

    public function testColorsRelation()
    {
        $this->assertHasManyRelation(
            $this->product_attribute->colors(),
            $this->product_attribute,
            new Color(),
            'id',
            'color_id'
        );
    }

    public function testMemoriesRelation()
    {
        $this->assertHasManyRelation(
            $this->product_attribute->memories(),
            $this->product_attribute,
            new Memory(),
            'id',
            'memory_id'
        );
    }
}
