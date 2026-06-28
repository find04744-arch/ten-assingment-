@extends('layouts.admin')
@section('title', 'Payments')
@section('subtitle', 'Transaction history & revenue tracking')

@section('content')
@php
    $totalRevenue   = \App\Models\Payment::whereIn('status',['completed','paid'])->sum('amount');
    $totalCount     = $payments->total();
    $completedCount = \App\Models\Payment::whereIn('status',['completed','paid'])->count();
    $pendingCount   = \App\Models\Payment::where('status','pending')->count();
    $avgAmount      = $completedCount > 0 ? ($totalRevenue / $completedCount) : 0;
@endphp

<style>
    .page-table { width:100%; font-size:13px; border-collapse:collapse; }
    .page-table thead tr { background:linear-gradient(90deg,#f0fdf8,#e5f9f1); }
    .page-table th { padding:12px 20px; font-size:10px; font-weight:800; color:#94a3b8; text-transform:uppercase; letter-spacing:.14em; border-bottom:1px solid #e8ecf4; white-space:nowrap; }
    .page-table td { padding:13px 20px; border-bottom:1px solid #f3f6fb; vertical-align:middle; }
    .page-table tbody tr { transition:background .1s; }
    .page-table tbody tr:hover { background:#f7fdf9; }
    .page-table tbody tr:last-child td { border-bottom:none; }
</style>

{{-- ══ Page Header ══ --}}
<div class="fade-up" style="position:relative;overflow:hidden;border-radius:24px;margin-bottom:28px;background:linear-gradient(135deg,#022c22 0%,#064e3b 35%,#047857 70%,#059669 100%);min-height:168px">
    <div style="position:absolute;inset:0;pointer-events:none;background-image:radial-gradient(rgba(255,255,255,.04) 1px,transparent 1px);background-size:28px 28px"></div>
    <div style="position:absolute;top:-80px;right:-40px;width:320px;height:320px;border-radius:50%;background:radial-gradient(circle,rgba(52,211,153,.2) 0%,transparent 65%);pointer-events:none"></div>
    <div style="position:absolute;bottom:-90px;left:42%;width:360px;height:360px;border-radius:50%;background:rgba(16,185,129,.07);pointer-events:none"></div>
    <div style="position:absolute;top:-50px;right:120px;width:220px;height:220px;border-radius:50%;border:1px solid rgba(255,255,255,.05);pointer-events:none"></div>

    <div style="position:relative;padding:28px 32px 26px">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px">
            <div style="display:inline-flex;align-items:center;gap:7px;padding:5px 13px;border-radius:99px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);backdrop-filter:blur(6px)">
                <span style="width:6px;height:6px;border-radius:50%;background:#34d399;flex-shrink:0;animation:ap-pulse 2.5s ease infinite"></span>
                <span style="font-size:11px;font-weight:700;color:rgba(167,243,208,.85);letter-spacing:.12em;text-transform:uppercase">Revenue Tracking</span>
            </div>
            <a href="{{ route('admin.payments.create') }}" style="display:inline-flex;align-items:center;gap:7px;padding:8px 16px;border-radius:11px;font-size:12px;font-weight:700;color:#fff;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.22);text-decoration:none;transition:all .15s" onmouseover="this.style.background='rgba(255,255,255,.25)'" onmouseout="this.style.background='rgba(255,255,255,.15)'">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Record Payment
            </a>
        </div>

        <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:24px">
            <div>
                <h1 style="font-size:clamp(1.6rem,3vw,2.1rem);font-weight:900;color:#fff;line-height:1.1;letter-spacing:-.5px">
                    ${{ number_format($totalRevenue, 2) }}
                    <span style="font-size:1rem;font-weight:500;color:rgba(167,243,208,.55)">total revenue</span>
                </h1>
                <p style="margin-top:9px;font-size:13px;color:rgba(167,243,208,.45)">Complete transaction history and payment records</p>
            </div>

            <div style="display:flex;gap:2px;flex-shrink:0;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:4px;backdrop-filter:blur(8px)">
                <div style="padding:12px 20px;text-align:center;border-radius:12px">
                    <p style="font-size:20px;font-weight:900;color:#34d399;letter-spacing:-1px;line-height:1">{{ number_format($completedCount) }}</p>
                    <p style="font-size:10px;font-weight:600;color:rgba(167,243,208,.5);margin-top:4px;text-transform:uppercase;letter-spacing:.1em">Completed</p>
                </div>
                <div style="width:1px;background:rgba(255,255,255,.08);margin:8px 0"></div>
                <div style="padding:12px 20px;text-align:center;border-radius:12px">
                    <p style="font-size:20px;font-weight:900;color:#fcd34d;letter-spacing:-1px;line-height:1">{{ number_format($pendingCount) }}</p>
                    <p style="font-size:10px;font-weight:600;color:rgba(167,243,208,.5);margin-top:4px;text-transform:uppercase;letter-spacing:.1em">Pending</p>
                </div>
                <div style="width:1px;background:rgba(255,255,255,.08);margin:8px 0"></div>
                <div style="padding:12px 20px;text-align:center;border-radius:12px">
                    <p style="font-size:20px;font-weight:900;color:#fff;letter-spacing:-1px;line-height:1">${{ number_format($avgAmount, 0) }}</p>
                    <p style="font-size:10px;font-weight:600;color:rgba(167,243,208,.5);margin-top:4px;text-transform:uppercase;letter-spacing:.1em">Avg / Txn</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ══ KPI Row ══ --}}
<div class="fade-up-1" style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-bottom:28px;align-items:stretch">

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
            <p style="font-size:13px;color:#64748b;margin-top:10px;font-weight:500">from completed payments</p>
        </div>
    </div>

    <div style="position:relative;border-radius:22px;overflow:hidden;background:linear-gradient(145deg,#fafbff,#f0f2fe);border:1px solid rgba(99,102,241,.18);box-shadow:0 4px 24px rgba(99,102,241,.09),0 1px 3px rgba(0,0,0,.04);transition:transform .22s ease,box-shadow .22s ease" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 20px 48px rgba(99,102,241,.15)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 24px rgba(99,102,241,.09)'">
        <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,#4f46e5,#7c3aed)"></div>
        <div style="padding:24px 22px 20px">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:18px">
                <div style="width:50px;height:50px;border-radius:15px;background:linear-gradient(135deg,#4f46e5,#7c3aed);display:flex;align-items:center;justify-content:center;box-shadow:0 8px 22px rgba(79,70,229,.38)">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
                </div>
                <span style="font-size:9px;font-weight:800;letter-spacing:.18em;text-transform:uppercase;padding:4px 10px;border-radius:7px;background:rgba(99,102,241,.1);color:#6366f1">Transactions</span>
            </div>
            <p style="font-size:2.3rem;font-weight:900;letter-spacing:-2px;line-height:1;background:linear-gradient(135deg,#4f46e5,#7c3aed);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">{{ number_format($totalCount) }}</p>
            <p style="font-size:13px;color:#64748b;margin-top:10px;font-weight:500">total records</p>
        </div>
    </div>

    <div style="position:relative;border-radius:22px;overflow:hidden;background:linear-gradient(145deg,#fffdf0,#fef6dc);border:1px solid rgba(217,119,6,.18);box-shadow:0 4px 24px rgba(217,119,6,.09),0 1px 3px rgba(0,0,0,.04);transition:transform .22s ease,box-shadow .22s ease" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 20px 48px rgba(217,119,6,.15)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 24px rgba(217,119,6,.09)'">
        <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,#d97706,#b45309)"></div>
        <div style="padding:24px 22px 20px">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:18px">
                <div style="width:50px;height:50px;border-radius:15px;background:linear-gradient(135deg,#d97706,#b45309);display:flex;align-items:center;justify-content:center;box-shadow:0 8px 22px rgba(217,119,6,.38)">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/></svg>
                </div>
                <span style="font-size:9px;font-weight:800;letter-spacing:.18em;text-transform:uppercase;padding:4px 10px;border-radius:7px;background:rgba(217,119,6,.1);color:#d97706">Avg / Txn</span>
            </div>
            <p style="font-size:2.3rem;font-weight:900;letter-spacing:-2px;line-height:1;background:linear-gradient(135deg,#d97706,#b45309);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">${{ number_format($avgAmount, 2) }}</p>
            <p style="font-size:13px;color:#64748b;margin-top:10px;font-weight:500">average transaction</p>
        </div>
    </div>

    @if($pendingCount > 0)
    <div style="position:relative;border-radius:22px;overflow:hidden;background:linear-gradient(145deg,#fffcf0,#fef6e0);border:1px solid rgba(245,158,11,.25);box-shadow:0 4px 24px rgba(245,158,11,.11),0 1px 3px rgba(0,0,0,.04);transition:transform .22s ease,box-shadow .22s ease" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
        <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,#f59e0b,#d97706)"></div>
        <div style="padding:24px 22px 20px">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:18px">
                <div style="width:50px;height:50px;border-radius:15px;background:linear-gradient(135deg,#f59e0b,#d97706);display:flex;align-items:center;justify-content:center;box-shadow:0 8px 22px rgba(245,158,11,.38)">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <span style="font-size:9px;font-weight:800;letter-spacing:.18em;text-transform:uppercase;padding:4px 10px;border-radius:7px;background:rgba(245,158,11,.12);color:#d97706">Pending</span>
            </div>
            <p style="font-size:2.3rem;font-weight:900;letter-spacing:-2px;line-height:1;background:linear-gradient(135deg,#d97706,#b45309);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">{{ number_format($pendingCount) }}</p>
            <p style="font-size:13px;color:#92400e;margin-top:10px;font-weight:600">awaiting settlement</p>
        </div>
    </div>
    @else
    <div style="position:relative;border-radius:22px;overflow:hidden;background:linear-gradient(145deg,#f0fdf9,#e4f9f3);border:1px solid rgba(16,185,129,.18);box-shadow:0 4px 24px rgba(16,185,129,.09),0 1px 3px rgba(0,0,0,.04);transition:transform .22s ease,box-shadow .22s ease" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
        <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,#10b981,#059669)"></div>
        <div style="padding:24px 22px 20px">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:18px">
                <div style="width:50px;height:50px;border-radius:15px;background:linear-gradient(135deg,#10b981,#059669);display:flex;align-items:center;justify-content:center;box-shadow:0 8px 22px rgba(16,185,129,.38)">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <span style="font-size:9px;font-weight:800;letter-spacing:.18em;text-transform:uppercase;padding:4px 10px;border-radius:7px;background:rgba(16,185,129,.1);color:#059669">Status</span>
            </div>
            <p style="font-size:2.3rem;font-weight:900;letter-spacing:-2px;line-height:1;background:linear-gradient(135deg,#10b981,#059669);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">0</p>
            <p style="font-size:13px;color:#059669;margin-top:10px;font-weight:600">all payments settled</p>
        </div>
    </div>
    @endif
</div>

{{-- ══ Table Card ══ --}}
<div class="fade-up-2" style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">

    <div style="background:linear-gradient(135deg,#022c22,#064e3b,#047857);padding:16px 22px;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden">
        <div style="position:absolute;top:-24px;right:-16px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.05);pointer-events:none"></div>
        <div style="display:flex;align-items:center;gap:11px;position:relative">
            <div style="width:36px;height:36px;border-radius:11px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
            </div>
            <div>
                <p style="font-size:14px;font-weight:700;color:#fff;letter-spacing:-.2px">Payment History</p>
                <p style="font-size:11px;color:rgba(167,243,208,.6);margin-top:1px">Page {{ $payments->currentPage() }} of {{ $payments->lastPage() }}</p>
            </div>
        </div>
        <span style="position:relative;font-size:11px;font-weight:700;padding:5px 13px;border-radius:99px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);color:rgba(167,243,208,.9)">{{ number_format($totalCount) }} records</span>
    </div>

    <div style="background:#fff;overflow-x:auto">
        <table class="page-table">
            <thead>
                <tr>
                    <th style="text-align:left">#</th>
                    <th style="text-align:left">User</th>
                    <th style="text-align:left">Transaction ID</th>
                    <th style="text-align:left">Amount</th>
                    <th style="text-align:left">Method</th>
                    <th style="text-align:left">Status</th>
                    <th style="text-align:left">Date</th>
                    <th style="text-align:left">Description</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                    @php
                        $sm = [
                            'completed' => ['dot'=>'#10b981','bg'=>'rgba(220,252,231,.8)','c'=>'#065f46','label'=>'Completed'],
                            'paid'      => ['dot'=>'#10b981','bg'=>'rgba(220,252,231,.8)','c'=>'#065f46','label'=>'Paid'],
                            'pending'   => ['dot'=>'#f59e0b','bg'=>'rgba(254,243,199,.8)','c'=>'#92400e','label'=>'Pending'],
                            'failed'    => ['dot'=>'#ef4444','bg'=>'rgba(254,226,226,.8)','c'=>'#991b1b','label'=>'Failed'],
                            'refunded'  => ['dot'=>'#94a3b8','bg'=>'rgba(241,245,249,.8)','c'=>'#64748b','label'=>'Refunded'],
                        ][$payment->status] ?? ['dot'=>'#94a3b8','bg'=>'rgba(241,245,249,.8)','c'=>'#94a3b8','label'=>ucfirst($payment->status??'unknown')];
                    @endphp
                    <tr>
                        <td style="color:#cbd5e1;font-size:11px;font-weight:700;width:40px">{{ str_pad($loop->iteration + ($payments->currentPage()-1)*$payments->perPage(), 2, '0', STR_PAD_LEFT) }}</td>

                        <td>
                            <div style="display:flex;align-items:center;gap:10px">
                                <div style="width:38px;height:38px;border-radius:12px;background:linear-gradient(135deg,#059669,#047857);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;font-weight:800;flex-shrink:0;box-shadow:0 3px 10px rgba(5,150,105,.28)">
                                    {{ strtoupper(substr($payment->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <div style="min-width:0">
                                    <p style="font-weight:700;color:#1e293b;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;font-size:13px">{{ $payment->user->name ?? 'Unknown' }}</p>
                                    <p style="font-size:11px;color:#94a3b8;margin-top:1px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $payment->user->email ?? '' }}</p>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span style="font-family:monospace;font-size:11px;color:#64748b;padding:4px 9px;border-radius:7px;background:#f8fafc;border:1px solid #e8ecf4">
                                {{ $payment->stripe_transaction_id ? Str::limit($payment->stripe_transaction_id, 18) : '—' }}
                            </span>
                        </td>

                        <td>
                            <p style="font-size:15px;font-weight:900;background:linear-gradient(135deg,#059669,#047857);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">${{ number_format($payment->amount, 2) }}</p>
                            <p style="font-size:10px;color:#94a3b8;text-transform:uppercase;letter-spacing:.08em;margin-top:2px">{{ $payment->currency ?? 'USD' }}</p>
                        </td>

                        <td style="color:#64748b;text-transform:capitalize;font-size:12.5px">{{ $payment->payment_method ?? '—' }}</td>

                        <td>
                            <span style="display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:99px;font-size:11px;font-weight:700;background:{{ $sm['bg'] }};color:{{ $sm['c'] }}">
                                <span style="width:5px;height:5px;border-radius:50%;background:{{ $sm['dot'] }};flex-shrink:0"></span>
                                {{ $sm['label'] }}
                            </span>
                        </td>

                        <td>
                            <p style="font-size:12.5px;font-weight:600;color:#475569">{{ ($payment->payment_date ?? $payment->created_at)?->format('M j, Y') ?? '—' }}</p>
                            <p style="font-size:11px;color:#94a3b8;margin-top:2px">{{ ($payment->payment_date ?? $payment->created_at)?->diffForHumans() ?? '' }}</p>
                        </td>

                        <td style="font-size:12px;color:#64748b">{{ Str::limit($payment->description ?? '—', 35) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="padding:80px 24px;text-align:center">
                            <div style="width:64px;height:64px;border-radius:20px;background:linear-gradient(135deg,#ecfdf5,#d1fae5);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;box-shadow:0 4px 16px rgba(5,150,105,.12)">
                                <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#059669" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
                            </div>
                            <p style="font-size:15px;font-weight:700;color:#1e293b">No payments yet</p>
                            <p style="font-size:13px;color:#94a3b8;margin-top:5px">Transactions will appear here once payments are processed.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($payments->hasPages())
        <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 22px;border-top:1px solid #f1f5f9;background:#f7fdf9">
            <p style="font-size:12px;color:#94a3b8">Showing {{ $payments->firstItem() }}–{{ $payments->lastItem() }} of {{ number_format($payments->total()) }}</p>
            {{ $payments->links() }}
        </div>
    @endif
</div>

@endsection
