<?php

namespace App\Contracts\Repositories;

interface ProductRepository extends Repository
{
    public function getAllProduct();

    public function getDetailProduct($slug);

    public function deleteProduct($id);
}
