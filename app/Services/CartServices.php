<?php

namespace App\Services;


use App\Models\Cart;
use App\Services\DeliveryServices;
use App\Services\DiscountServices;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\Product;



class CartServices
{
    private DeliveryServices $deliveryServices;
    private DiscountServices $discountServices;

    public function __construct(Cart $cart, DeliveryServices $deliveryServices, DiscountServices $discountServices)
    {
        $this->model = $cart;
        $this->deliveryServices = $deliveryServices;
        $this->discountServices = $discountServices;
    }

    public function store($data, $order)
    {
        DB::beginTransaction();
        try {
            $product = Product::where('code', $data['code'])->first();

            $total = $data['quantity'] * $product->price;

            $cartAdded = $this->model
                ->where('product_id', $product->id)
                ->where('order_id',$order->id)
                ->first();

            if (empty($cartAdded)) {
                $this->model::create(
                    [
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $data['quantity'],
                        'price' => $product->price,
                        'total' => $total,
                ]);
            } else {
                $quantity = $cartAdded->quantity + $data['quantity'];
                $total = $quantity * $product->price;

                $cartAdded->update([
                    'quantity' => $quantity,
                    'total' => $total,
                ]);
            }

            foreach ($order->cart AS $cart) {
                $discount = $this->discountServices->getDiscountByProduct($cart);
                $cart->update([
                    'discount' => $discount
                ]);
            }

        } catch (Exception $e) {
            DB::rollBack();
        }

        DB::commit();

        return true;
    }


}
