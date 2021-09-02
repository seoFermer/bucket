@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm mt-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Baskets</h5>
                        <p>Total: $ {{ $order->totalCosts()  }}</p>
                        <p>Discount: $ {{ $order->discount()  }}</p>
                        <p class="card-text">Delivery costs: $ {{ $order->delivery_costs }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($products AS $product)
                <div class="col-sm mt-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            <p class="card-title">code: {{ $product->code }}</p>
                            <p class="card-text">price: $ {{ $product->price }}</p>
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="hidden" name="code" value="{{ $product->code }}">
                                    <input type="number" class="form-control" placeholder="quantity" name="quantity">
                                    <div class="input-group-append">
                                        <button class="btn btn-success" type="submit">add to Cart</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
