<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sign In') — PromptHub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800;14..32,900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html, body {
            height: 100%;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        body {
            min-height: 100vh;
            display: flex;
            background: #09101f;
            position: relative;
            overflow: hidden;
        }

        /* Animated background orbs */
        .bg-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
            animation: orb-float 8s ease-in-out infinite alternate;
        }
        .bg-orb-1 { width: 500px; height: 500px; background: rgba(99,102,241,.18); top: -150px; left: -150px; animation-delay: 0s; }
        .bg-orb-2 { width: 400px; height: 400px; background: rgba(139,92,246,.12); bottom: -100px; right: -100px; animation-delay: 3s; }
        .bg-orb-3 { width: 300px; height: 300px; background: rgba(168,85,247,.08); top: 40%; left: 40%; animation-delay: 1.5s; }

        @keyframes orb-float {
            from { transform: translate(0,0) scale(1); }
            to   { transform: translate(30px,20px) scale(1.05); }
        }

        /* Grid dots overlay */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: radial-gradient(rgba(255,255,255,.035) 1px, transparent 1px);
            background-size: 32px 32px;
            pointer-events: none;
        }

        /* Split layout */
        .auth-shell {
            display: flex;
            width: 100%;
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }

        /* Left brand panel — hidden on small screens */
        .auth-brand {
            flex: 1;
            display: none;
            flex-direction: column;
            justify-content: center;
            padding: 60px 56px;
            border-right: 1px solid rgba(255,255,255,.05);
        }
        @media (min-width: 1024px) { .auth-brand { display: flex; } }

        .brand-logo {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 60px;
        }
        .brand-logo-icon {
            width: 44px; height: 44px;
            border-radius: 14px;
            background: linear-gradient(135deg,#6366f1,#8b5cf6,#a855f7);
            box-shadow: 0 4px 20px rgba(99,102,241,.55);
            display: flex; align-items: center; justify-content: center;
        }
        .brand-logo-name { font-size: 18px; font-weight: 800; color: #fff; letter-spacing: -.3px; }

        .brand-headline { font-size: clamp(2rem,3.5vw,2.8rem); font-weight: 900; color: #fff; line-height: 1.2; letter-spacing: -.5px; margin-bottom: 20px; }
        .brand-headline span { background: linear-gradient(135deg,#818cf8,#c084fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .brand-sub { font-size: 15px; color: rgba(148,163,184,.6); line-height: 1.7; max-width: 380px; }

        .brand-features { margin-top: 52px; display: flex; flex-direction: column; gap: 18px; }
        .brand-feature { display: flex; align-items: center; gap: 14px; }
        .brand-feature-icon { width: 36px; height: 36px; border-radius: 10px; background: rgba(99,102,241,.15); border: 1px solid rgba(99,102,241,.25); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .brand-feature-text { font-size: 13px; font-weight: 500; color: rgba(203,213,225,.7); }

        .brand-footer { margin-top: auto; padding-top: 40px; display: flex; align-items: center; gap: 8px; }
        .brand-dot { width: 6px; height: 6px; border-radius: 50%; background: #34d399; animation: pulse 2.5s ease infinite; }
        .brand-footer-text { font-size: 11px; font-weight: 700; letter-spacing: .18em; text-transform: uppercase; color: rgba(148,163,184,.2); }
        @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.5;transform:scale(1.35)} }

        /* Right form panel */
        .auth-form-panel {
            width: 100%;
            max-width: 480px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px 32px;
            position: relative;
        }
        @media (min-width: 1024px) { .auth-form-panel { padding: 60px 56px; } }
        @media (min-width: 1024px) { .auth-form-panel { max-width: 520px; } }

        /* Mobile logo (only visible when brand panel is hidden) */
        .mobile-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 36px;
        }
        @media (min-width: 1024px) { .mobile-logo { display: none; } }
        .mobile-logo-icon {
            width: 38px; height: 38px; border-radius: 12px;
            background: linear-gradient(135deg,#6366f1,#8b5cf6);
            box-shadow: 0 4px 14px rgba(99,102,241,.5);
            display: flex; align-items: center; justify-content: center;
        }
        .mobile-logo-name { font-size: 16px; font-weight: 800; color: #fff; }

        /* Card */
        .auth-card {
            background: rgba(255,255,255,.04);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 24px;
            padding: 36px 32px;
            backdrop-filter: blur(20px);
        }

        .auth-card-title { font-size: 22px; font-weight: 800; color: #fff; letter-spacing: -.3px; margin-bottom: 6px; }
        .auth-card-sub   { font-size: 13px; color: rgba(148,163,184,.6); margin-bottom: 28px; }

        /* Form elements */
        .f-group { margin-bottom: 18px; }
        .f-label {
            display: block;
            font-size: 11px; font-weight: 800; color: rgba(148,163,184,.7);
            text-transform: uppercase; letter-spacing: .12em;
            margin-bottom: 8px;
        }
        .f-input-wrap { position: relative; }
        .f-icon {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            color: rgba(148,163,184,.4);
            pointer-events: none;
            display: flex; align-items: center;
        }
        .f-input {
            width: 100%;
            padding: 11px 14px 11px 42px;
            background: rgba(255,255,255,.05);
            border: 1.5px solid rgba(255,255,255,.08);
            border-radius: 12px;
            font-size: 13px; font-family: inherit;
            color: #fff;
            outline: none;
            transition: border-color .15s, box-shadow .15s, background .15s;
        }
        .f-input::placeholder { color: rgba(148,163,184,.3); }
        .f-input:focus {
            border-color: rgba(99,102,241,.6);
            box-shadow: 0 0 0 3px rgba(99,102,241,.12);
            background: rgba(255,255,255,.07);
        }
        .f-input.is-invalid { border-color: rgba(239,68,68,.5); }
        .f-error { font-size: 11px; color: #f87171; margin-top: 6px; }
        .f-toggle {
            position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer;
            color: rgba(148,163,184,.4); display: flex; align-items: center;
            transition: color .15s;
        }
        .f-toggle:hover { color: rgba(148,163,184,.8); }
        .f-input.has-toggle { padding-right: 42px; }

        /* Alerts */
        .f-alert {
            padding: 12px 14px; border-radius: 12px;
            font-size: 12px; font-weight: 500;
            margin-bottom: 20px; display: flex; align-items: flex-start; gap: 10px;
        }
        .f-alert-success { background: rgba(34,197,94,.1); border: 1px solid rgba(34,197,94,.2); color: #4ade80; }
        .f-alert-error   { background: rgba(239,68,68,.1);  border: 1px solid rgba(239,68,68,.2);  color: #f87171; }

        /* Row helpers */
        .f-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px; }
        .f-link { font-size: 12px; font-weight: 600; color: #818cf8; text-decoration: none; transition: color .15s; }
        .f-link:hover { color: #a5b4fc; }

        /* Checkbox */
        .f-check { display: flex; align-items: center; gap: 8px; cursor: pointer; }
        .f-check input[type=checkbox] { width: 16px; height: 16px; accent-color: #6366f1; border-radius: 4px; cursor: pointer; }
        .f-check-label { font-size: 12px; color: rgba(148,163,184,.6); }

        /* Submit button */
        .f-btn {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            font-size: 14px; font-weight: 700; font-family: inherit;
            color: #fff;
            background: linear-gradient(135deg,#6366f1,#8b5cf6);
            box-shadow: 0 4px 20px rgba(99,102,241,.4);
            transition: all .18s;
            margin-top: 6px;
        }
        .f-btn:hover { transform: translateY(-1px); box-shadow: 0 8px 28px rgba(99,102,241,.5); filter: brightness(1.07); }
        .f-btn:active { transform: translateY(0); }

        /* Divider */
        .f-divider { text-align: center; margin: 20px 0; font-size: 12px; color: rgba(148,163,184,.3); position: relative; }
        .f-divider::before, .f-divider::after { content: ''; position: absolute; top: 50%; width: 42%; height: 1px; background: rgba(255,255,255,.06); }
        .f-divider::before { left: 0; }
        .f-divider::after  { right: 0; }

        /* Footer link */
        .f-footer { text-align: center; margin-top: 22px; font-size: 12px; color: rgba(148,163,184,.45); }
        .f-footer a { color: #818cf8; font-weight: 600; text-decoration: none; }
        .f-footer a:hover { color: #a5b4fc; }

        /* Grid-2 for name+email row */
        .f-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        @media (max-width: 480px) { .f-grid-2 { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>
    <div class="bg-orb bg-orb-3"></div>

    <div class="auth-shell">
        {{-- Left brand panel --}}
        <div class="auth-brand">
            <div class="brand-logo">
                <div class="brand-logo-icon">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                    </svg>
                </div>
                <span class="brand-logo-name">PromptHub</span>
            </div>

            <h1 class="brand-headline">The AI Prompt<br><span>Marketplace</span></h1>
            <p class="brand-sub">Discover, share, and monetize the world's best AI prompts. Built for creators, power users, and teams.</p>

            <div class="brand-features">
                @foreach([
                    ['icon'=>'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z', 'text'=>'Curated prompts for every AI tool'],
                    ['icon'=>'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'text'=>'Community of 10,000+ creators'],
                    ['icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'text'=>'Verified quality — admin-approved'],
                ] as $f)
                    <div class="brand-feature">
                        <div class="brand-feature-icon">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#818cf8" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $f['icon'] }}"/></svg>
                        </div>
                        <span class="brand-feature-text">{{ $f['text'] }}</span>
                    </div>
                @endforeach
            </div>

            <div class="brand-footer">
                <span class="brand-dot"></span>
                <span class="brand-footer-text">Secure · Private · Fast</span>
            </div>
        </div>

        {{-- Right form panel --}}
        <div class="auth-form-panel">
            <div class="mobile-logo">
                <div class="mobile-logo-icon">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                    </svg>
                </div>
                <span class="mobile-logo-name">PromptHub</span>
            </div>

            @yield('content')
        </div>
    </div>
</body>
</html>
