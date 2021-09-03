<?php

namespace App\Services;


class DiscountServices
{

    public function __construct()
    {

    }

    public function getDiscountByProduct($cart)
    {
        $discount = 0;
        if ($cart->product->code == 'R01') {
            $quantityProduct = $cart->quantity;
            $isQuantityEvent = $quantityProduct % 2;
            if ($isQuantityEvent != 0) {
                $quantityProduct = $quantityProduct - 1;
            }
            $quantityProductDiscount = intdiv($quantityProduct, 2);
            $discount = $quantityProductDiscount * $cart->price * 0.50;
            $discount = round($discount, 2);
        };

        return $discount;
    }

}
