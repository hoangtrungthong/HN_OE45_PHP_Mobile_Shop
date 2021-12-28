<?php

namespace Tests\Unit\Models;

use App\Models\Product;
use App\Models\ProductImage;
use Tests\ModelTestCase;

class ProductImageTest extends ModelTestCase
{
    protected $product_images;

    public function setUp(): void
    {
        parent::setUp();
        $this->product_images = new ProductImage();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->product_images);
    }
    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            new ProductImage(),
            [
                'fillable' => [
                    'product_id',
                    'path',
                ],
            ]
        );
    }

    public function testProductRelations()
    {
        $product_images = new ProductImage();

        $this->assertBelongsToRelation(
            $product_images->product(),
            $product_images,
            new Product(),
            'product_id'
        );
    }
}
