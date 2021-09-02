<?php

namespace App\Services;


use App\Models\Cart;
use App\Services\DeliveryServices;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\Product;



class CartServices
{
    private DeliveryServices $deliveryServices;

    public function __construct(Cart $cart, DeliveryServices $deliveryServices)
    {
        $this->model = $cart;
        $this->deliveryServices = $deliveryServices;
    }

    public function store($data, $order)
    {
        DB::beginTransaction();
        try {
            $product = Product::where('code', $data['code'])->first();

            $total = $data['quantity'] * $product->price;
            $discount = 0;

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
                        'discount' => $discount,
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

            $deliveryCosts = $this->deliveryServices->getDeliveryCosts($order);

            $order->update([
                'delivery_costs' => $deliveryCosts,
            ]);


        } catch (Exception $e) {
            DB::rollBack();
        }

        DB::commit();

        return true;
    }


    public function getTotalCosts()
    {
        $total = 0;

        return $total;
    }

    public function getDeliveryCosts()
    {
        $costs = 0;

        return $costs;
    }

}
