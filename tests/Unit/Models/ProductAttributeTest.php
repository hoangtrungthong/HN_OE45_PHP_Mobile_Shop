<?php

namespace Tests\Unit\Models;

use App\Models\Color;
use App\Models\Memory;
use App\Models\Product;
use App\Models\ProductAttribute;
use Tests\ModelTestCase;

class ProductAttributeTest extends ModelTestCase
{
    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            new ProductAttribute(),
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
        $product_attribute = new ProductAttribute();

        $this->assertBelongsToRelation(
            $product_attribute->product(),
            $product_attribute,
            new Product(),
            'product_id'
        );
    }

    public function testColorsRelation()
    {
        $product_attribute = new ProductAttribute();

        $this->assertHasManyRelation(
            $product_attribute->colors(),
            $product_attribute,
            new Color(),
            'id',
            'color_id'
        );
    }

    public function testMemoriesRelation()
    {
        $product_attribute = new ProductAttribute();

        $this->assertHasManyRelation(
            $product_attribute->memories(),
            $product_attribute,
            new Memory(),
            'id',
            'memory_id'
        );
    }
}
