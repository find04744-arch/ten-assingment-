@extends('layouts.admin')
@section('title', 'Prompts')
@section('subtitle', 'Review, approve & moderate submissions')

@section('content')
@php
    $approvedCount = \App\Models\Prompt::where('status','approved')->count();
    $pendingCount  = \App\Models\Prompt::where('status','pending')->count();
    $rejectedCount = \App\Models\Prompt::where('status','rejected')->count();
    $featuredCount = \App\Models\Prompt::where('is_featured',true)->count();
@endphp

<style>
    .page-table { width:100%; font-size:13px; border-collapse:collapse; }
    .page-table thead tr { background:linear-gradient(90deg,#fdf8ff,#f5effe); }
    .page-table th { padding:12px 20px; font-size:10px; font-weight:800; color:#94a3b8; text-transform:uppercase; letter-spacing:.14em; border-bottom:1px solid #e8ecf4; white-space:nowrap; }
    .page-table td { padding:13px 20px; border-bottom:1px solid #f3f6fb; vertical-align:middle; }
    .page-table tbody tr { transition:background .1s; }
    .page-table tbody tr:hover { background:#fdf8ff; }
    .page-table tbody tr:last-child td { border-bottom:none; }
</style>

{{-- ══ Page Header ══ --}}
<div class="fade-up" style="position:relative;overflow:hidden;border-radius:24px;margin-bottom:28px;background:linear-gradient(135deg,#1a0536 0%,#3b0764 35%,#6d28d9 70%,#7c3aed 100%);min-height:168px">
    <div style="position:absolute;inset:0;pointer-events:none;background-image:radial-gradient(rgba(255,255,255,.04) 1px,transparent 1px);background-size:28px 28px"></div>
    <div style="position:absolute;top:-80px;right:-40px;width:320px;height:320px;border-radius:50%;background:radial-gradient(circle,rgba(168,85,247,.2) 0%,transparent 65%);pointer-events:none"></div>
    <div style="position:absolute;bottom:-90px;left:42%;width:360px;height:360px;border-radius:50%;background:rgba(139,92,246,.07);pointer-events:none"></div>
    <div style="position:absolute;top:-50px;right:120px;width:220px;height:220px;border-radius:50%;border:1px solid rgba(255,255,255,.05);pointer-events:none"></div>

    <div style="position:relative;padding:28px 32px 26px">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px">
            <div style="display:flex;align-items:center;gap:10px">
                <div style="display:inline-flex;align-items:center;gap:7px;padding:5px 13px;border-radius:99px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);backdrop-filter:blur(6px)">
                    <span style="width:6px;height:6px;border-radius:50%;background:#c084fc;flex-shrink:0;animation:ap-pulse 2.5s ease infinite"></span>
                    <span style="font-size:11px;font-weight:700;color:rgba(221,214,254,.85);letter-spacing:.12em;text-transform:uppercase">Prompt Moderation</span>
                </div>
                @if($pendingCount > 0)
                    <span style="display:inline-flex;align-items:center;gap:5px;padding:5px 13px;border-radius:99px;background:rgba(245,158,11,.2);border:1px solid rgba(245,158,11,.3);font-size:12px;font-weight:700;color:#fcd34d;animation:ap-pulse 2.5s ease infinite">
                        <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9.303 3.376c.866 1.5-.217 3.374-1.948 3.374H4.645c-1.73 0-2.813-1.874-1.948-3.374L10.053 3.378c.866-1.5 3.032-1.5 3.898 0l5.352 9.748zM12 15.75h.007v.008H12v-.008z"/></svg>
                        {{ $pendingCount }} pending
                    </span>
                @endif
            </div>
            <a href="{{ route('admin.prompts.create') }}" style="display:inline-flex;align-items:center;gap:7px;padding:8px 16px;border-radius:11px;font-size:12px;font-weight:700;color:#fff;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.22);backdrop-filter:blur(6px);text-decoration:none;transition:all .15s" onmouseover="this.style.background='rgba(255,255,255,.25)'" onmouseout="this.style.background='rgba(255,255,255,.15)'">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Add Prompt
            </a>
        </div>

        <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:24px">
            <div>
                <h1 style="font-size:clamp(1.6rem,3vw,2.1rem);font-weight:900;color:#fff;line-height:1.1;letter-spacing:-.5px">
                    {{ number_format($prompts->total()) }}
                    <span style="font-size:1rem;font-weight:500;color:rgba(221,214,254,.55)">total prompts</span>
                </h1>
                <p style="margin-top:9px;font-size:13px;color:rgba(221,214,254,.45)">Review, approve and feature content submissions</p>
            </div>

            <div style="display:flex;gap:2px;flex-shrink:0;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:4px;backdrop-filter:blur(8px)">
                <div style="padding:12px 18px;text-align:center;border-radius:12px">
                    <p style="font-size:20px;font-weight:900;color:#6ee7b7;letter-spacing:-1px;line-height:1">{{ $approvedCount }}</p>
                    <p style="font-size:10px;font-weight:600;color:rgba(221,214,254,.5);margin-top:4px;text-transform:uppercase;letter-spacing:.1em">Approved</p>
                </div>
                <div style="width:1px;background:rgba(255,255,255,.08);margin:8px 0"></div>
                <div style="padding:12px 18px;text-align:center;border-radius:12px">
                    <p style="font-size:20px;font-weight:900;color:#fcd34d;letter-spacing:-1px;line-height:1">{{ $pendingCount }}</p>
                    <p style="font-size:10px;font-weight:600;color:rgba(221,214,254,.5);margin-top:4px;text-transform:uppercase;letter-spacing:.1em">Pending</p>
                </div>
                <div style="width:1px;background:rgba(255,255,255,.08);margin:8px 0"></div>
                <div style="padding:12px 18px;text-align:center;border-radius:12px">
                    <p style="font-size:20px;font-weight:900;color:#fff;letter-spacing:-1px;line-height:1">{{ $rejectedCount }}</p>
                    <p style="font-size:10px;font-weight:600;color:rgba(221,214,254,.5);margin-top:4px;text-transform:uppercase;letter-spacing:.1em">Rejected</p>
                </div>
                <div style="width:1px;background:rgba(255,255,255,.08);margin:8px 0"></div>
                <div style="padding:12px 18px;text-align:center;border-radius:12px">
                    <p style="font-size:20px;font-weight:900;color:#fbbf24;letter-spacing:-1px;line-height:1">{{ $featuredCount }}</p>
                    <p style="font-size:10px;font-weight:600;color:rgba(221,214,254,.5);margin-top:4px;text-transform:uppercase;letter-spacing:.1em">Featured</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ══ Pending Alert ══ --}}
@if($pendingCount > 0)
    <div class="fade-up-1" style="display:flex;align-items:center;gap:14px;padding:14px 22px;border-radius:18px;margin-bottom:24px;background:linear-gradient(135deg,#fffbeb,#fef3c7);border:1px solid #fde68a;box-shadow:0 4px 16px rgba(245,158,11,.1)">
        <div style="width:38px;height:38px;border-radius:12px;background:linear-gradient(135deg,#f59e0b,#d97706);display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 4px 12px rgba(245,158,11,.35)">
            <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
        </div>
        <p style="font-size:13.5px;font-weight:600;color:#92400e;flex:1"><strong>{{ $pendingCount }}</strong> prompt{{ $pendingCount > 1 ? 's' : '' }} awaiting your review — scroll down to approve or reject them.</p>
    </div>
@endif

{{-- ══ Table Card ══ --}}
<div class="fade-up-1" style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">

    <div style="background:linear-gradient(135deg,#2e1065,#4a1d96,#6b21a8);padding:16px 22px;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden">
        <div style="position:absolute;top:-24px;right:-16px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.05);pointer-events:none"></div>
        <div style="display:flex;align-items:center;gap:11px;position:relative">
            <div style="width:36px;height:36px;border-radius:11px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
            </div>
            <div>
                <p style="font-size:14px;font-weight:700;color:#fff;letter-spacing:-.2px">All Prompts</p>
                <p style="font-size:11px;color:rgba(221,214,254,.6);margin-top:1px">Page {{ $prompts->currentPage() }} of {{ $prompts->lastPage() }}</p>
            </div>
        </div>
        <span style="position:relative;font-size:11px;font-weight:700;padding:5px 13px;border-radius:99px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);color:rgba(221,214,254,.9)">{{ number_format($prompts->total()) }} total</span>
    </div>

    <div style="background:#fff;overflow-x:auto">
        <table class="page-table">
            <thead>
                <tr>
                    <th style="text-align:left">#</th>
                    <th style="text-align:left">Prompt</th>
                    <th style="text-align:left">Author</th>
                    <th style="text-align:left">Status</th>
                    <th style="text-align:left">Featured</th>
                    <th style="text-align:left">Date</th>
                    <th style="text-align:right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prompts as $prompt)
                    @php
                        $isPending = $prompt->status === 'pending';
                        $sc = [
                            'approved' => ['dot'=>'#10b981','bg'=>'rgba(220,252,231,.8)','c'=>'#065f46','label'=>'Approved'],
                            'pending'  => ['dot'=>'#f59e0b','bg'=>'rgba(254,243,199,.9)','c'=>'#92400e','label'=>'Pending'],
                            'rejected' => ['dot'=>'#ef4444','bg'=>'rgba(254,226,226,.8)','c'=>'#991b1b','label'=>'Rejected'],
                        ][$prompt->status] ?? ['dot'=>'#94a3b8','bg'=>'rgba(241,245,249,.8)','c'=>'#64748b','label'=>ucfirst($prompt->status)];
                    @endphp
                    <tr style="{{ $isPending ? 'background:#fffdf7' : '' }}">
                        <td style="color:#cbd5e1;font-size:11px;font-weight:700;width:40px">{{ str_pad($loop->iteration + ($prompts->currentPage()-1)*$prompts->perPage(), 2, '0', STR_PAD_LEFT) }}</td>

                        <td>
                            <div style="display:flex;align-items:flex-start;gap:10px">
                                <div style="width:3px;min-height:42px;border-radius:99px;background:{{ $sc['dot'] }};flex-shrink:0;margin-top:2px"></div>
                                <div style="min-width:0">
                                    <p style="font-weight:700;color:#1e293b;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:200px">{{ $prompt->title }}</p>
                                    <p style="font-size:11px;color:#94a3b8;margin-top:2px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:200px">{{ Str::limit($prompt->description ?? '', 55) }}</p>
                                    @if($prompt->category)
                                        <span style="display:inline-block;margin-top:5px;font-size:10px;font-weight:700;padding:2px 8px;border-radius:99px;background:rgba(147,51,234,.08);color:#7e22ce;text-transform:uppercase;letter-spacing:.08em">{{ $prompt->category }}</span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <td>
                            <div style="display:flex;align-items:center;gap:8px">
                                <div style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,#7c3aed,#9333ea);display:flex;align-items:center;justify-content:center;color:#fff;font-size:13px;font-weight:800;flex-shrink:0;box-shadow:0 3px 10px rgba(147,51,234,.28)">
                                    {{ strtoupper(substr($prompt->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <span style="font-weight:600;color:#475569;font-size:13px">{{ $prompt->user->name ?? '—' }}</span>
                            </div>
                        </td>

                        <td>
                            <span style="display:inline-flex;align-items:center;gap:5px;padding:4px 11px;border-radius:99px;font-size:11px;font-weight:700;background:{{ $sc['bg'] }};color:{{ $sc['c'] }}">
                                <span style="width:5px;height:5px;border-radius:50%;background:{{ $sc['dot'] }};flex-shrink:0{{ $isPending ? ';animation:ap-pulse 2.5s ease infinite' : '' }}"></span>
                                {{ $sc['label'] }}
                            </span>
                        </td>

                        <td>
                            @if($prompt->is_featured)
                                <span style="display:inline-flex;align-items:center;gap:4px;padding:4px 10px;border-radius:99px;font-size:11px;font-weight:700;background:linear-gradient(135deg,#f59e0b,#f97316);color:#fff">
                                    <svg width="10" height="10" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    Featured
                                </span>
                            @else
                                <span style="color:#e2e8f0;font-size:13px">—</span>
                            @endif
                        </td>

                        <td>
                            <p style="font-size:12.5px;font-weight:600;color:#475569">{{ $prompt->created_at?->format('M j, Y') ?? '—' }}</p>
                            <p style="font-size:11px;color:#94a3b8;margin-top:2px">{{ $prompt->created_at?->diffForHumans() ?? '' }}</p>
                        </td>

                        <td>
                            <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px;flex-wrap:wrap">
                                @if($isPending)
                                    <form action="{{ route('admin.prompts.approve', $prompt->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <button type="submit" class="act-btn"
                                                style="color:#059669;border-color:#a7f3d0;background:#f0fdf4"
                                                onmouseover="this.style.background='linear-gradient(135deg,#10b981,#059669)';this.style.color='#fff';this.style.borderColor='#10b981'"
                                                onmouseout="this.style.background='#f0fdf4';this.style.color='#059669';this.style.borderColor='#a7f3d0'">
                                            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                            Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.prompts.reject', $prompt->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <button type="submit" class="act-btn"
                                                style="color:#dc2626;border-color:#fecdd3;background:#fff1f2"
                                                onmouseover="this.style.background='linear-gradient(135deg,#f43f5e,#dc2626)';this.style.color='#fff';this.style.borderColor='#f43f5e'"
                                                onmouseout="this.style.background='#fff1f2';this.style.color='#dc2626';this.style.borderColor='#fecdd3'">
                                            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                            Reject
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('admin.prompts.edit', $prompt) }}" class="act-btn"
                                   style="color:#4f46e5;border-color:#c7d2fe;background:#eef2ff"
                                   onmouseover="this.style.background='linear-gradient(135deg,#4f46e5,#7c3aed)';this.style.color='#fff';this.style.borderColor='transparent'"
                                   onmouseout="this.style.background='#eef2ff';this.style.color='#4f46e5';this.style.borderColor='#c7d2fe'">
                                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.prompts.feature', $prompt->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <button type="submit" class="act-btn"
                                            style="{{ $prompt->is_featured ? 'background:linear-gradient(135deg,#f59e0b,#f97316);color:#fff;border-color:#f59e0b' : 'color:#92400e;border-color:#fde68a;background:#fffbeb' }}"
                                            onmouseover="this.style.opacity='.82'" onmouseout="this.style.opacity='1'">
                                        <svg width="11" height="11" fill="{{ $prompt->is_featured ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                        {{ $prompt->is_featured ? 'Unfeature' : 'Feature' }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding:80px 24px;text-align:center">
                            <div style="width:64px;height:64px;border-radius:20px;background:linear-gradient(135deg,#f5f3ff,#ede9fe);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;box-shadow:0 4px 16px rgba(147,51,234,.12)">
                                <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#9333ea" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                            </div>
                            <p style="font-size:15px;font-weight:700;color:#1e293b">No prompts yet</p>
                            <p style="font-size:13px;color:#94a3b8;margin-top:5px">Submitted prompts will appear here for review.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($prompts->hasPages())
        <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 22px;border-top:1px solid #f1f5f9;background:#fdfbff">
            <p style="font-size:12px;color:#94a3b8">Showing {{ $prompts->firstItem() }}–{{ $prompts->lastItem() }} of {{ number_format($prompts->total()) }}</p>
            {{ $prompts->links() }}
        </div>
    @endif
</div>

@endsection
