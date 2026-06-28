@extends('layouts.admin')
@section('title', 'Contact Messages')
@section('subtitle', 'Inbox from the contact form')

@section('content')
<div class="fade-up" style="position:relative;overflow:hidden;border-radius:24px;margin-bottom:28px;background:linear-gradient(135deg,#451a03 0%,#92400e 50%,#d97706 100%);min-height:140px">
    <div style="position:absolute;inset:0;pointer-events:none;background-image:radial-gradient(rgba(255,255,255,.04) 1px,transparent 1px);background-size:28px 28px"></div>
    <div style="position:relative;padding:26px 30px">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px">
            <div style="display:inline-flex;align-items:center;gap:7px;padding:5px 13px;border-radius:99px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12)">
                <span style="width:6px;height:6px;border-radius:50%;background:#fcd34d;flex-shrink:0;animation:ap-pulse 2.5s ease infinite"></span>
                <span style="font-size:11px;font-weight:700;color:rgba(252,211,77,.85);letter-spacing:.12em;text-transform:uppercase">Inbox</span>
            </div>
        </div>
        <h1 style="font-size:2rem;font-weight:900;color:#fff;letter-spacing:-.5px">{{ number_format($messages->total()) }} <span style="font-size:1rem;font-weight:500;color:rgba(252,211,77,.55)">messages</span></h1>
    </div>
</div>

@if(session('status'))
    <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;padding:12px 18px;margin-bottom:20px;color:#15803d;font-size:13px;font-weight:600">{{ session('status') }}</div>
@endif

<div class="fade-up-1" style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">
    <div style="background:linear-gradient(135deg,#451a03,#92400e,#d97706);padding:16px 22px;display:flex;align-items:center;gap:11px;position:relative;overflow:hidden">
        <div style="position:absolute;top:-24px;right:-16px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.05)"></div>
        <div style="width:36px;height:36px;border-radius:11px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;position:relative">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
        </div>
        <p style="font-size:14px;font-weight:700;color:#fff;position:relative">All Messages</p>
    </div>
    <div style="background:#fff;overflow-x:auto">
        <table style="width:100%;font-size:13px;border-collapse:collapse">
            <thead>
                <tr style="background:linear-gradient(90deg,#fffbeb,#fef3c7)">
                    @foreach(['#','Sender','Contact','Subject','Received','Actions'] as $th)
                        <th style="padding:12px 20px;text-align:{{ $loop->last ? 'right' : 'left' }};font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4">{{ $th }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                    <tr style="border-bottom:1px solid #f3f6fb;transition:background .1s" onmouseover="this.style.background='#fffbeb'" onmouseout="this.style.background='transparent'">
                        <td style="padding:13px 20px;color:#cbd5e1;font-size:11px;font-weight:700;width:40px">{{ str_pad($loop->iteration + ($messages->currentPage()-1)*$messages->perPage(), 2, '0', STR_PAD_LEFT) }}</td>
                        <td style="padding:13px 20px">
                            <div style="display:flex;align-items:center;gap:10px">
                                <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#92400e,#d97706);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;font-weight:800;flex-shrink:0">{{ strtoupper(substr($msg->name,0,1)) }}</div>
                                <div>
                                    <p style="font-weight:700;color:#1e293b">{{ $msg->name }}</p>
                                    @if($msg->company_name)<p style="font-size:11px;color:#94a3b8;margin-top:1px">{{ $msg->company_name }}</p>@endif
                                </div>
                            </div>
                        </td>
                        <td style="padding:13px 20px">
                            <p style="color:#475569;font-size:12px">{{ $msg->email }}</p>
                            @if($msg->phone)<p style="color:#94a3b8;font-size:11px;margin-top:2px">{{ $msg->phone }}</p>@endif
                        </td>
                        <td style="padding:13px 20px">
                            @if($msg->subject)
                                <p style="color:#1e293b;font-weight:600;font-size:12px">{{ Str::limit($msg->subject, 35) }}</p>
                            @else
                                <span style="color:#94a3b8;font-size:12px">No subject</span>
                            @endif
                            <p style="color:#94a3b8;font-size:11px;margin-top:2px">{{ Str::limit($msg->message, 45) }}</p>
                        </td>
                        <td style="padding:13px 20px;font-size:11px;color:#64748b">{{ $msg->created_at->format('d M Y') }}<br><span style="color:#94a3b8">{{ $msg->created_at->format('H:i') }}</span></td>
                        <td style="padding:13px 20px;text-align:right">
                            <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px">
                                <a href="{{ route('admin.contact-messages.show', $msg) }}" class="act-btn" style="color:#92400e;border-color:#fde68a;background:#fffbeb" onmouseover="this.style.background='linear-gradient(135deg,#d97706,#92400e)';this.style.color='#fff';this.style.borderColor='transparent'" onmouseout="this.style.background='#fffbeb';this.style.color='#92400e';this.style.borderColor='#fde68a'">
                                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    Read
                                </a>
                                <form action="{{ route('admin.contact-messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Delete this message?')">
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
                        <p style="font-size:15px;font-weight:700;color:#1e293b">No messages yet</p>
                        <p style="font-size:13px;color:#94a3b8;margin-top:4px">Messages submitted via the contact form will appear here</p>
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($messages->hasPages())
        <div style="padding:14px 22px;border-top:1px solid #f1f5f9;background:#fffbeb">{{ $messages->links() }}</div>
    @endif
</div>
@endsection
