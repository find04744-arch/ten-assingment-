@extends('layouts.admin')
@section('title', 'Application Detail')
@section('subtitle', 'Full applicant information')

@section('content')
<div class="fade-up" style="max-width:760px">
    <a href="{{ route('admin.career-applications') }}" class="act-btn" style="color:#64748b;border-color:#e2e8f0;background:#fff;margin-bottom:20px;display:inline-flex">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
        Back to Applications
    </a>
    <div style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">
        <div style="background:linear-gradient(135deg,#3b0764,#7e22ce,#9333ea);padding:24px 26px;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden">
            <div style="position:absolute;top:-20px;right:-20px;width:120px;height:120px;border-radius:50%;background:rgba(255,255,255,.05)"></div>
            <div style="display:flex;align-items:center;gap:16px">
                <div style="width:52px;height:52px;border-radius:16px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;font-size:22px;font-weight:900;color:#fff">{{ strtoupper(substr($application->name,0,1)) }}</div>
                <div>
                    <p style="font-size:18px;font-weight:800;color:#fff">{{ $application->name }}</p>
                    <p style="font-size:12px;color:rgba(216,180,254,.65);margin-top:3px">Applied {{ $application->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
            <div style="display:flex;gap:8px;position:relative">
                @if($application->resume_path)
                    <a href="{{ Storage::url($application->resume_path) }}" target="_blank" download style="display:inline-flex;align-items:center;gap:6px;padding:8px 14px;border-radius:10px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.22);color:#fff;text-decoration:none;font-size:12px;font-weight:700">
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                        Download Resume
                    </a>
                @endif
            </div>
        </div>
        <div style="background:#fff;padding:30px 26px">
            <div class="form-section">
                <p class="form-section-title">Contact Information</p>
                <div class="form-grid-2">
                    <div>
                        <p class="form-label">Email</p>
                        <p style="font-size:14px;color:#1e293b;font-weight:600">{{ $application->email }}</p>
                    </div>
                    <div>
                        <p class="form-label">Phone</p>
                        <p style="font-size:14px;color:#1e293b;font-weight:600">{{ $application->phone ?? '—' }}</p>
                    </div>
                </div>
            </div>
            <div class="form-section">
                <p class="form-section-title">Application Details</p>
                <div class="form-grid-2">
                    <div>
                        <p class="form-label">Department</p>
                        <span style="padding:4px 12px;border-radius:8px;background:#faf5ff;color:#7e22ce;font-size:12px;font-weight:700;display:inline-block">{{ $application->department ?? '—' }}</span>
                    </div>
                    <div>
                        <p class="form-label">Type</p>
                        <span style="padding:4px 12px;border-radius:8px;background:#f1f5f9;color:#475569;font-size:12px;font-weight:700;display:inline-block">{{ $application->type ?? '—' }}</span>
                    </div>
                </div>
            </div>
            @if($application->message)
            <div class="form-section">
                <p class="form-section-title">Cover Letter / Message</p>
                <div style="background:#fafbfc;border:1px solid #e8ecf4;border-radius:12px;padding:18px 20px;font-size:13px;color:#374151;line-height:1.75;white-space:pre-wrap">{{ $application->message }}</div>
            </div>
            @endif
            <div style="display:flex;gap:10px;padding-top:12px;border-top:1px solid #f1f5f9">
                <form action="{{ route('admin.career-applications.destroy', $application) }}" method="POST" onsubmit="return confirm('Permanently delete this application?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-primary" style="background:linear-gradient(135deg,#ef4444,#dc2626)">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Delete Application
                    </button>
                </form>
                <a href="{{ route('admin.career-applications') }}" class="btn-cancel">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection
