<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\Product;
use Tests\ModelTestCase;

class CategoryTest extends ModelTestCase
{
    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            new Category(),
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
        $category = new Category();

        $this->assertHasManyRelation($category->products(), $category, new Product());
    }

    public function testParentCategoryRelations()
    {
        $category = new Category();

        $this->assertBelongsToRelation($category->parentCategory(), $category, $category, 'parent_category_id');
    }

    public function testChildrenCategoryRelations()
    {
        $category = new Category();

        $this->assertHasManyRelation($category->childrenCategory(), $category, $category, 'parent');
    }
}
