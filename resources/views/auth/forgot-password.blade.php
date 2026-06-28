@extends('auth.layout.template')
@section('title', 'Forgot Password')

@section('content')
<div class="auth-card">

    @if(session('status'))

        {{-- ── Email sent confirmation state ── --}}
        <div style="text-align:center;padding:8px 0 4px">
            <div style="width:64px;height:64px;border-radius:50%;background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.2);display:flex;align-items:center;justify-content:center;margin:0 auto 20px">
                <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#4ade80" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                </svg>
            </div>

            <p class="auth-card-title" style="margin-bottom:8px">Check your inbox</p>
            <p class="auth-card-sub" style="margin-bottom:20px">We sent a password reset link to your email. It expires in <strong style="color:rgba(203,213,225,.7)">60 minutes</strong>.</p>

            <div class="f-alert f-alert-success" style="text-align:left">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="flex-shrink:0;margin-top:1px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                </svg>
                {{ session('status') }}
            </div>

            <p style="font-size:12px;color:rgba(148,163,184,.4);margin:4px 0 18px;line-height:1.6">
                Didn't get it? Check your spam folder, or resend below.
            </p>

            <form action="{{ route('password.email') }}" method="POST" novalidate>
                @csrf
                <input type="hidden" name="email" value="{{ old('email') }}">
                <button type="submit" class="f-btn" style="background:rgba(99,102,241,.14);box-shadow:none;border:1px solid rgba(99,102,241,.3);color:#a5b4fc">
                    Resend reset link
                </button>
            </form>
        </div>

    @else

        {{-- ── Request form ── --}}
        <p class="auth-card-title">Forgot password?</p>
        <p class="auth-card-sub">Enter your email and we'll send you a reset link</p>

        @if($errors->any())
            <div class="f-alert f-alert-error">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="flex-shrink:0;margin-top:1px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                </svg>
                <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" novalidate>
            @csrf

            <div class="f-group">
                <label class="f-label">Email Address</label>
                <div class="f-input-wrap">
                    <span class="f-icon">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                        </svg>
                    </span>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="f-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        placeholder="you@example.com" autofocus required>
                </div>
                @error('email')<p class="f-error">{{ $message }}</p>@enderror
            </div>

            <button type="submit" class="f-btn">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2" style="display:inline;margin-right:6px;vertical-align:middle">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/>
                </svg>
                Send Reset Link
            </button>
        </form>

    @endif

    <p class="f-footer">
        <a href="{{ route('login') }}">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="display:inline;vertical-align:middle;margin-right:3px">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
            Back to Sign In
        </a>
    </p>
</div>
@endsection
