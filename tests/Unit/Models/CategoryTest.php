<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\Product;
use Tests\ModelTestCase;

class CategoryTest extends ModelTestCase
{
    protected $category;

    public function setUp(): void
    {
        parent::setUp();
        $this->category = new Category();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->category);
    }

    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            $this->category,
            [
                'fillable' => [
                    'name',
                    'slug',
                    'parent',
                ],
            ]
        );
    }

    public function testProductsRelations()
    {
        $this->assertHasManyRelation($this->category->products(), $this->category, new Product());
    }

    public function testParentCategoryRelations()
    {
        $this->assertBelongsToRelation(
            $this->category->parentCategory(),
            $this->category,
            $this->category,
            'parent_category_id'
        );
    }

    public function testChildrenCategoryRelations()
    {
        $this->assertHasManyRelation($this->category->childrenCategory(), $this->category, $this->category, 'parent');
    }
}
