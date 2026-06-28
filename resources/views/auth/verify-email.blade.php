@extends('auth.layout.template')
@section('title') Verify Email @endsection
@section('content')
<div class="login-card">
    <div class="login-header">
        <h4>Verify Email</h4>
        <h6>Please verify your email address to continue.</h6>
    </div>

    <div class="mb-4 text-muted small">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success mb-4" role="alert">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="d-grid gap-2">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div class="d-grid">
                <button class="btn btn-primary" type="submit">{{ __('Resend Verification Email') }}</button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <div class="d-grid">
                <button type="submit" class="btn btn-outline-secondary">{{ __('Log Out') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
