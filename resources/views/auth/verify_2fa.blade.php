@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify 2FA') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('2fa.verify') }}">
                        @csrf
                        <div class="form-group">
                            <label for="one_time_password">Enter the OTP from your Google Authenticator app:</label>
                            <input type="text" name="one_time_password" class="form-control" required autofocus>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Verify') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
