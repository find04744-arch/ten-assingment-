@extends('layouts.admin')
@section('title', 'Reports')
@section('subtitle', 'Review flagged content & take action')

@section('content')
@php
    $pendingCount   = \App\Models\Report::where('status','pending')->count();
    $resolvedCount  = \App\Models\Report::where('status','resolved')->count();
    $dismissedCount = \App\Models\Report::where('status','dismissed')->count();
    $totalCount     = $reports->total();
@endphp

{{-- ══ Page Header ══ --}}
<div class="fade-up" style="position:relative;overflow:hidden;border-radius:24px;margin-bottom:28px;background:linear-gradient(135deg,#4c0519 0%,#881337 35%,#be123c 70%,#e11d48 100%);min-height:168px">
    <div style="position:absolute;inset:0;pointer-events:none;background-image:radial-gradient(rgba(255,255,255,.04) 1px,transparent 1px);background-size:28px 28px"></div>
    <div style="position:absolute;top:-80px;right:-40px;width:320px;height:320px;border-radius:50%;background:radial-gradient(circle,rgba(251,113,133,.25) 0%,transparent 65%);pointer-events:none"></div>
    <div style="position:absolute;bottom:-90px;left:42%;width:360px;height:360px;border-radius:50%;background:rgba(225,29,72,.08);pointer-events:none"></div>
    <div style="position:absolute;top:-50px;right:120px;width:220px;height:220px;border-radius:50%;border:1px solid rgba(255,255,255,.05);pointer-events:none"></div>

    <div style="position:relative;padding:28px 32px 26px">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px">
            <div style="display:inline-flex;align-items:center;gap:7px;padding:5px 13px;border-radius:99px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);backdrop-filter:blur(6px)">
                @if($pendingCount > 0)
                    <span style="width:6px;height:6px;border-radius:50%;background:#fda4af;flex-shrink:0;animation:ap-pulse 2.5s ease infinite"></span>
                    <span style="font-size:11px;font-weight:700;color:rgba(253,164,175,.85);letter-spacing:.12em;text-transform:uppercase">{{ $pendingCount }} Pending Review</span>
                @else
                    <span style="width:6px;height:6px;border-radius:50%;background:#34d399;flex-shrink:0"></span>
                    <span style="font-size:11px;font-weight:700;color:rgba(253,164,175,.85);letter-spacing:.12em;text-transform:uppercase">All Clear</span>
                @endif
            </div>
        </div>

        <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:24px">
            <div>
                <h1 style="font-size:clamp(1.6rem,3vw,2.1rem);font-weight:900;color:#fff;line-height:1.1;letter-spacing:-.5px">
                    {{ number_format($totalCount) }}
                    <span style="font-size:1rem;font-weight:500;color:rgba(254,205,211,.55)">content reports</span>
                </h1>
                <p style="margin-top:9px;font-size:13px;color:rgba(254,205,211,.45)">Review flagged content and take moderation action</p>
            </div>

            <div style="display:flex;gap:2px;flex-shrink:0;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:4px;backdrop-filter:blur(8px)">
                @if($pendingCount > 0)
                <div style="padding:12px 20px;text-align:center;border-radius:12px">
                    <p style="font-size:20px;font-weight:900;color:#fda4af;letter-spacing:-1px;line-height:1;animation:ap-pulse 2.5s ease infinite">{{ number_format($pendingCount) }}</p>
                    <p style="font-size:10px;font-weight:600;color:rgba(254,205,211,.5);margin-top:4px;text-transform:uppercase;letter-spacing:.1em">Pending</p>
                </div>
                <div style="width:1px;background:rgba(255,255,255,.08);margin:8px 0"></div>
                @endif
                <div style="padding:12px 20px;text-align:center;border-radius:12px">
                    <p style="font-size:20px;font-weight:900;color:#6ee7b7;letter-spacing:-1px;line-height:1">{{ number_format($resolvedCount) }}</p>
                    <p style="font-size:10px;font-weight:600;color:rgba(254,205,211,.5);margin-top:4px;text-transform:uppercase;letter-spacing:.1em">Resolved</p>
                </div>
                <div style="width:1px;background:rgba(255,255,255,.08);margin:8px 0"></div>
                <div style="padding:12px 20px;text-align:center;border-radius:12px">
                    <p style="font-size:20px;font-weight:900;color:#fff;letter-spacing:-1px;line-height:1">{{ number_format($dismissedCount) }}</p>
                    <p style="font-size:10px;font-weight:600;color:rgba(254,205,211,.5);margin-top:4px;text-transform:uppercase;letter-spacing:.1em">Dismissed</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ══ Pending Alert ══ --}}
