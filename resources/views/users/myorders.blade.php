
@extends('layouts.app')

@section('content')
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('{{ asset('assets/img/bg-header.jpg') }}');">
                <div class="container">
                    <h1 class="pt-5">
                        Your Transactions
                    </h1>
                    <p class="lead">
                        Save time and leave the work to us.
                    </p>
                </div>
            </div>
        </div>

        <section id="cart">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="5%">Transaction Id</th>
                                        <th>Name</th>
                                        <th>Last Name</th>
                                        <th>Address</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>Town</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if ($orders->count() > 0)
                                    @foreach ($orders as $order )
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>
                                                {{$order->name}}
                                            </td>
                                            <td>
                                                {{$order->last_name}}
                                            </td>
                                            <td>
                                                {{$order->address}}
                                            </td>
                                            <td>
                                                {{$order->phone_number}}
                                            </td>
                                            <td>
                                                {{$order->email}}
                                            </td>
                                            <td>
                                                {{$order->town}}
                                            </td>
                                            <td>
                                               Tsh {{number_format($order->price)}} /= 
                                            </td>
                                            <td>
                                                {{$order->status}}
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9">
                                            <p class="alert alert-warning">There are no Orders for now</p>
                                        </td>
                                    </tr>
                                @endif
                                
                                    
                                </tbody>
                            </table>
                        </div>

                      
                    </div>
                </div>
            </div>
        </section>

       
    </div>
@endsection
