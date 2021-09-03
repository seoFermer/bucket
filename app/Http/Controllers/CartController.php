<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Services\DeliveryServices;
use Illuminate\Http\Request;
use App\Http\Requests\CartRequest;
use App\Services\CartServices;
use App\Services\OrderServices;

class CartController extends Controller
{
    private CartServices $cartService;
    private OrderServices $orderServices;
    private DeliveryServices $deliveryServices;


    public function __construct(CartServices $cartService, OrderServices $orderServices, DeliveryServices $deliveryServices)
    {
        $this->cartService = $cartService;
        $this->orderServices = $orderServices;
        $this->deliveryServices = $deliveryServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = $this->orderServices->getOrder();

        return view('cart.index', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CartRequest $request)
    {
        $validatedData = $request->validated();

        $order = $this->orderServices->getOrder();
        $this->cartService->store($validatedData, $order);
        $this->deliveryServices->getDeliveryCosts($order);

        return redirect()->back();
    }


}
