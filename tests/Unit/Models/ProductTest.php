<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\Comment;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\Rating;
use Tests\ModelTestCase;

class ProductTest extends ModelTestCase
{
    protected $product;

    public function setUp(): void
    {
        parent::setUp();
        $this->product = new Product();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->product);
    }

    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            $this->product,
            [
                'fillable' => [
                    'category_id',
                    'name',
                    'slug',
                    'content',
                    'specifications',
                ],
            ]
        );
    }

    public function testCategoryRelations()
    {
        $this->assertBelongsToRelation($this->product->category(), $this->product, new Category(), 'category_id');
    }

    public function testProductAttributesRelation()
    {
        $this->assertHasManyRelation($this->product->productAttributes(), $this->product, new ProductAttribute());
    }

    public function testProductImagesRelation()
    {
        $this->assertHasManyRelation($this->product->productImages(), $this->product, new ProductImage());
    }

    public function testRatingsRelation()
    {
        $this->assertHasManyRelation($this->product->ratings(), $this->product, new Rating());
    }

    public function testCommentsRelation()
    {
        $this->assertHasManyRelation($this->product->comments(), $this->product, new Comment());
    }

    public function testOrderDetailsRelations()
    {
        $this->assertHasManyRelation($this->product->orderDetails(), $this->product, new OrderDetail());
    }
}
