@extends('layouts.admins')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline">Edit Orders</h5>
                <form method="POST" action="{{route('orders.update',['id' => $order->id])}}">
                    @csrf
                    <div class="form-group">
                        <p>Current Status is <b>{{$order->status}}</b></p>
                        <label for="status">Select Order Status</label>
                        <select name="status" class="form-control" id="statues">
                            <option value="">--Select Order Status--</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        </select>
                    </div>
                    <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
