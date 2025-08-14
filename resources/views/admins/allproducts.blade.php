@extends('layouts.admins')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                     <div class="container">
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
                <h5 class="card-title mb-5 d-inline">Product List</h5>
            <a  href="{{route('products.create')}}" class="btn btn-primary mb-4 text-center float-right">Create Product</a>
               
                <table class="table">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Expiration Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id}}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ number_format($product->price) }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->exp_date }}</td>
                                <td>
                                    <form action="{{ route('products.delete', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
