@extends('layouts.app')

@section('content')
<div class="banner">
    <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('{{ asset('assets/img/bg-header.jpg') }}');">
        <div class="container">
            <h1 class="pt-5">
                {{ $product->name }}
            </h1>
            <p class="lead">
                Save time and leave the work to us.
            </p>
        </div>
    </div>
</div>
<div class="container mt-5">
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <p>{!! \Session::get('success') !!}</p>
            </ul>
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            <ul>
                <p>{{ session('error') }}</p>
            </ul>
        </div>
    @endif
</div>
<div class="product-detail">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="slider-zoom">
                    <a href="{{ asset('storage/' . $product->image) }}" class="cloud-zoom" rel="transparentImage: 'data:image/gif;base64,R0lGODlhAQABAID/AMDAwAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==', useWrapper: false, showTitle: false, zoomWidth: '500', zoomHeight: '500', adjustY: 0, adjustX: 10" id="cloudZoom">
                        <img alt="Detail Zoom thumbs image" src="{{ asset('storage/' . $product->image) }}" style="width: 100%;">
                    </a>
                </div>
            </div>
            <div class="col-sm-6">
                <p>
                    <strong>Overview</strong><br>
                    {{ $product->description }}
                </p>
                <div class="row">
                    <div class="col-sm-6">
                        <p>
                            <strong>Price</strong> (/Pack)<br>
                            <span class="price">Tsh {{ number_format($product->price) }}/=</span>
                        </p>
                    </div>
                </div>
                <form method="POST" action="{{ route('products.add.cart') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="hidden" name="prod_id" value="{{ $product->id }}">
                            <input type="hidden" name="image" value="{{ $product->image }}">
                        </div>
                    </div>
                    <p class="mb-1"><strong>Quantity</strong></p>
                    <div class="row">
                        <div class="col-sm-5">
                            <input class="form-control" type="number" min="1" data-bts-button-down-class="btn btn-primary" data-bts-button-up-class="btn btn-primary" value="{{ $product->qty }}" name="qty">
                        </div>
                        <div class="col-sm-6">
                            <span class="pt-1 d-inline-block">Pack (1000 gram)</span>
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-6 mt-4">
                            @if (isset(Auth::user()->id))
                                @if ($checkInCart > 0)
                                    <button disabled class="mt-3 btn btn-primary btn-lg">{{ __('Added to Cart') }}</button>
                                @else
                                    <button type="submit" class="mt-3 btn btn-primary btn-lg"><i class="fa fa-shopping-basket"></i>{{ __('Add to Cart') }}</button>
                                @endif
                            @else
                                <p class="alert alert-success">Login to add items to cart</p> 
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Related Products Section outside container -->
<div class="related-products">
    <div class="container-fluid">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center mb-4">{{ __('Related Products') }}</h2>
                    </div>
                    <div class="card-body row justify-content-center">
                        @if($relatedProducts->count() > 0)
                            @foreach ($relatedProducts as $relatedProduct)
                                <div class="card col-md-3 m-2 p-0">
                                    <img src="{{ asset('storage/' . $relatedProduct->image) }}" class="card-img-top" alt="{{ $relatedProduct->name }}" style="height: 150px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ ucfirst($relatedProduct->name) }}</h5>
                                        <p class="card-text">Tsh {{ number_format($relatedProduct->price) }}/=</p>
                                        <a href="{{ route('single.product', $relatedProduct->id) }}" class="btn btn-primary">View Details</a>
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
</div>
@endsection
