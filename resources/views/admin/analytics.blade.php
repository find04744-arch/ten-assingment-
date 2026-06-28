@extends('layouts.admin')
@section('title', 'Analytics')
@section('subtitle', 'Growth, revenue & content insights')

@section('content')
@php
    $usersGrowth       = $data['users_growth'];
    $promptsByCategory = $data['prompts_by_category'];
    $revenueData       = $data['revenue_data'];

    $totalUsers        = $usersGrowth->sum('count');
    $totalRevenue      = $revenueData->sum('total');
    $totalTransactions = $revenueData->sum('count');
    $totalPrompts      = $promptsByCategory->sum('count');

    $maxUserCount = $usersGrowth->max('count') ?: 1;
    $maxCatCount  = $promptsByCategory->max('count') ?: 1;
    $maxRevenue   = $revenueData->max('total') ?: 1;

    $revenueGrowthDays = $revenueData->count() ?: 1;
    $avgDailyRevenue   = $totalRevenue / $revenueGrowthDays;
@endphp

{{-- ══ Page Header ══ --}}
<div class="fade-up" style="position:relative;overflow:hidden;border-radius:24px;margin-bottom:28px;background:linear-gradient(135deg,#0e0b2e 0%,#1e1a4a 30%,#3730a3 70%,#4f46e5 100%);min-height:168px">
    <div style="position:absolute;inset:0;pointer-events:none;background-image:radial-gradient(rgba(255,255,255,.04) 1px,transparent 1px);background-size:28px 28px"></div>
    <div style="position:absolute;top:-80px;right:-40px;width:320px;height:320px;border-radius:50%;background:radial-gradient(circle,rgba(139,92,246,.25) 0%,transparent 65%);pointer-events:none"></div>
    <div style="position:absolute;bottom:-90px;left:40%;width:360px;height:360px;border-radius:50%;background:rgba(99,102,241,.08);pointer-events:none"></div>
    <div style="position:absolute;top:-50px;right:120px;width:220px;height:220px;border-radius:50%;border:1px solid rgba(255,255,255,.05);pointer-events:none"></div>

    <div style="position:relative;padding:28px 32px 26px">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px">
            <div style="display:inline-flex;align-items:center;gap:7px;padding:5px 13px;border-radius:99px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);backdrop-filter:blur(6px)">
                <span style="width:6px;height:6px;border-radius:50%;background:#a78bfa;flex-shrink:0;animation:ap-pulse 2.5s ease infinite"></span>
                <span style="font-size:11px;font-weight:700;color:rgba(196,181,253,.85);letter-spacing:.12em;text-transform:uppercase">Live Analytics</span>
            </div>
        </div>

        <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:24px">
            <div>
                <h1 style="font-size:clamp(1.6rem,3vw,2.1rem);font-weight:900;color:#fff;line-height:1.1;letter-spacing:-.5px">
                    Platform Insights
                    <span style="font-size:1rem;font-weight:500;color:rgba(196,181,253,.55)">real-time data</span>
                </h1>
                <p style="margin-top:9px;font-size:13px;color:rgba(196,181,253,.45)">Growth metrics, revenue tracking & content analytics</p>
            </div>

            <div style="display:flex;gap:2px;flex-shrink:0;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:4px;backdrop-filter:blur(8px)">
                <div style="padding:12px 20px;text-align:center;border-radius:12px">
                    <p style="font-size:20px;font-weight:900;color:#a78bfa;letter-spacing:-1px;line-height:1">{{ number_format($totalUsers) }}</p>
                    <p style="font-size:10px;font-weight:600;color:rgba(196,181,253,.5);margin-top:4px;text-transform:uppercase;letter-spacing:.1em">Users</p>
                </div>
                <div style="width:1px;background:rgba(255,255,255,.08);margin:8px 0"></div>
                <div style="padding:12px 20px;text-align:center;border-radius:12px">
                    <p style="font-size:20px;font-weight:900;color:#c4b5fd;letter-spacing:-1px;line-height:1">{{ number_format($totalPrompts) }}</p>
                    <p style="font-size:10px;font-weight:600;color:rgba(196,181,253,.5);margin-top:4px;text-transform:uppercase;letter-spacing:.1em">Prompts</p>
                </div>
                <div style="width:1px;background:rgba(255,255,255,.08);margin:8px 0"></div>
                <div style="padding:12px 20px;text-align:center;border-radius:12px">
                    <p style="font-size:20px;font-weight:900;color:#fff;letter-spacing:-1px;line-height:1">${{ number_format($totalRevenue, 0) }}</p>
                    <p style="font-size:10px;font-weight:600;color:rgba(196,181,253,.5);margin-top:4px;text-transform:uppercase;letter-spacing:.1em">Revenue</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ══ KPI Row ══ --}}
