@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-7">
                <h5 class="mb-3">BILLING DETAILS</h5>
                <!-- Bill Detail of the Page -->
                <form action="{{ route('products.process.checkout') }}" method="POST" class="bill-detail">
                    @csrf
                    <fieldset>
                        <div class="form-group row">
                            <div class="col">
                                <input class="form-control" name="name" placeholder="Name" type="text" required>
                            </div>
                            <div class="col">
                                <input class="form-control" name="last_name" placeholder="Last Name" type="text" required>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <input class="form-control" name="" placeholder="Company Name" type="text">
                        </div> --}}
                        <div class="form-group">
                            <textarea class="form-control" name="address" placeholder="Address" required></textarea>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="town" placeholder="Town / City" type="text" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="state" placeholder="State / Country" type="text" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="zip_code" placeholder="Postcode / Zip" type="text" required>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <input class="form-control" name="email" placeholder="Email Address" type="email" required>
                            </div>
                            <div class="col">
                                <input class="form-control" name="phone_number" placeholder="Phone Number" type="tel" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                <input class="form-control" name="user_id" value="{{ Auth::user()->id }}" type="text" readonly>
                            </div>
                            <div class="col">
                                <input class="form-control" name="price" value="{{ $checkoutSubtotal + $shippingPrice }}" type="text" readonly>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <button class="btn btn-primary" style="width:80px; height:40px" name="submit" type="submit">SUBMIT</button>
                    </div>
                </form>
                <!-- Bill Detail of the Page end -->
            </div>
            <div class="col-xs-12 col-sm-5">
                <div class="holder">
                    <h5 class="mb-3">YOUR ORDER</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Products</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $product)
                                     <tr>
                                         <td>
                                              {{ $product->name }} x {{ $product->qty }}
                                        </td>
                                        <td class="text-right">
                                             Tshs {{ number_format($product->price * $product->qty) }}/=
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        <strong>Cart Subtotal</strong>
                                    </td>
                                    <td class="text-right">
                                        Tsh {{ number_format($checkoutSubtotal) }} /=
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Shipping</strong>
                                    </td>
                                    <td class="text-right">
                                        Tsh {{ number_format($shippingPrice) }} /=
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>ORDER TOTAL</strong>
                                    </td> 
                                    <td class="text-right">
                                        <strong> Tsh {{ number_format($checkoutSubtotal + $shippingPrice) }} /=</strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>        
                </div>
               {{-- <p class="text-right mt-3">
                    <input checked="" type="checkbox"> I’ve read &amp; accept the <a href="#">terms &amp; conditions</a>
                </p>
                <a href="#" class="btn btn-primary float-right">PROCEED TO CHECKOUT <i class="fa fa-check"></i></a>
                <div class="clearfix"></div>--}}
            </div>
        </div>
    </div>
@endsection
