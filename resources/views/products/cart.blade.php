@extends('layouts.app')

@section('content')
<div class="banner">
     <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('{{ asset('assets/img/bg-header.jpg') }}');">
        <div class="container">
            <h1 class="pt-5">
                Your Cart
            </h1>
            <p class="lead">
                  Save time and leave the work to us.
            </p>
            </div>
    </div>
</div>
    <div class="container mt-5">
        @if (\Session::has('delete'))
            <div class="alert alert-success">
                <ul>
                    <p>{!! \Session::get('delete') !!}</p>
                </ul>
            </div>
        @endif
    </div>
    
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body row justify-content-center">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $total = 0;
                                $counter = 1;
                            @endphp
                            @foreach ($cartProducts as $product)
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>Tsh {{ number_format($product->price) }} </td>
                                    <td>{{ number_format($product->qty) }}</td>
                                    <td>Tsh {{ number_format($subtotal = $product->price * $product->qty) }}/=</td>
                                   <td>
                                        <form action="{{ route('products.cart.delete', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product from your cart?');">
                                        @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @php
                                    $total += $subtotal;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                        <div class="col-md-12 text-center">
                            <h5>Total: Tsh{{ number_format($total) }}/=</h5>
                            @if ($total >0)
                                <form action ="{{ route('products.prepare.checkout') }}" method="POST">
                                    @csrf
                                    <input name="price" type="hidden" value="{{$total}}">
                                    <button type="submit" class="btn btn-primary">Checkout</button>
                                </form>
                            @else
                             <p class="alert alert-success">You have no products in cart you cannot checkout yet</p>
                            @endif
                        </div>
                    </div> 
                </div>
            </div>
        </div>

@endsection
