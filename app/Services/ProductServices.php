<?php

namespace App\Services;

use App\Models\Product;


class ProductServices
{
    public function getProducts()
    {
        $products = Product::all();

        return $products;
    }

}
