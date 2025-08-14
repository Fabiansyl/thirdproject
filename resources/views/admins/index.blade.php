@extends('layouts.admins')

@section('content') 
@if ($expiredProducts->isNotEmpty())
    <div class="alert alert-warning">
        <p>The following products have expired:</p>
        <ul>
            @foreach ($expiredProducts as $product)
                <li>{{ $product->name }} - {{ $product->exp_date }}</li>
                <form action="{{ route('products.delete', ['id' => $product->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Remove</button>
                </form>
            @endforeach
        </ul>
    </div>
@endif

      <div class="row">
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Products</h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
              <p class="card-text">number of products: {{$productsCount}}</p>
             
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Orders</h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
              <p class="card-text">number of orders: {{$ordersCount}}</p>
             
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Categories</h5>
              
              <p class="card-text">number of categories: {{$categoriesCount}}</p>
              
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Admins</h5>
              
              <p class="card-text">number of admins: {{$adminsCount}}</p>
              
            </div>
          </div>
        </div>
      </div>
  
@endsection
 