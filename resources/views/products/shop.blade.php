@extends('layouts.app')

@section('content')

<div class="banner mt-0">
    <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('{{ asset('assets/img/bg-header.jpg') }}');">
        <div class="container">
            <h1 class="pt-5">
                Shopping Page
            </h1>
            <p class="lead">
                Save time and leave the groceries to us.
            </p>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body row justify-content-center">
                @foreach ($categories as $category)
                <div class="alert alert-success col-auto p-auto m-2" role="alert">
                    <a href="{{ route('single.category', $category->id) }}">{{ strtoupper($category->name) }}</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
 
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cash Crops') }}</div>
                <div class="card-body row justify-content-center">
                    @foreach ( $cashcrops as $product)
                    <div class="card col-md-3 m-2 p-0">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body text-center">
                            <a href="{{ route('single.product', $product->id) }}" class="card-title">{{ strtoupper($product->name) }}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Vegetables') }}</div>
                <div class="card-body row justify-content-center">
                    @foreach ($vegetables as $product)
                    <div class="card col-md-3 m-2 p-0">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body text-center">
                            <a href="{{ route('single.product', $product->id) }}" class="card-title">{{ strtoupper($product->name) }}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Fruits') }}</div>
                <div class="card-body row justify-content-center">
                    @foreach ($fruits as $product)
                    <div class="card col-md-3 m-2 p-0">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body text-center">
                            <a href="{{ route('single.product', $product->id) }}" class="card-title">{{ strtoupper($product->name) }}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cereals') }}</div>
                <div class="card-body row justify-content-center">
                    @foreach ( $cereals as $product)
                    <div class="card col-md-3 m-2 p-0">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body text-center">
                            <a href="{{ route('single.product', $product->id) }}" class="card-title">{{ strtoupper($product->name) }}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

