<?php

namespace App\Services;


class DiscountServices
{

    public function __construct()
    {

    }

    public function getDiscountByProduct($cart)
    {
        $m = 0;
           if($cart->product->code == 'R01'){
               $quantity = $cart->quantity;
               $quantity2 = $quantity % 2;
               if($quantity2 != 0) {
                   $quantity = $quantity -1;
               }
               $quantity = intdiv($quantity,2);
               $m = $quantity * $cart->price * 0.50;
               $m = round($m, 2);
           };


       return $m;

    }

}
