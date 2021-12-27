<?php

namespace App\Repositories;

use App\Contracts\Repositories\ProductRepository;
use App\Models\Product;

class EloquentProductRepository extends EloquentRepository implements ProductRepository
{
    public function __construct(Product $model)
    {
        return parent::__construct($model);
    }

    public function getAllProduct()
    {
        return $this->model->with(['productAttributes', 'productImages', 'category'])
            ->orderBy('id', 'desc')
            ->paginate(config('const.pagination'));
    }

    public function getDetailProduct($slug)
    {
        $result = $this->model->where('slug', $slug);

        return $result->with([
                'productAttributes' => function ($query) {
                    $query->with('colors', 'memories');
                },
                'productImages',
            ])
            ->firstOrFail();
    }

    public function deleteProduct($id)
    {
        $result = $this->model->findOrFail($id);
        $result->productAttributes()->delete();
        $result->productImages()->delete();

        return $result->delete();
    }
}
