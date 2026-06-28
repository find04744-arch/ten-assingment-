@extends('layouts.admin')
@section('title', 'Dashboard')
@section('subtitle', 'Platform overview')

@section('content')
@php
    $totalUsers     = $stats['total_users']     ?? 0;
    $totalPrompts   = $stats['total_prompts']   ?? 0;
    $totalRevenue   = $stats['total_revenue']   ?? 0;
    $pendingPrompts = $stats['pending_prompts'] ?? 0;
    $pendingReports = $stats['pending_reports'] ?? 0;
    $totalIssues    = $pendingPrompts + $pendingReports;

    $hour     = now()->hour;
    $greeting = $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening');

    $recentUsers   = \App\Models\User::latest()->take(5)->get();
    $recentPrompts = \App\Models\Prompt::with('user')->latest()->take(5)->get();
@endphp

<style>
    /* ── Dashboard extras ── */
    .kpi-premium {
        position: relative;
        border-radius: 22px;
        overflow: hidden;
        transition: transform .22s cubic-bezier(.16,1,.3,1), box-shadow .22s ease;
        cursor: default;
    }
    .kpi-premium:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 48px rgba(0,0,0,.12) !important;
    }
    .kpi-premium .kpi-glow {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        opacity: 0;
        transition: opacity .3s;
    }
    .kpi-premium:hover .kpi-glow { opacity: 1; }

    .grad-text-purple  { background: linear-gradient(135deg,#4f46e5,#7c3aed); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
    .grad-text-violet  { background: linear-gradient(135deg,#9333ea,#7e22ce); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
    .grad-text-emerald { background: linear-gradient(135deg,#059669,#047857); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
    .grad-text-amber   { background: linear-gradient(135deg,#d97706,#b45309); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
    .grad-text-rose    { background: linear-gradient(135deg,#e11d48,#be123c);  -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }

    .panel-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #e8ecf2;
        box-shadow: 0 4px 20px rgba(0,0,0,.05);
        overflow: hidden;
    }
    .panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 22px;
        border-bottom: 1px solid #f0f3f8;
    }
    .panel-row {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 11px 22px;
        border-bottom: 1px solid #f7f9fc;
        transition: background .12s;
    }
    .panel-row:hover { background: #f7f9ff; }
    .panel-row:last-child { border-bottom: none; }

    .qa-card {
        display: flex;
        flex-direction: column;
        gap: 14px;
        padding: 22px;
        border-radius: 20px;
        border: 1px solid #e8ecf2;
        background: #fff;
        text-decoration: none;
        transition: transform .22s cubic-bezier(.16,1,.3,1), box-shadow .22s ease, border-color .2s;
        position: relative;
        overflow: hidden;
    }
    .qa-card::before {
        content: '';
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity .2s;
    }
    .qa-card:hover { transform: translateY(-3px); box-shadow: 0 16px 40px rgba(0,0,0,.09); }
</style>

{{-- ══════ Hero Banner ══════ --}}
<div class="fade-up" style="position:relative;overflow:hidden;border-radius:24px;margin-bottom:28px;background:linear-gradient(135deg,#060d1e 0%,#120838 30%,#1c0d56 58%,#260f78 80%,#300c96 100%);min-height:180px">

    {{-- Dot-grid texture overlay --}}
    <div style="position:absolute;inset:0;pointer-events:none;background-image:radial-gradient(rgba(255,255,255,.04) 1px,transparent 1px);background-size:28px 28px"></div>

    {{-- Glow blobs --}}
    <div style="position:absolute;top:-80px;right:-40px;width:340px;height:340px;border-radius:50%;background:radial-gradient(circle,rgba(139,92,246,.2) 0%,transparent 65%);pointer-events:none"></div>
    <div style="position:absolute;top:30px;right:260px;width:150px;height:150px;border-radius:50%;background:rgba(99,102,241,.12);pointer-events:none;filter:blur(2px)"></div>
    <div style="position:absolute;bottom:-100px;left:40%;width:380px;height:380px;border-radius:50%;background:rgba(99,102,241,.07);pointer-events:none"></div>
    <div style="position:absolute;bottom:-40px;left:-40px;width:200px;height:200px;border-radius:50%;background:rgba(139,92,246,.1);pointer-events:none"></div>

    {{-- Decorative ring --}}
    <div style="position:absolute;top:-60px;right:100px;width:240px;height:240px;border-radius:50%;border:1px solid rgba(255,255,255,.04);pointer-events:none"></div>
    <div style="position:absolute;top:-30px;right:130px;width:180px;height:180px;border-radius:50%;border:1px solid rgba(255,255,255,.03);pointer-events:none"></div>

    <div style="position:relative;padding:28px 32px 26px">

        {{-- Top row: date badge + action buttons --}}
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px">
            <div style="display:inline-flex;align-items:center;gap:7px;padding:5px 13px;border-radius:99px;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);backdrop-filter:blur(6px)">
                <span style="width:6px;height:6px;border-radius:50%;background:#34d399;flex-shrink:0;animation:ap-pulse 2.5s ease infinite"></span>
                <span style="font-size:11px;font-weight:600;color:rgba(199,210,254,.85);letter-spacing:.05em">{{ now()->format('l, F j Y') }}</span>
                <span style="width:1px;height:10px;background:rgba(255,255,255,.15)"></span>
                <span style="font-size:11px;font-weight:600;color:rgba(199,210,254,.55)">{{ now()->format('H:i') }}</span>
            </div>

            <div style="display:flex;gap:8px;flex-shrink:0">
                <a href="{{ route('admin.prompts') }}"
                   style="display:inline-flex;align-items:center;gap:6px;padding:8px 15px;border-radius:10px;font-size:12px;font-weight:700;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.14);color:#e0e7ff;text-decoration:none;transition:all .18s;backdrop-filter:blur(6px)"
                   onmouseover="this.style.background='rgba(255,255,255,.18)'" onmouseout="this.style.background='rgba(255,255,255,.1)'">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Review Prompts
                    @if($pendingPrompts > 0)
                        <span style="padding:1px 6px;border-radius:99px;font-size:9.5px;font-weight:800;background:rgba(251,113,133,.3);color:#fda4af">{{ $pendingPrompts }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.analytics') }}"
                   style="display:inline-flex;align-items:center;gap:6px;padding:8px 15px;border-radius:10px;font-size:12px;font-weight:700;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.14);color:#e0e7ff;text-decoration:none;transition:all .18s;backdrop-filter:blur(6px)"
                   onmouseover="this.style.background='rgba(255,255,255,.18)'" onmouseout="this.style.background='rgba(255,255,255,.1)'">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                    Analytics
                </a>
            </div>
        </div>

        {{-- Main content row: greeting + mini stats --}}
        <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:24px">
            <div>
                <h1 style="font-size:clamp(1.6rem,3vw,2.1rem);font-weight:900;color:#fff;line-height:1.1;letter-spacing:-.6px">
                    {{ $greeting }},<br>
                    <span style="background:linear-gradient(90deg,#a78bfa,#818cf8,#c4b5fd);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">{{ auth()->user()->name }}</span>
                </h1>
                <p style="margin-top:10px;font-size:13px;color:rgba(196,181,253,.5);display:flex;align-items:center;gap:6px">
                    @if($totalIssues > 0)
                        <span style="display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:99px;background:rgba(251,113,133,.15);border:1px solid rgba(251,113,133,.25);color:#fda4af;font-weight:700;font-size:12px">
                            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9.303 3.376c.866 1.5-.217 3.374-1.948 3.374H4.645c-1.73 0-2.813-1.874-1.948-3.374L10.053 3.378c.866-1.5 3.032-1.5 3.898 0l5.352 9.748zM12 15.75h.007v.008H12v-.008z"/></svg>
                            {{ $totalIssues }} item{{ $totalIssues > 1 ? 's' : '' }} need attention
                        </span>
                    @else
                        <span style="display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:99px;background:rgba(52,211,153,.12);border:1px solid rgba(52,211,153,.22);color:#6ee7b7;font-weight:700;font-size:12px">
                            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Everything looks great
                        </span>
                    @endif
                </p>
            </div>

            {{-- Mini stats strip --}}
            <div style="display:flex;gap:2px;flex-shrink:0;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:16px;padding:4px;backdrop-filter:blur(8px)">
                <div style="padding:12px 20px;text-align:center;border-radius:12px">
                    <p style="font-size:20px;font-weight:900;color:#fff;letter-spacing:-1px;line-height:1">{{ number_format($totalUsers) }}</p>
                    <p style="font-size:10px;font-weight:600;color:rgba(196,181,253,.5);margin-top:4px;text-transform:uppercase;letter-spacing:.1em">Users</p>
                </div>
                <div style="width:1px;background:rgba(255,255,255,.07);margin:8px 0;align-self:stretch"></div>
                <div style="padding:12px 20px;text-align:center;border-radius:12px">
                    <p style="font-size:20px;font-weight:900;color:#fff;letter-spacing:-1px;line-height:1">{{ number_format($totalPrompts) }}</p>
                    <p style="font-size:10px;font-weight:600;color:rgba(196,181,253,.5);margin-top:4px;text-transform:uppercase;letter-spacing:.1em">Prompts</p>
                </div>
                <div style="width:1px;background:rgba(255,255,255,.07);margin:8px 0;align-self:stretch"></div>
                <div style="padding:12px 20px;text-align:center;border-radius:12px">
                    <p style="font-size:20px;font-weight:900;color:#34d399;letter-spacing:-1px;line-height:1">${{ number_format($totalRevenue, 0) }}</p>
                    <p style="font-size:10px;font-weight:600;color:rgba(196,181,253,.5);margin-top:4px;text-transform:uppercase;letter-spacing:.1em">Revenue</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ══════ KPI Cards — forced single row via inline CSS grid ══════ --}}
<div class="fade-up-1" style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-bottom:28px;align-items:stretch">

    {{-- ── Registered Accounts ── --}}
    <div class="kpi-premium" style="background:linear-gradient(145deg,#fafbff,#f0f2fe);border:1px solid rgba(99,102,241,.18);box-shadow:0 4px 24px rgba(99,102,241,.09),0 1px 3px rgba(0,0,0,.04)">
        <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,#4f46e5,#7c3aed,#a855f7)"></div>
        <div style="position:absolute;bottom:-24px;right:-24px;width:110px;height:110px;border-radius:50%;background:radial-gradient(circle,rgba(99,102,241,.13),transparent 70%);pointer-events:none"></div>
        <div style="padding:26px 24px 22px;display:flex;flex-direction:column;height:100%;box-sizing:border-box">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:20px">
                <div style="width:52px;height:52px;border-radius:16px;background:linear-gradient(135deg,#4f46e5,#7c3aed);display:flex;align-items:center;justify-content:center;box-shadow:0 8px 24px rgba(79,70,229,.38);flex-shrink:0">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                </div>
                <span style="font-size:9px;font-weight:800;letter-spacing:.18em;text-transform:uppercase;padding:4px 10px;border-radius:7px;background:rgba(99,102,241,.1);color:#6366f1;flex-shrink:0">Users</span>
            </div>
            <p style="font-size:2.5rem;font-weight:900;letter-spacing:-2px;line-height:1;background:linear-gradient(135deg,#4f46e5,#7c3aed);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">{{ number_format($totalUsers) }}</p>
            <p style="font-size:13px;color:#64748b;margin-top:10px;font-weight:500">Registered accounts</p>
        </div>
    </div>

    {{-- ── All Submissions ── --}}
    <div class="kpi-premium" style="background:linear-gradient(145deg,#fef8ff,#f5effe);border:1px solid rgba(147,51,234,.18);box-shadow:0 4px 24px rgba(147,51,234,.09),0 1px 3px rgba(0,0,0,.04)">
        <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,#9333ea,#7e22ce,#6b21a8)"></div>
        <div style="position:absolute;bottom:-24px;right:-24px;width:110px;height:110px;border-radius:50%;background:radial-gradient(circle,rgba(147,51,234,.12),transparent 70%);pointer-events:none"></div>
        <div style="padding:26px 24px 22px;display:flex;flex-direction:column;height:100%;box-sizing:border-box">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:20px">
                <div style="width:52px;height:52px;border-radius:16px;background:linear-gradient(135deg,#9333ea,#7e22ce);display:flex;align-items:center;justify-content:center;box-shadow:0 8px 24px rgba(147,51,234,.38);flex-shrink:0">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                </div>
                <span style="font-size:9px;font-weight:800;letter-spacing:.18em;text-transform:uppercase;padding:4px 10px;border-radius:7px;background:rgba(147,51,234,.1);color:#9333ea;flex-shrink:0">Prompts</span>
            </div>
            <p style="font-size:2.5rem;font-weight:900;letter-spacing:-2px;line-height:1;background:linear-gradient(135deg,#9333ea,#7e22ce);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">{{ number_format($totalPrompts) }}</p>
            @if($pendingPrompts > 0)
                <p style="font-size:13px;margin-top:10px;font-weight:700;color:#d97706">{{ $pendingPrompts }} pending review</p>
            @else
                <p style="font-size:13px;color:#64748b;margin-top:10px;font-weight:500">All submissions</p>
            @endif
        </div>
    </div>

    {{-- ── Total Earnings ── --}}
    <div class="kpi-premium" style="background:linear-gradient(145deg,#f0fdf8,#e5f9f1);border:1px solid rgba(5,150,105,.18);box-shadow:0 4px 24px rgba(5,150,105,.09),0 1px 3px rgba(0,0,0,.04)">
        <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,#059669,#047857,#065f46)"></div>
        <div style="position:absolute;bottom:-24px;right:-24px;width:110px;height:110px;border-radius:50%;background:radial-gradient(circle,rgba(5,150,105,.11),transparent 70%);pointer-events:none"></div>
        <div style="padding:26px 24px 22px;display:flex;flex-direction:column;height:100%;box-sizing:border-box">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:20px">
                <div style="width:52px;height:52px;border-radius:16px;background:linear-gradient(135deg,#059669,#047857);display:flex;align-items:center;justify-content:center;box-shadow:0 8px 24px rgba(5,150,105,.38);flex-shrink:0">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <span style="font-size:9px;font-weight:800;letter-spacing:.18em;text-transform:uppercase;padding:4px 10px;border-radius:7px;background:rgba(5,150,105,.1);color:#059669;flex-shrink:0">Revenue</span>
            </div>
            <p style="font-size:2.5rem;font-weight:900;letter-spacing:-2px;line-height:1;background:linear-gradient(135deg,#059669,#047857);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">${{ number_format($totalRevenue, 0) }}</p>
            <p style="font-size:13px;color:#64748b;margin-top:10px;font-weight:500">Total earnings</p>
        </div>
    </div>

    {{-- ── System Status ── --}}
    @if($totalIssues > 0)
    <div class="kpi-premium" style="background:linear-gradient(145deg,#fffcf0,#fef6e0);border:1px solid rgba(245,158,11,.25);box-shadow:0 4px 24px rgba(245,158,11,.11),0 1px 3px rgba(0,0,0,.04)">
        <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,#f59e0b,#d97706,#b45309)"></div>
        <div style="position:absolute;bottom:-24px;right:-24px;width:110px;height:110px;border-radius:50%;background:radial-gradient(circle,rgba(245,158,11,.14),transparent 70%);pointer-events:none"></div>
        <div style="padding:26px 24px 22px;display:flex;flex-direction:column;height:100%;box-sizing:border-box">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:20px">
                <div style="width:52px;height:52px;border-radius:16px;background:linear-gradient(135deg,#f59e0b,#d97706);display:flex;align-items:center;justify-content:center;box-shadow:0 8px 24px rgba(245,158,11,.38);flex-shrink:0">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                </div>
                <span style="font-size:9px;font-weight:800;letter-spacing:.18em;text-transform:uppercase;padding:4px 10px;border-radius:7px;background:rgba(245,158,11,.12);color:#d97706;flex-shrink:0">Issues</span>
            </div>
            <p style="font-size:2.5rem;font-weight:900;letter-spacing:-2px;line-height:1;background:linear-gradient(135deg,#d97706,#b45309);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">{{ $totalIssues }}</p>
            <p style="font-size:13px;margin-top:10px;font-weight:700;color:#92400e">Need your attention</p>
        </div>
    </div>
    @else
    <div class="kpi-premium" style="background:linear-gradient(145deg,#f0fdf9,#e4f9f3);border:1px solid rgba(16,185,129,.18);box-shadow:0 4px 24px rgba(16,185,129,.09),0 1px 3px rgba(0,0,0,.04)">
        <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,#10b981,#059669,#047857)"></div>
        <div style="position:absolute;bottom:-24px;right:-24px;width:110px;height:110px;border-radius:50%;background:radial-gradient(circle,rgba(16,185,129,.11),transparent 70%);pointer-events:none"></div>
        <div style="padding:26px 24px 22px;display:flex;flex-direction:column;height:100%;box-sizing:border-box">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:20px">
                <div style="width:52px;height:52px;border-radius:16px;background:linear-gradient(135deg,#10b981,#059669);display:flex;align-items:center;justify-content:center;box-shadow:0 8px 24px rgba(16,185,129,.38);flex-shrink:0">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <span style="font-size:9px;font-weight:800;letter-spacing:.18em;text-transform:uppercase;padding:4px 10px;border-radius:7px;background:rgba(16,185,129,.1);color:#059669;flex-shrink:0">Status</span>
            </div>
            <p style="font-size:2.5rem;font-weight:900;letter-spacing:-2px;line-height:1;background:linear-gradient(135deg,#10b981,#059669);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">0</p>
            <p style="font-size:13px;color:#059669;margin-top:10px;font-weight:600">All systems clear</p>
        </div>
    </div>
    @endif

</div>

{{-- ══════ Alert Banner ══════ --}}
@if($totalIssues > 0)
<div class="flex items-center gap-4 px-6 py-4 rounded-2xl mb-7 fade-up-1"
     style="background:linear-gradient(135deg,#fffbeb,#fef3c7);border:1px solid #fde68a;box-shadow:0 4px 16px rgba(245,158,11,.12)">
    <div style="width:36px;height:36px;border-radius:12px;background:linear-gradient(135deg,#f59e0b,#d97706);display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 4px 12px rgba(245,158,11,.35)">
        <span style="animation:ap-pulse 2.5s ease infinite;display:flex">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
        </span>
    </div>
    <p style="font-size:13.5px;font-weight:600;color:#92400e;flex:1;letter-spacing:-.1px">
        @if($pendingPrompts > 0) <strong>{{ $pendingPrompts }}</strong> prompt{{ $pendingPrompts > 1 ? 's' : '' }} awaiting review @endif
        @if($pendingPrompts > 0 && $pendingReports > 0) &nbsp;·&nbsp; @endif
        @if($pendingReports > 0) <strong>{{ $pendingReports }}</strong> report{{ $pendingReports > 1 ? 's' : '' }} pending moderation @endif
    </p>
    <div style="display:flex;gap:8px;flex-shrink:0">
        @if($pendingPrompts > 0)
            <a href="{{ route('admin.prompts') }}" class="act-btn" style="color:#92400e;border-color:#fcd34d;background:rgba(255,255,255,.7)">Review Prompts</a>
        @endif
        @if($pendingReports > 0)
            <a href="{{ route('admin.reports') }}" class="act-btn" style="color:#991b1b;border-color:#fca5a5;background:rgba(255,255,255,.7)">View Reports</a>
        @endif
    </div>
</div>
@endif

{{-- ══════ Activity Grid ══════ --}}
<div class="fade-up-2" style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px">

    {{-- ── Recent Prompts ── --}}
    <div style="border-radius:22px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.07);border:1px solid #e8ecf4">
        {{-- Gradient header --}}
        <div style="background:linear-gradient(135deg,#2e1065,#4a1d96,#6b21a8);padding:18px 22px;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden">
            <div style="position:absolute;top:-30px;right:-20px;width:120px;height:120px;border-radius:50%;background:rgba(255,255,255,.05);pointer-events:none"></div>
            <div style="position:absolute;bottom:-40px;left:30%;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.04);pointer-events:none"></div>
            <div style="display:flex;align-items:center;gap:11px;position:relative">
                <div style="width:36px;height:36px;border-radius:11px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;backdrop-filter:blur(4px)">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                </div>
                <div>
                    <p style="font-size:14px;font-weight:700;color:#fff;letter-spacing:-.2px">Recent Prompts</p>
                    <p style="font-size:11px;color:rgba(221,214,254,.6);margin-top:1px">Latest submissions</p>
                </div>
            </div>
            <a href="{{ route('admin.prompts') }}" style="position:relative;display:inline-flex;align-items:center;gap:5px;font-size:11.5px;font-weight:700;color:rgba(221,214,254,.9);text-decoration:none;padding:6px 12px;border-radius:8px;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.18);transition:all .15s"
               onmouseover="this.style.background='rgba(255,255,255,.22)'" onmouseout="this.style.background='rgba(255,255,255,.12)'">
                View all
                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
            </a>
        </div>

        {{-- Rows --}}
        <div style="background:#fff">
            @forelse($recentPrompts as $i => $prompt)
                @php
                    $sc = [
                        'approved' => ['dot'=>'#10b981','bg'=>'rgba(220,252,231,.7)','c'=>'#065f46','label'=>'Approved'],
                        'pending'  => ['dot'=>'#f59e0b','bg'=>'rgba(254,243,199,.8)','c'=>'#92400e','label'=>'Pending'],
                        'rejected' => ['dot'=>'#ef4444','bg'=>'rgba(254,226,226,.8)','c'=>'#991b1b','label'=>'Rejected'],
                    ][$prompt->status] ?? ['dot'=>'#94a3b8','bg'=>'rgba(241,245,249,.8)','c'=>'#64748b','label'=>ucfirst($prompt->status)];
                @endphp
                <div style="display:flex;align-items:center;gap:13px;padding:13px 22px;border-bottom:1px solid #f1f5fb;transition:background .12s" onmouseover="this.style.background='#f8f9ff'" onmouseout="this.style.background='transparent'">
                    <span style="font-size:10px;font-weight:800;color:#cbd5e1;width:16px;flex-shrink:0;text-align:center">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <div style="width:38px;height:38px;border-radius:12px;background:linear-gradient(135deg,#7c3aed,#9333ea);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;font-weight:800;flex-shrink:0;box-shadow:0 4px 12px rgba(147,51,234,.28)">
                        {{ strtoupper(substr($prompt->user->name ?? 'U', 0, 1)) }}
                    </div>
                    <div style="flex:1;min-width:0">
                        <p style="font-size:13px;font-weight:600;color:#1e293b;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;letter-spacing:-.1px">{{ $prompt->title }}</p>
                        <p style="font-size:11px;color:#94a3b8;margin-top:2px">by <span style="color:#6366f1;font-weight:600">{{ $prompt->user->name ?? '—' }}</span> · {{ $prompt->created_at?->diffForHumans() }}</p>
                    </div>
                    <span style="display:inline-flex;align-items:center;gap:5px;font-size:10.5px;font-weight:700;padding:4px 10px;border-radius:99px;background:{{ $sc['bg'] }};color:{{ $sc['c'] }};flex-shrink:0;white-space:nowrap">
                        <span style="width:5px;height:5px;border-radius:50%;background:{{ $sc['dot'] }};flex-shrink:0"></span>
                        {{ $sc['label'] }}
                    </span>
                </div>
            @empty
                <div style="padding:52px 0;text-align:center;background:#fff">
                    <div style="width:56px;height:56px;border-radius:18px;background:linear-gradient(135deg,#f8f0ff,#ede9fe);display:flex;align-items:center;justify-content:center;margin:0 auto 14px;box-shadow:0 4px 14px rgba(147,51,234,.1)">
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#9333ea" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                    </div>
                    <p style="font-size:14px;font-weight:600;color:#1e293b;margin-bottom:4px">No prompts yet</p>
                    <p style="font-size:12px;color:#94a3b8">Submissions will appear here</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- ── New Members ── --}}
    <div style="border-radius:22px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.07);border:1px solid #e8ecf4">
        {{-- Gradient header --}}
        <div style="background:linear-gradient(135deg,#0c2447,#1d4e89,#0369a1);padding:18px 22px;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden">
            <div style="position:absolute;top:-30px;right:-20px;width:120px;height:120px;border-radius:50%;background:rgba(255,255,255,.05);pointer-events:none"></div>
            <div style="position:absolute;bottom:-40px;left:30%;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.04);pointer-events:none"></div>
            <div style="display:flex;align-items:center;gap:11px;position:relative">
                <div style="width:36px;height:36px;border-radius:11px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;backdrop-filter:blur(4px)">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                </div>
                <div>
                    <p style="font-size:14px;font-weight:700;color:#fff;letter-spacing:-.2px">New Members</p>
                    <p style="font-size:11px;color:rgba(186,230,253,.6);margin-top:1px">Recently joined</p>
                </div>
            </div>
            <a href="{{ route('admin.users') }}" style="position:relative;display:inline-flex;align-items:center;gap:5px;font-size:11.5px;font-weight:700;color:rgba(186,230,253,.9);text-decoration:none;padding:6px 12px;border-radius:8px;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.18);transition:all .15s"
               onmouseover="this.style.background='rgba(255,255,255,.22)'" onmouseout="this.style.background='rgba(255,255,255,.12)'">
                View all
                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
            </a>
        </div>

        {{-- Rows --}}
        <div style="background:#fff">
            @forelse($recentUsers as $user)
                <div style="display:flex;align-items:center;gap:13px;padding:13px 22px;border-bottom:1px solid #f1f5fb;transition:background .12s" onmouseover="this.style.background='#f7fbff'" onmouseout="this.style.background='transparent'">
                    <span style="font-size:10px;font-weight:800;color:#cbd5e1;width:16px;flex-shrink:0;text-align:center">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <div style="position:relative;flex-shrink:0">
                        <div style="width:38px;height:38px;border-radius:12px;background:linear-gradient(135deg,#0284c7,#0891b2);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;font-weight:800;box-shadow:0 4px 12px rgba(2,132,199,.28)">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <span style="position:absolute;bottom:-2px;right:-2px;width:10px;height:10px;border-radius:50%;background:#34d399;border:2px solid #fff"></span>
                    </div>
                    <div style="flex:1;min-width:0">
                        <p style="font-size:13px;font-weight:600;color:#1e293b;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;letter-spacing:-.1px">{{ $user->name }}</p>
                        <p style="font-size:11px;color:#94a3b8;margin-top:2px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $user->email }}</p>
                    </div>
                    <span style="font-size:11px;color:#64748b;flex-shrink:0;padding:4px 10px;border-radius:8px;background:#f1f5f9;border:1px solid #e2e8f0;font-weight:500;white-space:nowrap">{{ $user->created_at?->diffForHumans() }}</span>
                </div>
            @empty
                <div style="padding:52px 0;text-align:center;background:#fff">
                    <div style="width:56px;height:56px;border-radius:18px;background:linear-gradient(135deg,#eff6ff,#dbeafe);display:flex;align-items:center;justify-content:center;margin:0 auto 14px;box-shadow:0 4px 14px rgba(2,132,199,.1)">
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#0284c7" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                    </div>
                    <p style="font-size:14px;font-weight:600;color:#1e293b;margin-bottom:4px">No members yet</p>
                    <p style="font-size:12px;color:#94a3b8">New users will appear here</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

{{-- ══════ Quick Actions ══════ --}}
<div class="fade-up-3">
    {{-- Section label --}}
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:18px">
        <div style="width:3px;height:16px;border-radius:99px;background:linear-gradient(180deg,#6366f1,#a855f7)"></div>
        <p style="font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:.2em">Quick Actions</p>
        <div style="height:1px;flex:1;background:linear-gradient(90deg,#e2e8f0,transparent)"></div>
    </div>

    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px">
        @foreach([
            [
                'route'   => 'admin.users',
                'label'   => 'Manage Users',
                'sub'     => 'Accounts & roles',
                'grad'    => 'linear-gradient(135deg,#4f46e5,#7c3aed)',
                'hgrad'   => 'linear-gradient(135deg,#4338ca,#6d28d9)',
                'shadow'  => 'rgba(79,70,229,.3)',
                'accent'  => '#6366f1',
                'bgLight' => 'linear-gradient(145deg,#fafafe,#f0f0fd)',
                'border'  => 'rgba(99,102,241,.2)',
                'icon'    => '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>',
            ],
            [
                'route'   => 'admin.prompts',
                'label'   => 'Review Prompts',
                'sub'     => 'Approve & feature',
                'grad'    => 'linear-gradient(135deg,#9333ea,#7e22ce)',
                'hgrad'   => 'linear-gradient(135deg,#7e22ce,#6b21a8)',
                'shadow'  => 'rgba(147,51,234,.3)',
                'accent'  => '#9333ea',
                'bgLight' => 'linear-gradient(145deg,#fdf8ff,#f5effe)',
                'border'  => 'rgba(147,51,234,.2)',
                'icon'    => '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>',
            ],
            [
                'route'   => 'admin.payments',
                'label'   => 'Payments',
                'sub'     => 'Revenue tracking',
                'grad'    => 'linear-gradient(135deg,#059669,#047857)',
                'hgrad'   => 'linear-gradient(135deg,#047857,#065f46)',
                'shadow'  => 'rgba(5,150,105,.3)',
                'accent'  => '#059669',
                'bgLight' => 'linear-gradient(145deg,#f0fdf9,#e5f9f1)',
                'border'  => 'rgba(5,150,105,.2)',
                'icon'    => '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>',
            ],
            [
                'route'   => 'admin.analytics',
                'label'   => 'Analytics',
                'sub'     => 'Growth insights',
                'grad'    => 'linear-gradient(135deg,#d97706,#b45309)',
                'hgrad'   => 'linear-gradient(135deg,#b45309,#92400e)',
                'shadow'  => 'rgba(217,119,6,.3)',
                'accent'  => '#d97706',
                'bgLight' => 'linear-gradient(145deg,#fffdf0,#fef6dc)',
                'border'  => 'rgba(217,119,6,.2)',
                'icon'    => '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>',
            ],
        ] as $qa)
        <a href="{{ route($qa['route']) }}"
           style="display:flex;flex-direction:column;text-decoration:none;border-radius:20px;border:1px solid {{ $qa['border'] }};background:{{ $qa['bgLight'] }};overflow:hidden;transition:transform .22s cubic-bezier(.16,1,.3,1),box-shadow .22s ease;box-shadow:0 2px 12px rgba(0,0,0,.05);position:relative"
           onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 18px 40px {{ $qa['shadow'] }}'"
           onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 12px rgba(0,0,0,.05)'">

            {{-- Colored top strip --}}
            <div style="height:3px;background:{{ $qa['grad'] }}"></div>

            <div style="padding:20px 20px 18px;display:flex;flex-direction:column;gap:16px">
                <div style="display:flex;align-items:center;justify-content:space-between">
                    <div style="width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;background:{{ $qa['grad'] }};box-shadow:0 6px 16px {{ $qa['shadow'] }}">
                        {!! $qa['icon'] !!}
                    </div>
                    <div style="width:28px;height:28px;border-radius:8px;background:rgba(0,0,0,.04);display:flex;align-items:center;justify-content:center">
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="{{ $qa['accent'] }}" stroke-width="2.5" style="opacity:.7"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </div>
                </div>
                <div>
                    <p style="font-size:14px;font-weight:700;color:#1e293b;letter-spacing:-.2px">{{ $qa['label'] }}</p>
                    <p style="font-size:12px;color:#94a3b8;margin-top:3px;font-weight:400">{{ $qa['sub'] }}</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>

@endsection
