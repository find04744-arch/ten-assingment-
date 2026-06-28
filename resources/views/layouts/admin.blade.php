<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — Admin · {{ config('app.name', 'PromptHub') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800;14..32,900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, ::before, ::after { box-sizing: border-box; }
        html, body { height: 100%; margin: 0; padding: 0; }
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; -webkit-font-smoothing: antialiased; background: #eef1f7; color: #1e293b; }

        /* ── Scrollbars ── */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(148,163,184,.3); border-radius: 99px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(99,102,241,.4); }
        .thin-scroll::-webkit-scrollbar { width: 2px; }
        .thin-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,.07); }

        /* ── Shell ── */
        .admin-shell { display: flex; height: 100vh; overflow: hidden; }

        /* ── Sidebar ── */
        .sidebar {
            width: 270px; flex-shrink: 0;
            display: flex; flex-direction: column; height: 100vh;
            background: #09101f;
            box-shadow: 4px 0 48px rgba(0,0,0,.55), inset -1px 0 0 rgba(255,255,255,.04);
            position: relative; z-index: 10;
        }

        /* brand */
        .sb-brand { display: flex; align-items: center; gap: 12px; padding: 18px 16px; border-bottom: 1px solid rgba(255,255,255,.04); flex-shrink: 0; }
        .sb-logo { width: 38px; height: 38px; border-radius: 12px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg,#6366f1,#8b5cf6,#a855f7); box-shadow: 0 4px 18px rgba(99,102,241,.5), 0 0 0 1px rgba(139,92,246,.25); }
        .sb-appname { font-size: 15px; font-weight: 800; color: #fff; letter-spacing: -.3px; }
        .sb-status { display: flex; align-items: center; gap: 5px; margin-top: 4px; }
        .sb-dot { width: 6px; height: 6px; border-radius: 50%; background: #34d399; animation: ap-pulse 2.5s ease infinite; flex-shrink: 0; }
        .sb-tag { font-size: 9px; font-weight: 800; letter-spacing: .2em; text-transform: uppercase; color: rgba(148,163,184,.22); }

        /* nav */
        .sb-nav { flex: 1; overflow-y: auto; padding: 8px 0; }
        .sb-section { padding: 14px 16px 5px; font-size: 9px; font-weight: 800; letter-spacing: .22em; text-transform: uppercase; color: rgba(148,163,184,.18); }
        .sb-item { display: flex; align-items: center; gap: 10px; margin: 1px 8px; padding: 9px 10px; border-radius: 10px; border: 1px solid transparent; text-decoration: none; cursor: pointer; transition: all .15s ease; position: relative; }
        .sb-item:hover:not(.sb-active) { background: rgba(255,255,255,.04); border-color: rgba(255,255,255,.05); }
        .sb-item:hover:not(.sb-active) .sb-icon { background: rgba(255,255,255,.1) !important; }
        .sb-item:hover:not(.sb-active) .sb-label { color: rgba(255,255,255,.82) !important; }
        .sb-icon { width: 34px; height: 34px; border-radius: 9px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; transition: all .15s ease; }
        .sb-label { flex: 1; font-size: 13.5px; transition: color .15s; }
        .sb-badge { display: inline-flex; align-items: center; justify-content: center; min-width: 18px; height: 18px; padding: 0 5px; font-size: 10px; font-weight: 800; border-radius: 99px; background: linear-gradient(135deg,#ef4444,#dc2626); color: #fff; box-shadow: 0 2px 8px rgba(239,68,68,.4); animation: ap-pulse 2.5s ease infinite; }
        .sb-activedot { width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }

        /* footer */
        .sb-footer { padding: 10px; flex-shrink: 0; border-top: 1px solid rgba(255,255,255,.04); }
        .sb-user { display: flex; align-items: center; gap: 10px; padding: 10px 11px; border-radius: 10px; background: rgba(255,255,255,.035); border: 1px solid rgba(255,255,255,.055); }
        .sb-avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg,#6366f1,#a855f7); flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 700; color: #fff; position: relative; }
        .sb-avatar-ring { position: absolute; bottom: -1px; right: -1px; width: 11px; height: 11px; border-radius: 50%; background: #34d399; border: 2px solid #09101f; }
        .sb-uname { font-size: 13px; font-weight: 600; color: #fff; line-height: 1.1; }
        .sb-urole { font-size: 10px; color: rgba(148,163,184,.32); margin-top: 2px; }
        .sb-logout { width: 30px; height: 30px; border-radius: 8px; border: none; background: transparent; cursor: pointer; display: flex; align-items: center; justify-content: center; color: rgba(148,163,184,.32); transition: all .15s; }
        .sb-logout:hover { background: rgba(239,68,68,.15); color: #f87171; }

        /* ── Main ── */
        .main-wrap { flex: 1; display: flex; flex-direction: column; overflow: hidden; min-width: 0; }

        /* topbar */
        .topbar { flex-shrink: 0; height: 58px; display: flex; align-items: center; gap: 10px; padding: 0 22px; background: #fff; border-bottom: 1px solid #e5e9f0; box-shadow: 0 1px 10px rgba(0,0,0,.045); }
        .tb-ham { width: 36px; height: 36px; border-radius: 9px; display: flex; align-items: center; justify-content: center; background: #f1f5f9; color: #64748b; border: none; cursor: pointer; transition: background .15s; }
        .tb-ham:hover { background: #e2e8f0; }
        .tb-bc { display: flex; align-items: center; gap: 8px; min-width: 0; }
        .tb-bar { width: 3px; height: 20px; border-radius: 99px; background: linear-gradient(180deg,#6366f1,#a855f7); flex-shrink: 0; }
        .tb-title { font-size: 14.5px; font-weight: 700; color: #1e293b; }
        .tb-sep { color: #cbd5e1; font-size: 12px; }
        .tb-sub { font-size: 12px; color: #94a3b8; }
        .tb-spacer { flex: 1; }
        .tb-date { display: flex; align-items: center; gap: 5px; padding: 5px 11px; border-radius: 8px; background: #f8fafc; border: 1px solid #e9ecef; font-size: 11.5px; font-weight: 500; color: #94a3b8; }
        .tb-bell { position: relative; width: 36px; height: 36px; border-radius: 9px; display: flex; align-items: center; justify-content: center; background: #fff5f5; border: 1px solid #fecaca; color: #f87171; }
        .tb-bellcount { position: absolute; top: -4px; right: -4px; min-width: 16px; height: 16px; padding: 0 4px; border-radius: 99px; font-size: 9px; font-weight: 800; color: #fff; background: linear-gradient(135deg,#ef4444,#dc2626); display: flex; align-items: center; justify-content: center; }
        .tb-viewsite { display: inline-flex; align-items: center; gap: 6px; padding: 7px 14px; border-radius: 9px; font-size: 12px; font-weight: 700; color: #fff; text-decoration: none; background: linear-gradient(135deg,#6366f1,#8b5cf6); box-shadow: 0 2px 10px rgba(99,102,241,.35); transition: all .15s; }
        .tb-viewsite:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(99,102,241,.45); }

        /* flash */
        .flash { margin: 14px 22px 0; display: flex; align-items: center; gap: 11px; padding: 12px 15px; border-radius: 14px; animation: ap-slide-down .25s ease; transition: opacity .3s, transform .3s; }
        .flash-icon { width: 28px; height: 28px; border-radius: 50%; flex-shrink: 0; display: flex; align-items: center; justify-content: center; }
        .flash-ok { background: linear-gradient(135deg,#f0fdf4,#dcfce7); border: 1px solid #a7f3d0; }
        .flash-err { background: linear-gradient(135deg,#fff5f5,#fee2e2); border: 1px solid #fca5a5; }
        .flash-dismiss { background: none; border: none; cursor: pointer; display: flex; margin-left: auto; }

        /* content */
        .page-content { flex: 1; overflow-y: auto; padding: 22px 24px; }

        /* ── Cards / KPIs ── */
        .kpi-card { transition: transform .2s ease, box-shadow .2s ease; }
        .kpi-card:hover { transform: translateY(-3px); box-shadow: 0 16px 40px rgba(0,0,0,.1); }

        /* ── Table rows ── */
        .data-row { transition: background .1s; }
        .data-row:hover { background: #f7f9ff !important; }

        /* ── Utility badges ── */
        .status-pill { display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 99px; font-size: 11px; font-weight: 700; }

        /* ── Action buttons ── */
        .act-btn { display: inline-flex; align-items: center; gap: 5px; font-size: 11.5px; font-weight: 700; padding: 6px 12px; border-radius: 8px; border: 1px solid; cursor: pointer; transition: all .15s; text-decoration: none; }

        /* ── Animations ── */
        @keyframes ap-pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.5;transform:scale(1.35)} }
        @keyframes ap-slide-down { from{opacity:0;transform:translateY(-8px)} to{opacity:1;transform:translateY(0)} }
        @keyframes ap-fade-up { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }

        .fade-up   { animation: ap-fade-up .4s cubic-bezier(.16,1,.3,1) both; }
        .fade-up-1 { animation: ap-fade-up .4s cubic-bezier(.16,1,.3,1) .06s both; }
        .fade-up-2 { animation: ap-fade-up .4s cubic-bezier(.16,1,.3,1) .12s both; }
        .fade-up-3 { animation: ap-fade-up .4s cubic-bezier(.16,1,.3,1) .18s both; }

        /* ── Forms ── */
        .form-section { margin-bottom:28px; }
        .form-section-title { font-size:11px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.16em;margin-bottom:14px;display:flex;align-items:center;gap:8px; }
        .form-section-title::after { content:'';flex:1;height:1px;background:#f1f5f9; }
        .form-grid-2 { display:grid;grid-template-columns:1fr 1fr;gap:18px; }
        .form-grid-3 { display:grid;grid-template-columns:1fr 1fr 1fr;gap:18px; }
        .form-group { display:flex;flex-direction:column; }
        .form-label { font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:.12em;margin-bottom:7px; }
        .form-label span { color:#ef4444;margin-left:2px; }
        .form-input { width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:13px;font-family:inherit;color:#1e293b;background:#fff;transition:border-color .15s,box-shadow .15s;outline:none; }
        .form-input:focus { border-color:#6366f1;box-shadow:0 0 0 3px rgba(99,102,241,.1); }
        .form-input::placeholder { color:#c1cad8; }
        .form-textarea { resize:vertical;min-height:110px;line-height:1.6; }
        .form-select { appearance:none;cursor:pointer;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 14px center;padding-right:36px; }
        .form-hint { font-size:11px;color:#94a3b8;margin-top:5px;line-height:1.4; }
        .form-error-msg { font-size:11px;color:#ef4444;margin-top:5px; }
        .form-check { display:flex;align-items:center;gap:9px;cursor:pointer;user-select:none; }
        .form-check input[type=checkbox] { width:17px;height:17px;border-radius:5px;border:1.5px solid #e2e8f0;cursor:pointer;accent-color:#6366f1; }
        .form-check-label { font-size:13px;font-weight:600;color:#475569; }
        .btn-primary { display:inline-flex;align-items:center;gap:7px;padding:10px 22px;border-radius:11px;font-size:13px;font-weight:700;color:#fff;border:none;cursor:pointer;transition:all .18s;text-decoration:none; }
        .btn-primary:hover { transform:translateY(-1px);filter:brightness(1.08); }
        .btn-cancel { display:inline-flex;align-items:center;gap:7px;padding:10px 18px;border-radius:11px;font-size:13px;font-weight:600;color:#64748b;border:1.5px solid #e2e8f0;background:#fff;cursor:pointer;text-decoration:none;transition:all .15s; }
        .btn-cancel:hover { background:#f8fafc;border-color:#cbd5e1;color:#475569; }
        .btn-danger { display:inline-flex;align-items:center;gap:6px;padding:7px 14px;border-radius:9px;font-size:12px;font-weight:700;color:#ef4444;border:1.5px solid #fecaca;background:#fff5f5;cursor:pointer;transition:all .15s; }
        .btn-danger:hover { background:linear-gradient(135deg,#ef4444,#dc2626);color:#fff;border-color:transparent; }
        .img-preview { width:80px;height:80px;border-radius:12px;object-fit:cover;border:1.5px solid #e2e8f0; }

        /* ── Mobile ── */
        #mob-overlay { display: none; }
        #mob-overlay.open { display: block; }
        @media (max-width: 1023px) {
            .sidebar { position: fixed; left: 0; top: 0; z-index: 50; transform: translateX(-100%); transition: transform .3s cubic-bezier(.16,1,.3,1); }
            .sidebar.open { transform: translateX(0); }
            .form-grid-2, .form-grid-3 { grid-template-columns:1fr; }
        }
    </style>
</head>
<body>

@php
    $pendingPrompts  = \App\Models\Prompt::where('status','pending')->count();
    $pendingReports  = \App\Models\Report::where('status','pending')->count();
$totalAlerts     = $pendingPrompts + $pendingReports;

    $navGroups = [
        [
            'label' => 'Workspace',
            'items' => [
                ['route'=>'admin.dashboard','activePattern'=>'admin.dashboard','label'=>'Dashboard','badge'=>0,'color'=>'#818cf8','activeBg'=>'rgba(99,102,241,.18)','iconGrad'=>'linear-gradient(135deg,#4f46e5,#7c3aed)','icon'=>'<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>'],
                ['route'=>'admin.analytics','activePattern'=>'admin.analytics','label'=>'Analytics','badge'=>0,'color'=>'#fbbf24','activeBg'=>'rgba(245,158,11,.14)','iconGrad'=>'linear-gradient(135deg,#d97706,#b45309)','icon'=>'<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>'],
            ],
        ],
        [
            'label' => 'Marketplace',
            'items' => [
                ['route'=>'admin.users','activePattern'=>'admin.users*','label'=>'Users','badge'=>0,'color'=>'#38bdf8','activeBg'=>'rgba(56,189,248,.14)','iconGrad'=>'linear-gradient(135deg,#0284c7,#0891b2)','icon'=>'<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>'],
                ['route'=>'admin.prompts','activePattern'=>'admin.prompts*','label'=>'Prompts','badge'=>$pendingPrompts,'color'=>'#c084fc','activeBg'=>'rgba(168,85,247,.15)','iconGrad'=>'linear-gradient(135deg,#9333ea,#7e22ce)','icon'=>'<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>'],
                ['route'=>'admin.payments','activePattern'=>'admin.payments*','label'=>'Payments','badge'=>0,'color'=>'#34d399','activeBg'=>'rgba(16,185,129,.13)','iconGrad'=>'linear-gradient(135deg,#059669,#047857)','icon'=>'<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>'],
                ['route'=>'admin.reports','activePattern'=>'admin.reports*','label'=>'Reports','badge'=>$pendingReports,'color'=>'#fb7185','activeBg'=>'rgba(244,63,94,.14)','iconGrad'=>'linear-gradient(135deg,#e11d48,#be123c)','icon'=>'<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>'],
            ],
        ],
    ];
@endphp

<div class="admin-shell">

    {{-- Mobile overlay --}}
    <div id="mob-overlay" class="fixed inset-0 z-40 lg:hidden" style="background:rgba(0,0,0,.55)" onclick="closeSidebar()"></div>

    {{-- ══════════════════════════════ SIDEBAR ══════════════════════════════ --}}
    <aside id="sidebar" class="sidebar thin-scroll">

        {{-- Brand --}}
        <div class="sb-brand">
            <div class="sb-logo">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                </svg>
            </div>
            <div style="flex:1;min-width:0">
                <div class="sb-appname">PromptHub</div>
                <div class="sb-status">
                    <span class="sb-dot"></span>
                    <span class="sb-tag">Admin Panel</span>
                </div>
            </div>
            <button onclick="closeSidebar()" class="lg:hidden sb-logout" style="color:rgba(255,255,255,.35)">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Nav --}}
        <nav class="sb-nav thin-scroll">
            @foreach($navGroups as $group)
                <p class="sb-section">{{ $group['label'] }}</p>
                @foreach($group['items'] as $item)
                    @php
                        $isActive = isset($item['activePattern'])
                            ? Request::routeIs($item['activePattern'])
                            : Route::currentRouteName() === $item['route'];
                    @endphp
                    <a href="{{ route($item['route']) }}"
                       class="sb-item {{ $isActive ? 'sb-active' : '' }}"
                       style="{{ $isActive ? 'background:'.$item['activeBg'].';border-color:rgba(255,255,255,.07)' : '' }}">

                        <div class="sb-icon"
                             style="{{ $isActive ? 'background:'.$item['iconGrad'].';box-shadow:0 4px 14px rgba(0,0,0,.28)' : 'background:rgba(255,255,255,.06)' }};
                                    color:{{ $isActive ? '#fff' : 'rgba(148,163,184,.5)' }}">
                            {!! $item['icon'] !!}
                        </div>

                        <span class="sb-label" style="color:{{ $isActive ? '#fff' : 'rgba(148,163,184,.6)' }};font-weight:{{ $isActive ? 600 : 500 }}">
                            {{ $item['label'] }}
                        </span>

                        @if($item['badge'] > 0)
                            <span class="sb-badge">{{ $item['badge'] > 99 ? '99+' : $item['badge'] }}</span>
                        @elseif($isActive)
                            <span class="sb-activedot" style="background:{{ $item['color'] }};box-shadow:0 0 8px {{ $item['color'] }}"></span>
                        @endif
                    </a>
                @endforeach
            @endforeach
        </nav>

        {{-- User footer --}}
        <div class="sb-footer">
            <div class="sb-user">
                <div class="sb-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    <span class="sb-avatar-ring"></span>
                </div>
                <div style="flex:1;min-width:0">
                    <div class="sb-uname truncate">{{ auth()->user()->name }}</div>
                    <div class="sb-urole">Super Administrator</div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" title="Sign out" class="sb-logout">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

    </aside>

    {{-- ══════════════════════════════ MAIN ══════════════════════════════ --}}
    <div class="main-wrap">

        {{-- Top bar --}}
        <header class="topbar">
            <button onclick="openSidebar()" class="tb-ham lg:hidden">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                </svg>
            </button>

            <div class="tb-bc">
                <div class="tb-bar"></div>
                <span class="tb-title">@yield('title','Dashboard')</span>
                <span class="tb-sep hidden sm:inline">›</span>
                <span class="tb-sub hidden sm:inline">@yield('subtitle','Overview')</span>
            </div>

            <div class="tb-spacer"></div>

            <div style="display:flex;align-items:center;gap:8px;flex-shrink:0">
                <div class="tb-date hidden md:flex">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                    </svg>
                    {{ now()->format('D, M j Y') }}
                </div>

                @if($totalAlerts > 0)
                    <div class="tb-bell">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                        </svg>
                        <span class="tb-bellcount">{{ min($totalAlerts, 99) }}</span>
                    </div>
                @endif

                <a href="{{ route('home') }}" target="_blank" class="tb-viewsite hidden sm:inline-flex">
                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                    </svg>
                    View Site
                </a>
            </div>
        </header>

        {{-- Flash messages --}}
        @if(session('status'))
            <div class="flash flash-ok" id="flash-ok">
                <div class="flash-icon" style="background:linear-gradient(135deg,#10b981,#059669)">
                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                </div>
                <span style="font-size:13px;font-weight:600;color:#065f46;flex:1">{{ session('status') }}</span>
                <button class="flash-dismiss" onclick="this.parentElement.remove()" style="color:#6ee7b7">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        @endif
        @if(session('error'))
            <div class="flash flash-err" id="flash-err">
                <div class="flash-icon" style="background:linear-gradient(135deg,#ef4444,#dc2626)">
                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </div>
                <span style="font-size:13px;font-weight:600;color:#991b1b;flex:1">{{ session('error') }}</span>
                <button class="flash-dismiss" onclick="this.parentElement.remove()" style="color:#fca5a5">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        @endif

        {{-- Page content --}}
        <main class="page-content">
            @yield('content')
        </main>

    </div>
</div>

<script>
function openSidebar() {
    document.getElementById('sidebar').classList.add('open');
    document.getElementById('mob-overlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeSidebar() {
    document.getElementById('sidebar').classList.remove('open');
    document.getElementById('mob-overlay').classList.remove('open');
    document.body.style.overflow = '';
}
setTimeout(() => {
    ['flash-ok','flash-err'].forEach(id => {
        const el = document.getElementById(id);
        if (!el) return;
        el.style.opacity = '0'; el.style.transform = 'translateY(-6px)';
        setTimeout(() => el.remove(), 320);
    });
}, 4500);
</script>

</body>
</html>
