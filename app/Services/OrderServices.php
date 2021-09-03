<?php

namespace App\Services;


use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Exception;


class OrderServices
{

    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    public function getOrder()
    {
        DB::beginTransaction();
        try {

            $order =  $this->model->first();

            if (empty($order)) {
                $order = $this->model::create(
                    [
                        'delivery_costs' => 0,
                        'status' => '0',
                    ]);
            }

        } catch (Exception $e) {
            DB::rollBack();
        }

        DB::commit();


        return $order;
    }

}
