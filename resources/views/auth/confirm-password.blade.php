@extends('auth.layout.template')
@section('title') Confirm Password @endsection
@section('content')
    <div class="login-card">
        <div class="login-header">
            <h4>Confirm Password</h4>
            <h6>Please confirm your password before continuing.</h6>
        </div>

        <div class="mb-4 text-muted small">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <form class="theme-form login-form needs-validation" method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i data-feather="lock"></i></span>
                    <input class="form-control" type="password" name="password" required placeholder="*********"
                        autocomplete="current-password" autofocus>
                </div>
                @error('password')
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit">{{ __('Confirm') }}</button>
            </div>
        </form>
    </div>
@endsection
