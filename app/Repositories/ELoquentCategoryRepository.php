<?php

namespace app\Repositories;

use App\Contracts\Repositories\CategoryRepository;
use App\Models\Category;

class ELoquentCategoryRepository extends EloquentRepository implements CategoryRepository
{
    public function __construct(Category $model)
    {
        return parent::__construct($model);
    }
}
