@extends('auth.layout.template')
@section('title', 'Reset Password')

@section('content')
<div class="auth-card">
    <p class="auth-card-title">Set new password</p>
    <p class="auth-card-sub">Create a strong password for your account</p>

    @if($errors->any())
        <div class="f-alert f-alert-error">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="flex-shrink:0;margin-top:1px">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
            </svg>
            <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
        </div>
    @endif

    <form action="{{ route('password.store') }}" method="POST" novalidate>
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        {{-- Email (read-only) --}}
        <div class="f-group">
            <label class="f-label">Email Address</label>
            <div class="f-input-wrap">
                <span class="f-icon">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                    </svg>
                </span>
                <input type="email" name="email"
                    value="{{ old('email', $request->email) }}"
                    class="f-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                    style="opacity:.6;cursor:default"
                    readonly>
            </div>
            @error('email')<p class="f-error">{{ $message }}</p>@enderror
        </div>

        {{-- New password --}}
        <div class="f-group">
            <label class="f-label">New Password</label>
            <div class="f-input-wrap">
                <span class="f-icon">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                    </svg>
                </span>
                <input type="password" name="password" id="pwField"
                    class="f-input has-toggle {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    placeholder="At least 8 characters" autofocus required
                    oninput="checkStrength(this.value);checkMatch()">
                <button type="button" class="f-toggle" onclick="togglePw('pwField',this)" title="Show/hide">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </button>
            </div>
            @error('password')<p class="f-error">{{ $message }}</p>@enderror

            {{-- Strength meter --}}
            <div id="strengthWrap" style="margin-top:9px;display:none">
                <div style="display:flex;gap:4px;margin-bottom:6px">
                    <div class="str-bar" id="sb1"></div>
                    <div class="str-bar" id="sb2"></div>
                    <div class="str-bar" id="sb3"></div>
                    <div class="str-bar" id="sb4"></div>
                </div>
                <p id="strengthLabel" style="font-size:11px;margin:0"></p>
            </div>
        </div>

        {{-- Confirm password --}}
        <div class="f-group" style="margin-bottom:22px">
            <label class="f-label">Confirm New Password</label>
            <div class="f-input-wrap">
                <span class="f-icon">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </span>
                <input type="password" name="password_confirmation" id="pwConfirm"
                    class="f-input has-toggle"
                    placeholder="Repeat your new password" required
                    oninput="checkMatch()">
                <button type="button" class="f-toggle" onclick="togglePw('pwConfirm',this)" title="Show/hide">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </button>
            </div>
            <p id="matchMsg" style="font-size:11px;margin-top:6px;display:none"></p>
        </div>

        <button type="submit" class="f-btn">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2" style="display:inline;margin-right:6px;vertical-align:middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
            </svg>
            Reset Password
        </button>
    </form>

    <p class="f-footer">
        <a href="{{ route('login') }}">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="display:inline;vertical-align:middle;margin-right:3px">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
            Back to Sign In
        </a>
    </p>
</div>

<style>
    .str-bar {
        flex: 1; height: 3px; border-radius: 99px;
        background: rgba(255,255,255,.08);
        transition: background .2s;
    }
</style>

<script>
function togglePw(id, btn) {
    const f = document.getElementById(id);
    f.type = f.type === 'password' ? 'text' : 'password';
    btn.style.color = f.type === 'text' ? 'rgba(99,102,241,.8)' : 'rgba(148,163,184,.4)';
}

function checkStrength(val) {
    const wrap  = document.getElementById('strengthWrap');
    const label = document.getElementById('strengthLabel');
    if (!val) { wrap.style.display = 'none'; return; }
    wrap.style.display = 'block';

    let score = 0;
    if (val.length >= 8)                                    score++;
    if (val.length >= 12)                                   score++;
    if (/[A-Z]/.test(val) && /[a-z]/.test(val))            score++;
    if (/[0-9]/.test(val) && /[^A-Za-z0-9]/.test(val))    score++;
    score = Math.max(1, score);

    const palette = ['#ef4444', '#f97316', '#eab308', '#22c55e'];
    const names   = ['Too weak', 'Weak', 'Good', 'Strong'];

    for (let i = 1; i <= 4; i++) {
        document.getElementById('sb' + i).style.background =
            i <= score ? palette[score - 1] : 'rgba(255,255,255,.08)';
    }
    label.textContent = names[score - 1];
    label.style.color = palette[score - 1];
}

function checkMatch() {
    const pw  = document.getElementById('pwField').value;
    const cpw = document.getElementById('pwConfirm').value;
    const msg = document.getElementById('matchMsg');
    if (!cpw) { msg.style.display = 'none'; return; }
    msg.style.display = 'block';
    if (pw === cpw) {
        msg.textContent = '✓ Passwords match';
        msg.style.color = '#4ade80';
    } else {
        msg.textContent = '✕ Passwords do not match';
        msg.style.color = '#f87171';
    }
}
</script>
@endsection