<div class="fade-up-1" style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-bottom:28px;align-items:stretch">

    <div style="position:relative;border-radius:22px;overflow:hidden;background:linear-gradient(145deg,#fafbff,#f0f2fe);border:1px solid rgba(99,102,241,.18);box-shadow:0 4px 24px rgba(99,102,241,.09),0 1px 3px rgba(0,0,0,.04);transition:transform .22s ease,box-shadow .22s ease" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 20px 48px rgba(99,102,241,.15)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 24px rgba(99,102,241,.09)'">
        <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,#4f46e5,#7c3aed)"></div>
        <div style="padding:24px 22px 20px">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:18px">
                <div style="width:50px;height:50px;border-radius:15px;background:linear-gradient(135deg,#4f46e5,#7c3aed);display:flex;align-items:center;justify-content:center;box-shadow:0 8px 22px rgba(79,70,229,.38)">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                </div>
                <span style="font-size:9px;font-weight:800;letter-spacing:.18em;text-transform:uppercase;padding:4px 10px;border-radius:7px;background:rgba(99,102,241,.1);color:#6366f1">Users</span>
            </div>
            <p style="font-size:2.3rem;font-weight:900;letter-spacing:-2px;line-height:1;background:linear-gradient(135deg,#4f46e5,#7c3aed);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">{{ number_format($totalUsers) }}</p>
            <p style="font-size:13px;color:#64748b;margin-top:10px;font-weight:500">across {{ $usersGrowth->count() }} tracked days</p>
        </div>
    </div>

    <div style="position:relative;border-radius:22px;overflow:hidden;background:linear-gradient(145deg,#fdf8ff,#f5f0fe);border:1px solid rgba(147,51,234,.18);box-shadow:0 4px 24px rgba(147,51,234,.09),0 1px 3px rgba(0,0,0,.04);transition:transform .22s ease,box-shadow .22s ease" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 20px 48px rgba(147,51,234,.15)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 24px rgba(147,51,234,.09)'">
        <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,#9333ea,#7e22ce)"></div>
        <div style="padding:24px 22px 20px">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:18px">
                <div style="width:50px;height:50px;border-radius:15px;background:linear-gradient(135deg,#9333ea,#7e22ce);display:flex;align-items:center;justify-content:center;box-shadow:0 8px 22px rgba(147,51,234,.38)">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                </div>
                <span style="font-size:9px;font-weight:800;letter-spacing:.18em;text-transform:uppercase;padding:4px 10px;border-radius:7px;background:rgba(147,51,234,.1);color:#9333ea">Prompts</span>
            </div>
            <p style="font-size:2.3rem;font-weight:900;letter-spacing:-2px;line-height:1;background:linear-gradient(135deg,#9333ea,#7e22ce);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">{{ number_format($totalPrompts) }}</p>
            <p style="font-size:13px;color:#64748b;margin-top:10px;font-weight:500">{{ $promptsByCategory->count() }} categories</p>
        </div>
    </div>

    <div style="position:relative;border-radius:22px;overflow:hidden;background:linear-gradient(145deg,#f0fdf8,#e5f9f1);border:1px solid rgba(5,150,105,.18);box-shadow:0 4px 24px rgba(5,150,105,.09),0 1px 3px rgba(0,0,0,.04);transition:transform .22s ease,box-shadow .22s ease" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 20px 48px rgba(5,150,105,.15)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 24px rgba(5,150,105,.09)'">
        <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,#059669,#047857)"></div>
        <div style="padding:24px 22px 20px">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:18px">
                <div style="width:50px;height:50px;border-radius:15px;background:linear-gradient(135deg,#059669,#047857);display:flex;align-items:center;justify-content:center;box-shadow:0 8px 22px rgba(5,150,105,.38)">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <span style="font-size:9px;font-weight:800;letter-spacing:.18em;text-transform:uppercase;padding:4px 10px;border-radius:7px;background:rgba(5,150,105,.1);color:#059669">Revenue</span>
            </div>
            <p style="font-size:2.3rem;font-weight:900;letter-spacing:-2px;line-height:1;background:linear-gradient(135deg,#059669,#047857);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">${{ number_format($totalRevenue, 2) }}</p>
            <p style="font-size:13px;color:#64748b;margin-top:10px;font-weight:500">{{ number_format($totalTransactions) }} transactions</p>
        </div>
    </div>

    <div style="position:relative;border-radius:22px;overflow:hidden;background:linear-gradient(145deg,#fffdf0,#fef6dc);border:1px solid rgba(217,119,6,.18);box-shadow:0 4px 24px rgba(217,119,6,.09),0 1px 3px rgba(0,0,0,.04);transition:transform .22s ease,box-shadow .22s ease" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 20px 48px rgba(217,119,6,.15)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 24px rgba(217,119,6,.09)'">
        <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,#d97706,#b45309)"></div>
        <div style="padding:24px 22px 20px">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:18px">
                <div style="width:50px;height:50px;border-radius:15px;background:linear-gradient(135deg,#d97706,#b45309);display:flex;align-items:center;justify-content:center;box-shadow:0 8px 22px rgba(217,119,6,.38)">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/></svg>
                </div>
                <span style="font-size:9px;font-weight:800;letter-spacing:.18em;text-transform:uppercase;padding:4px 10px;border-radius:7px;background:rgba(217,119,6,.1);color:#d97706">Avg/Day</span>
            </div>
            <p style="font-size:2.3rem;font-weight:900;letter-spacing:-2px;line-height:1;background:linear-gradient(135deg,#d97706,#b45309);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">${{ number_format($avgDailyRevenue, 2) }}</p>
            <p style="font-size:13px;color:#64748b;margin-top:10px;font-weight:500">over {{ $revenueGrowthDays }} {{ Str::plural('day', $revenueGrowthDays) }}</p>
        </div>
    </div>
