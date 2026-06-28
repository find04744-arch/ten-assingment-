@extends('layouts.admin')
@section('title', 'Career Applications')
@section('subtitle', 'Review and manage job applications')

@section('content')
<div class="fade-up" style="position:relative;overflow:hidden;border-radius:24px;margin-bottom:28px;background:linear-gradient(135deg,#3b0764 0%,#7e22ce 50%,#9333ea 100%);min-height:140px">
    <div style="position:absolute;inset:0;pointer-events:none;background-image:radial-gradient(rgba(255,255,255,.04) 1px,transparent 1px);background-size:28px 28px"></div>
    <div style="position:relative;padding:26px 30px">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px">
            <div style="display:inline-flex;align-items:center;gap:7px;padding:5px 13px;border-radius:99px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12)">
                <span style="width:6px;height:6px;border-radius:50%;background:#d8b4fe;flex-shrink:0;animation:ap-pulse 2.5s ease infinite"></span>
                <span style="font-size:11px;font-weight:700;color:rgba(216,180,254,.85);letter-spacing:.12em;text-transform:uppercase">Applications</span>
            </div>
        </div>
        <h1 style="font-size:2rem;font-weight:900;color:#fff;letter-spacing:-.5px">{{ number_format($applications->total()) }} <span style="font-size:1rem;font-weight:500;color:rgba(216,180,254,.55)">received</span></h1>
    </div>
</div>

@if(session('status'))
    <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;padding:12px 18px;margin-bottom:20px;color:#15803d;font-size:13px;font-weight:600">{{ session('status') }}</div>
@endif

<div class="fade-up-1" style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">
    <div style="background:linear-gradient(135deg,#3b0764,#7e22ce,#9333ea);padding:16px 22px;display:flex;align-items:center;gap:11px;position:relative;overflow:hidden">
        <div style="position:absolute;top:-24px;right:-16px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.05)"></div>
        <div style="width:36px;height:36px;border-radius:11px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;position:relative">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
        </div>
        <p style="font-size:14px;font-weight:700;color:#fff;position:relative">All Applications</p>
    </div>
    <div style="background:#fff;overflow-x:auto">
        <table style="width:100%;font-size:13px;border-collapse:collapse">
            <thead>
                <tr style="background:linear-gradient(90deg,#faf5ff,#f3e8ff)">
                    @foreach(['#','Applicant','Contact','Department / Type','Resume','Actions'] as $th)
                        <th style="padding:12px 20px;text-align:{{ $loop->last ? 'right' : 'left' }};font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4">{{ $th }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $app)
                    <tr style="border-bottom:1px solid #f3f6fb;transition:background .1s" onmouseover="this.style.background='#faf5ff'" onmouseout="this.style.background='transparent'">
                        <td style="padding:13px 20px;color:#cbd5e1;font-size:11px;font-weight:700;width:40px">{{ str_pad($loop->iteration + ($applications->currentPage()-1)*$applications->perPage(), 2, '0', STR_PAD_LEFT) }}</td>
                        <td style="padding:13px 20px">
                            <div style="display:flex;align-items:center;gap:10px">
                                <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#7e22ce,#9333ea);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;font-weight:800;flex-shrink:0">{{ strtoupper(substr($app->name,0,1)) }}</div>
                                <div>
                                    <p style="font-weight:700;color:#1e293b">{{ $app->name }}</p>
                                    <p style="font-size:11px;color:#94a3b8;margin-top:1px">Applied {{ $app->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </td>
                        <td style="padding:13px 20px">
                            <p style="color:#475569;font-size:12px">{{ $app->email }}</p>
                            @if($app->phone)<p style="color:#94a3b8;font-size:11px;margin-top:2px">{{ $app->phone }}</p>@endif
                        </td>
                        <td style="padding:13px 20px">
                            @if($app->department)<span style="padding:3px 9px;border-radius:7px;background:#faf5ff;color:#7e22ce;font-size:11px;font-weight:700;display:block;width:fit-content;margin-bottom:4px">{{ $app->department }}</span>@endif
                            @if($app->type)<span style="padding:2px 8px;border-radius:6px;background:#f1f5f9;color:#475569;font-size:10px;font-weight:700">{{ $app->type }}</span>@endif
                        </td>
                        <td style="padding:13px 20px">
                            @if($app->resume_path)
                                <a href="{{ Storage::url($app->resume_path) }}" target="_blank" style="display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:8px;background:#faf5ff;color:#7e22ce;border:1px solid #e9d5ff;font-size:11px;font-weight:700;text-decoration:none" download>
                                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                    Download
                                </a>
                            @else
                                <span style="color:#94a3b8;font-size:12px">None</span>
                            @endif
                        </td>
                        <td style="padding:13px 20px;text-align:right">
                            <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px">
                                <a href="{{ route('admin.career-applications.show', $app) }}" class="act-btn" style="color:#7e22ce;border-color:#e9d5ff;background:#faf5ff" onmouseover="this.style.background='linear-gradient(135deg,#9333ea,#7e22ce)';this.style.color='#fff';this.style.borderColor='transparent'" onmouseout="this.style.background='#faf5ff';this.style.color='#7e22ce';this.style.borderColor='#e9d5ff'">
                                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    View
                                </a>
                                <form action="{{ route('admin.career-applications.destroy', $app) }}" method="POST" onsubmit="return confirm('Delete this application?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="act-btn" style="color:#dc2626;border-color:#fecdd3;background:#fff1f2" onmouseover="this.style.background='linear-gradient(135deg,#ef4444,#dc2626)';this.style.color='#fff';this.style.borderColor='transparent'" onmouseout="this.style.background='#fff1f2';this.style.color='#dc2626';this.style.borderColor='#fecdd3'">
                                        <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="padding:80px 24px;text-align:center">
                        <p style="font-size:15px;font-weight:700;color:#1e293b">No applications received yet</p>
                        <p style="font-size:13px;color:#94a3b8;margin-top:4px">Applications will appear here when candidates apply</p>
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($applications->hasPages())
        <div style="padding:14px 22px;border-top:1px solid #f1f5f9;background:#faf5ff">{{ $applications->links() }}</div>
    @endif
</div>
@endsection
