@extends('auth.layout.template')
@section('title', 'Create Account')

@section('content')
<div class="auth-card">
    <p class="auth-card-title">Create account</p>
    <p class="auth-card-sub">Join PromptHub and start building</p>

    @if($errors->any())
        <div class="f-alert f-alert-error">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="flex-shrink:0;margin-top:1px"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
            <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST" novalidate>
        @csrf

        <div class="f-group">
            <label class="f-label">Full Name</label>
            <div class="f-input-wrap">
                <span class="f-icon">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                </span>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="f-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                    placeholder="John Doe" autofocus required>
            </div>
            @error('name')<p class="f-error">{{ $message }}</p>@enderror
        </div>

        <div class="f-group">
            <label class="f-label">Email Address</label>
            <div class="f-input-wrap">
                <span class="f-icon">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                </span>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="f-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                    placeholder="you@example.com" required>
            </div>
            @error('email')<p class="f-error">{{ $message }}</p>@enderror
        </div>

        <div class="f-group">
            <label class="f-label">Password</label>
            <div class="f-input-wrap">
                <span class="f-icon">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                </span>
                <input type="password" name="password" id="pw1"
                    class="f-input has-toggle {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    placeholder="At least 8 characters" required>
                <button type="button" class="f-toggle" onclick="togglePw('pw1',this)" title="Show/hide">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </button>
            </div>
            @error('password')<p class="f-error">{{ $message }}</p>@enderror
        </div>

        <div class="f-group" style="margin-bottom:22px">
            <label class="f-label">Confirm Password</label>
            <div class="f-input-wrap">
                <span class="f-icon">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                </span>
                <input type="password" name="password_confirmation" id="pw2"
                    class="f-input has-toggle"
                    placeholder="Repeat your password" required>
                <button type="button" class="f-toggle" onclick="togglePw('pw2',this)" title="Show/hide">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </button>
            </div>
        </div>

        <button type="submit" class="f-btn">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2" style="display:inline;margin-right:6px;vertical-align:middle"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"/></svg>
            Create Account
        </button>
    </form>

    <p class="f-footer">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
</div>

<script>
function togglePw(id, btn) {
    const f = document.getElementById(id);
    f.type = f.type === 'password' ? 'text' : 'password';
    btn.style.color = f.type === 'text' ? 'rgba(99,102,241,.8)' : 'rgba(148,163,184,.4)';
}
</script>
@endsection