</div>

{{-- ══ Charts Row ══ --}}
<div class="fade-up-2" style="display:grid;grid-template-columns:repeat(2,1fr);gap:20px;margin-bottom:24px">

    {{-- Prompts by Category --}}
    <div style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">
        <div style="background:linear-gradient(135deg,#1a0536,#3b0764,#6d28d9);padding:16px 22px;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden">
            <div style="position:absolute;top:-24px;right:-16px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.05);pointer-events:none"></div>
            <div style="display:flex;align-items:center;gap:11px;position:relative">
                <div style="width:36px;height:36px;border-radius:11px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                </div>
                <div>
                    <p style="font-size:14px;font-weight:700;color:#fff">Prompts by Category</p>
                    <p style="font-size:11px;color:rgba(221,214,254,.6);margin-top:1px">Content distribution</p>
                </div>
            </div>
            <span style="position:relative;font-size:11px;font-weight:700;padding:5px 13px;border-radius:99px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);color:rgba(221,214,254,.9)">{{ $promptsByCategory->count() }} categories</span>
        </div>
        <div style="background:#fff;padding:20px 24px;display:flex;flex-direction:column;gap:14px">
            @forelse($promptsByCategory->sortByDesc('count') as $cat)
                @php $pct = round(($cat->count / $maxCatCount) * 100); @endphp
                <div>
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px">
                        <span style="font-size:13px;font-weight:600;color:#334155">{{ $cat->category ?: 'Uncategorised' }}</span>
                        <div style="display:flex;align-items:center;gap:8px">
                            <span style="font-size:11px;color:#94a3b8">{{ $pct }}%</span>
                            <span style="font-size:12px;font-weight:700;color:#7c3aed">{{ number_format($cat->count) }}</span>
                        </div>
                    </div>
                    <div style="height:7px;border-radius:99px;background:#f1f5f9;overflow:hidden">
                        <div style="height:100%;border-radius:99px;background:linear-gradient(90deg,#8b5cf6,#06b6d4);width:{{ $pct }}%"></div>
                    </div>
                </div>
            @empty
                <p style="font-size:13px;color:#94a3b8;text-align:center;padding:40px 0">No category data yet.</p>
            @endforelse
        </div>
    </div>

    {{-- Revenue Timeline --}}
    <div style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">
        <div style="background:linear-gradient(135deg,#022c22,#064e3b,#047857);padding:16px 22px;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden">
            <div style="position:absolute;top:-24px;right:-16px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.05);pointer-events:none"></div>
            <div style="display:flex;align-items:center;gap:11px;position:relative">
                <div style="width:36px;height:36px;border-radius:11px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/></svg>
                </div>
                <div>
                    <p style="font-size:14px;font-weight:700;color:#fff">Revenue Timeline</p>
                    <p style="font-size:11px;color:rgba(167,243,208,.6);margin-top:1px">Top revenue days</p>
                </div>
            </div>
            <span style="position:relative;font-size:11px;font-weight:700;padding:5px 13px;border-radius:99px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);color:rgba(167,243,208,.9)">${{ number_format($totalRevenue, 0) }}</span>
        </div>
        <div style="background:#fff;padding:20px 24px;display:flex;flex-direction:column;gap:14px">
            @forelse($revenueData->sortByDesc('total')->take(8) as $rev)
                @php $pct = round(($rev->total / $maxRevenue) * 100); @endphp
                <div>
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px">
                        <span style="font-size:13px;font-weight:600;color:#334155">{{ \Carbon\Carbon::parse($rev->date)->format('M j, Y') }}</span>
                        <div style="display:flex;align-items:center;gap:8px">
                            <span style="font-size:11px;color:#94a3b8">{{ $rev->count }} txn</span>
                            <span style="font-size:12px;font-weight:700;color:#059669">${{ number_format($rev->total, 2) }}</span>
                        </div>
                    </div>
                    <div style="height:7px;border-radius:99px;background:#f1f5f9;overflow:hidden">
                        <div style="height:100%;border-radius:99px;background:linear-gradient(90deg,#10b981,#059669);width:{{ $pct }}%"></div>
                    </div>
                </div>
            @empty
                <p style="font-size:13px;color:#94a3b8;text-align:center;padding:40px 0">No revenue data yet.</p>
            @endforelse
        </div>
    </div>
