@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                 <div class="row justify-content-between align-items-center">
                       <div class="col-auto">
                            {{ __('Products for this Category') }}
                        </div>
                        <div class="col-auto">
                            <a href="{{ url('/') }}">Back</a>
                        </div>
                </div>
                </div>

                 <div class="card-body row justify-content-center">
                        @if($products->count() > 0)
                            @foreach ($products as $product)
                                <div class="card col-md-3 m-2 p-0">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 150px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ ucfirst($product->name) }}</h5>
                                        <p class="card-text">Tsh {{ number_format($product->price) }}/=</p>
                                        <a href="{{ route('single.product', $product->id) }}" class="btn btn-primary">View Details</a>
                                    </div>
                                </div>
                            @endforeach
                        @else  
                            <p class="alert alert-warning">There are no Related Products in this category just now</p> 
                        @endif
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