@if($pendingCount > 0)
    <div class="fade-up-1" style="display:flex;align-items:center;gap:14px;padding:14px 20px;border-radius:16px;margin-bottom:20px;background:linear-gradient(135deg,#fff1f2,#ffe4e6);border:1px solid #fecaca">
        <div style="width:36px;height:36px;border-radius:11px;background:linear-gradient(135deg,#e11d48,#be123c);display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 4px 14px rgba(225,29,72,.3)">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
        </div>
        <div>
            <p style="font-size:13px;font-weight:700;color:#9f1239">
                <strong>{{ $pendingCount }}</strong> report{{ $pendingCount > 1 ? 's' : '' }} require{{ $pendingCount === 1 ? 's' : '' }} immediate review
            </p>
            <p style="font-size:11.5px;color:#be123c;margin-top:2px">Pending items are highlighted below — resolve or dismiss each one.</p>
        </div>
    </div>
@endif

{{-- ══ Table Card ══ --}}
<div class="fade-up-2" style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">

    <div style="background:linear-gradient(135deg,#4c0519,#881337,#be123c);padding:16px 22px;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden">
        <div style="position:absolute;top:-24px;right:-16px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.05);pointer-events:none"></div>
        <div style="display:flex;align-items:center;gap:11px;position:relative">
            <div style="width:36px;height:36px;border-radius:11px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
            </div>
            <div>
                <p style="font-size:14px;font-weight:700;color:#fff">Flagged Content</p>
                <p style="font-size:11px;color:rgba(254,205,211,.6);margin-top:1px">Page {{ $reports->currentPage() }} of {{ $reports->lastPage() }}</p>
            </div>
        </div>
        <span style="position:relative;font-size:11px;font-weight:700;padding:5px 13px;border-radius:99px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);color:rgba(254,205,211,.9)">{{ number_format($totalCount) }} records</span>
    </div>

    <div style="background:#fff;overflow-x:auto">
        <table style="width:100%;font-size:13px;border-collapse:collapse">
            <thead>
                <tr style="background:linear-gradient(90deg,#fff8f8,#fff1f2)">
                    <th style="padding:12px 20px;text-align:left;font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4">#</th>
                    <th style="padding:12px 20px;text-align:left;font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4">Prompt</th>
                    <th style="padding:12px 20px;text-align:left;font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4">Reported By</th>
                    <th style="padding:12px 20px;text-align:left;font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4">Reason</th>
                    <th style="padding:12px 20px;text-align:left;font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4">Status</th>
                    <th style="padding:12px 20px;text-align:left;font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4">Date</th>
                    <th style="padding:12px 20px;text-align:right;font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $report)
                    @php
                        $isPending = $report->status === 'pending';
                        $sm = [
                            'resolved'  => ['dot'=>'#10b981','bg'=>'rgba(220,252,231,.8)','c'=>'#065f46','label'=>'Resolved'],
                            'dismissed' => ['dot'=>'#94a3b8','bg'=>'rgba(241,245,249,.8)','c'=>'#64748b','label'=>'Dismissed'],
                            'pending'   => ['dot'=>'#f43f5e','bg'=>'rgba(255,228,230,.8)','c'=>'#9f1239','label'=>'Pending'],
                        ][$report->status] ?? ['dot'=>'#94a3b8','bg'=>'rgba(241,245,249,.8)','c'=>'#94a3b8','label'=>ucfirst($report->status??'Unknown')];
                    @endphp
                    <tr style="border-bottom:1px solid #f3f6fb;{{ $isPending ? 'background:#fff8f8;' : '' }}transition:background .1s" onmouseover="this.style.background='{{ $isPending ? '#fff0f0' : '#fafafa' }}'" onmouseout="this.style.background='{{ $isPending ? '#fff8f8' : 'transparent' }}'">

                        <td style="padding:13px 20px;color:#cbd5e1;font-size:11px;font-weight:700;width:40px">
                            {{ str_pad($loop->iteration + ($reports->currentPage()-1)*$reports->perPage(), 2, '0', STR_PAD_LEFT) }}
                        </td>

                        <td style="padding:13px 20px">
                            <div style="display:flex;align-items:flex-start;gap:8px">
                                @if($isPending)
                                    <span style="width:7px;height:7px;border-radius:50%;background:#f43f5e;flex-shrink:0;margin-top:4px;animation:ap-pulse 2.5s ease infinite"></span>
                                @endif
                                <div style="min-width:0">
                                    <p style="font-weight:700;color:#1e293b;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:180px;font-size:13px">{{ $report->prompt->title ?? 'Deleted prompt' }}</p>
                                    @if($report->prompt)
                                        <p style="font-size:11px;color:#94a3b8;margin-top:2px">by {{ $report->prompt->user->name ?? '—' }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <td style="padding:13px 20px">
                            <div style="display:flex;align-items:center;gap:9px">
                                <div style="width:36px;height:36px;border-radius:12px;background:linear-gradient(135deg,#e11d48,#be123c);display:flex;align-items:center;justify-content:center;color:#fff;font-size:13px;font-weight:800;flex-shrink:0;box-shadow:0 3px 10px rgba(225,29,72,.28)">
                                    {{ strtoupper(substr($report->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <span style="font-weight:600;color:#475569;font-size:13px">{{ $report->user->name ?? 'Unknown' }}</span>
                            </div>
                        </td>

                        <td style="padding:13px 20px;color:#64748b;font-size:13px">
                            {{ is_array($report->reason) ? ucfirst($report->reason[0] ?? 'Other') : ucfirst($report->reason ?? 'Other') }}
                        </td>

                        <td style="padding:13px 20px">
                            <span style="display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:99px;font-size:11px;font-weight:700;background:{{ $sm['bg'] }};color:{{ $sm['c'] }}">
                                <span style="width:5px;height:5px;border-radius:50%;background:{{ $sm['dot'] }};flex-shrink:0{{ $isPending ? ';animation:ap-pulse 2.5s ease infinite' : '' }}"></span>
                                {{ $sm['label'] }}
                            </span>
                        </td>

                        <td style="padding:13px 20px">
                            <p style="font-size:12.5px;font-weight:600;color:#475569">{{ $report->created_at?->format('M j, Y') ?? '—' }}</p>
                            <p style="font-size:11px;color:#94a3b8;margin-top:2px">{{ $report->created_at?->diffForHumans() ?? '' }}</p>
                        </td>

                        <td style="padding:13px 20px">
                            <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px">
                                @if($isPending)
                                    <form action="{{ route('admin.reports.resolve', $report->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <button type="submit" class="act-btn"
                                                style="color:#059669;border-color:#a7f3d0;background:#f0fdf4"
                                                onmouseover="this.style.background='linear-gradient(135deg,#10b981,#059669)';this.style.color='#fff';this.style.borderColor='#10b981'"
                                                onmouseout="this.style.background='#f0fdf4';this.style.color='#059669';this.style.borderColor='#a7f3d0'">
                                            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                            Resolve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.reports.dismiss', $report->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <button type="submit" class="act-btn"
                                                style="color:#64748b;border-color:#e2e8f0;background:#f8fafc"
                                                onmouseover="this.style.background='#e2e8f0';this.style.borderColor='#cbd5e1'"
                                                onmouseout="this.style.background='#f8fafc';this.style.borderColor='#e2e8f0'">
                                            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                            Dismiss
                                        </button>
                                    </form>
                                @else
                                    <span style="font-size:12px;color:#cbd5e1;font-style:italic">No action</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding:80px 24px;text-align:center">
                            <div style="width:64px;height:64px;border-radius:20px;background:linear-gradient(135deg,#ecfdf5,#d1fae5);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;box-shadow:0 4px 16px rgba(16,185,129,.12)">
                                <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#10b981" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <p style="font-size:15px;font-weight:700;color:#1e293b">All clear!</p>
                            <p style="font-size:13px;color:#94a3b8;margin-top:5px">No reports to review right now.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($reports->hasPages())
        <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 22px;border-top:1px solid #f1f5f9;background:#fffafa">
            <p style="font-size:12px;color:#94a3b8">Showing {{ $reports->firstItem() }}–{{ $reports->lastItem() }} of {{ number_format($reports->total()) }}</p>
            {{ $reports->links() }}
        </div>
    @endif
</div>

@endsection
