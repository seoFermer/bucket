@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="row mt-5">
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
                                        <button class="btn btn-dark" type="submit">add to Cart</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-sm mt-5">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Basket</h5>
                        <p>Total: $ {{ $order ? $order->totalCosts() : 0 }}</p>
                        <p>Discount: $ {{ $order ? $order->discount() : 0 }}</p>
                        <p><b>Total Discounted Price: $ {{ $order ? $order->totalDiscountedPrice() : 0 }}</b></p>
                        <p class="card-text"><b>Delivery costs: $ {{ $order ? $order->delivery_costs : 0 }}</b></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <h2>Products in the Basket</h2>
            <table class="table mt-3">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Total Discounted Price</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($order))
                    @foreach($order->cart AS $product)
                        <tr>
                            <td>{{ $product->product->code }}</td>
                            <td>{{ $product->product->title }}</td>
                            <td>{{ $product->product->price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->total }}</td>
                            <td>{{ $product->discount }}</td>
                            <td>{{ $product->discountedPrice()}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
