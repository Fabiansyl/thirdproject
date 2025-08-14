@extends('layouts.admins')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline">Create Product</h5>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Name input -->
                    <div class="form-outline mb-4 mt-4">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name Your Product" />
                    </div>

                    <!-- Price input -->
                    <div class="form-outline mb-4 mt-4">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control" placeholder="Price" />
                    </div>

                    <!-- Description input -->
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" rows="3" placeholder="Description"></textarea>
                    </div>

                    <!-- Category input -->
                    <div class="form-group">
                        <label for="category">Select Category</label>
                        <select name="category_id" class="form-control" id="category">
                            <option value="">--select category--</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Expiration date input -->
                    <div class="form-group">
                        <label for="exp_date">Select Expiration Date</label>
                        <input type="date" name="exp_date" class="form-control" placeholder="Date" />
                    </div>

                    <!-- Image input -->
                    <div class="form-outline mb-4 mt-4">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" placeholder="Image" />
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary mb-4 text-center">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