</div>

{{-- ══ User Registrations Table ══ --}}
<div class="fade-up-3" style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">
    <div style="background:linear-gradient(135deg,#0e0b2e,#1e1a4a,#3730a3);padding:16px 22px;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden">
        <div style="position:absolute;top:-24px;right:-16px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.05);pointer-events:none"></div>
        <div style="display:flex;align-items:center;gap:11px;position:relative">
            <div style="width:36px;height:36px;border-radius:11px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
            </div>
            <div>
                <p style="font-size:14px;font-weight:700;color:#fff">User Registrations</p>
                <p style="font-size:11px;color:rgba(199,210,254,.6);margin-top:1px">Daily sign-up volume</p>
            </div>
        </div>
        <span style="position:relative;font-size:11px;font-weight:700;padding:5px 13px;border-radius:99px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);color:rgba(199,210,254,.9)">{{ number_format($totalUsers) }} total</span>
    </div>

    @if($usersGrowth->isNotEmpty())
        <div style="background:#fff;overflow-x:auto">
            <table style="width:100%;font-size:13px;border-collapse:collapse">
                <thead>
                    <tr style="background:linear-gradient(90deg,#f8faff,#f5f3ff)">
                        <th style="padding:12px 20px;text-align:left;font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4">#</th>
                        <th style="padding:12px 20px;text-align:left;font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4">Date</th>
                        <th style="padding:12px 20px;text-align:left;font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4">New Users</th>
                        <th style="padding:12px 20px;text-align:left;font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4;width:45%">Volume</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usersGrowth->sortByDesc('date')->take(20) as $i => $row)
                        @php $pct = round(($row->count / $maxUserCount) * 100); @endphp
                        <tr style="border-bottom:1px solid #f3f6fb;transition:background .1s" onmouseover="this.style.background='#f7f5ff'" onmouseout="this.style.background='transparent'">
                            <td style="padding:12px 20px;color:#cbd5e1;font-size:11px;font-weight:700;width:40px">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</td>
                            <td style="padding:12px 20px;font-weight:600;color:#475569">{{ \Carbon\Carbon::parse($row->date)->format('M j, Y') }}</td>
                            <td style="padding:12px 20px">
                                <span style="font-size:14px;font-weight:900;background:linear-gradient(135deg,#4f46e5,#7c3aed);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">+{{ number_format($row->count) }}</span>
                            </td>
                            <td style="padding:12px 20px">
                                <div style="display:flex;align-items:center;gap:10px">
                                    <div style="flex:1;height:7px;border-radius:99px;background:#f1f5f9;overflow:hidden">
                                        <div style="height:100%;border-radius:99px;background:linear-gradient(90deg,#4f46e5,#8b5cf6);width:{{ $pct }}%"></div>
                                    </div>
                                    <span style="font-size:11px;color:#94a3b8;flex-shrink:0;width:30px;text-align:right">{{ $pct }}%</span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div style="padding:80px 24px;text-align:center;background:#fff">
            <div style="width:64px;height:64px;border-radius:20px;background:linear-gradient(135deg,#eef2ff,#e0e7ff);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;box-shadow:0 4px 16px rgba(99,102,241,.12)">
                <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#6366f1" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
            </div>
            <p style="font-size:15px;font-weight:700;color:#1e293b">No data yet</p>
            <p style="font-size:13px;color:#94a3b8;margin-top:5px">Growth data will appear once users register.</p>
        </div>
    @endif
</div>

@endsection
