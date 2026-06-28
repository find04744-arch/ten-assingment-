@extends('layouts.admin')
@section('title', 'Message Detail')
@section('subtitle', 'Full contact message')

@section('content')
<div class="fade-up" style="max-width:760px">
    <a href="{{ route('admin.contact-messages') }}" class="act-btn" style="color:#64748b;border-color:#e2e8f0;background:#fff;margin-bottom:20px;display:inline-flex">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
        Back to Inbox
    </a>
    <div style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">
        <div style="background:linear-gradient(135deg,#451a03,#92400e,#d97706);padding:22px 26px;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden">
            <div style="position:absolute;top:-20px;right:-20px;width:120px;height:120px;border-radius:50%;background:rgba(255,255,255,.05)"></div>
            <div style="display:flex;align-items:center;gap:14px">
                <div style="width:48px;height:48px;border-radius:14px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;font-size:20px;font-weight:900;color:#fff">{{ strtoupper(substr($message->name,0,1)) }}</div>
                <div>
                    <p style="font-size:16px;font-weight:800;color:#fff">{{ $message->name }}</p>
                    <p style="font-size:12px;color:rgba(252,211,77,.65);margin-top:2px">{{ $message->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
            <a href="mailto:{{ $message->email }}" style="display:inline-flex;align-items:center;gap:6px;padding:8px 14px;border-radius:10px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.22);color:#fff;text-decoration:none;font-size:12px;font-weight:700;position:relative">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                Reply via Email
            </a>
        </div>
        <div style="background:#fff;padding:30px 26px">
            <div class="form-section">
                <p class="form-section-title">Sender Info</p>
                <div class="form-grid-2" style="margin-bottom:14px">
                    <div>
                        <p class="form-label">Email</p>
                        <p style="font-size:13px;color:#1e293b;font-weight:600">{{ $message->email }}</p>
                    </div>
                    <div>
                        <p class="form-label">Phone</p>
                        <p style="font-size:13px;color:#1e293b;font-weight:600">{{ $message->phone ?? '—' }}</p>
                    </div>
                </div>
                @if($message->company_name)
                <div>
                    <p class="form-label">Company</p>
                    <p style="font-size:13px;color:#1e293b;font-weight:600">{{ $message->company_name }}</p>
                </div>
                @endif
            </div>
            <div class="form-section">
                <p class="form-section-title">Message</p>
                @if($message->subject)
                    <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:10px;padding:10px 16px;margin-bottom:14px">
                        <p style="font-size:11px;font-weight:800;color:#92400e;text-transform:uppercase;letter-spacing:.1em;margin-bottom:4px">Subject</p>
                        <p style="font-size:14px;font-weight:700;color:#1e293b">{{ $message->subject }}</p>
                    </div>
                @endif
                <div style="background:#fafbfc;border:1px solid #e8ecf4;border-radius:12px;padding:20px;font-size:14px;color:#374151;line-height:1.8;white-space:pre-wrap">{{ $message->message }}</div>
            </div>
            <div style="display:flex;gap:10px;padding-top:12px;border-top:1px solid #f1f5f9">
                <form action="{{ route('admin.contact-messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Permanently delete this message?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-primary" style="background:linear-gradient(135deg,#ef4444,#dc2626)">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Delete Message
                    </button>
                </form>
                <a href="{{ route('admin.contact-messages') }}" class="btn-cancel">Back to Inbox</a>
            </div>
        </div>
    </div>
</div>
@endsection
