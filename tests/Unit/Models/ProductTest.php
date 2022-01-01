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
    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            new Product(),
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
        $product = new Product();

        $this->assertBelongsToRelation($product->category(), $product, new Category(), 'category_id');
    }

    public function testProductAttributesRelation()
    {
        $product = new Product();

        $this->assertHasManyRelation($product->productAttributes(), $product, new ProductAttribute());
    }

    public function testProductImagesRelation()
    {
        $product = new Product();

        $this->assertHasManyRelation($product->productImages(), $product, new ProductImage());
    }

    public function testRatingsRelation()
    {
        $product = new Product();

        $this->assertHasManyRelation($product->ratings(), $product, new Rating());
    }

    public function testCommentsRelation()
    {
        $product = new Product();

        $this->assertHasManyRelation($product->comments(), $product, new Comment());
    }

    public function testOrderDetailsRelations()
    {
        $product = new Product();

        $this->assertHasManyRelation($product->orderDetails(), $product, new OrderDetail());
    }
}
