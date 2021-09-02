<?php

namespace App\Services;

use App\Models\Product;


class DeliveryServices
{
    public function getDeliveryCosts($order)
    {
        $totalCosts = $order->totalCosts();
        $deliveryCosts = 4.95;

        if ($totalCosts > 50) $deliveryCosts = 2.95;
        if ($totalCosts > 90) $deliveryCosts = 0;

        return $deliveryCosts;
    }

}
