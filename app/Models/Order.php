<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_costs',
        'status',
    ];

    public function cart()
    {
       return $this->hasMany(Cart::class);
    }

    public function totalCosts()
    {
        return $this->cart->sum('total');
    }

    public function discount()
    {
        return $this->cart->sum('discount');
    }
}
