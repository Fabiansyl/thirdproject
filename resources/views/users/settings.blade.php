@extends('layouts.app')

@section('content')
<div id="page-content" class="page-content">
    <div class="banner">
        <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('{{asset('assets/img/bg-header.jpg')}}');">
            <div class="container">
                <h1 class="pt-5">
                    Settings
                </h1>
                <p class="lead">
                    Update Your Account Info
                </p>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        @if (\Session::has('update'))
            <div class="alert alert-success">
                <ul>
                    <p>{!! \Session::get('update') !!}</p>
                </ul>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <section id="checkout">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xs-12 col-sm-6">
                    <h5 class="mb-3">ACCOUNT DETAILS</h5>
                    <!-- Account Details Form -->
                    <form action="{{ route('users.settings.update', $user->id) }}" class="bill-detail" method="POST">
                        @csrf
                        @method('POST')
                        <fieldset>
                            <div class="form-group row">
                                <div class="col">
                                    <input class="form-control" name="name" value="{{ old('name', $user->name) }}" placeholder="Full Name" type="text">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                           
                            <!-- Remaining account details fields -->
                            <div class="form-group">
                                <textarea class="form-control" name="address" placeholder="Address">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="town" value="{{ old('town', $user->town) }}" placeholder="Town / City" type="text">
                                @error('town')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="state" value="{{ old('state', $user->state) }}" placeholder="State / Country" type="text">
                                @error('state')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="zip_code" value="{{ old('zip_code', $user->zip_code) }}" placeholder="Postcode / Zip" type="text">
                                @error('zip_code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <input class="form-control" name="email" value="{{ old('email', $user->email) }}" placeholder="Email Address" type="email">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col">
                                    <input class="form-control" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" placeholder="Phone Number" type="tel">
                                    @error('phone_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" name="submit" class="btn btn-primary">UPDATE</button>
                                <div class="clearfix"></div>
                            </div>
                        </fieldset>
                    </form>
                    <!-- End of Account Details Form -->
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
