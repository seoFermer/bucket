<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductServices;
use App\Services\OrderServices;

class ProductController extends Controller
{
    private ProductServices $productService;
    private OrderServices $orderServices;

    public function __construct(ProductServices $productService, OrderServices $orderServices)
    {
        $this->productService = $productService;
        $this->orderServices = $orderServices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = $this->productService->getProducts();
        $order = $this->orderServices->getOrder();

        return view('index', compact('products', 'order'));
    }
}
