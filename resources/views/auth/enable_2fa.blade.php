@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Enable 2FA') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('2fa.enable') }}">
                        @csrf
                        <div class="form-group">
                            <label for="2fa_secret">Scan the QR code with your Google Authenticator app:</label>
                            <div>
                                <img src="{{ $QR_Image }}" alt="2FA QR Code">
                            </div>
                            <div>
                                <p>Secret: {{ $secret }}</p>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Enable 2FA') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
