@extends('layouts.admin')
@section('title', 'Career Posts')
@section('subtitle', 'Manage job listings and career opportunities')

@section('content')
<div class="fade-up" style="position:relative;overflow:hidden;border-radius:24px;margin-bottom:28px;background:linear-gradient(135deg,#4c0519 0%,#9f1239 50%,#e11d48 100%);min-height:140px">
    <div style="position:absolute;inset:0;pointer-events:none;background-image:radial-gradient(rgba(255,255,255,.04) 1px,transparent 1px);background-size:28px 28px"></div>
    <div style="position:relative;padding:26px 30px">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px">
            <div style="display:inline-flex;align-items:center;gap:7px;padding:5px 13px;border-radius:99px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12)">
                <span style="width:6px;height:6px;border-radius:50%;background:#fda4af;flex-shrink:0;animation:ap-pulse 2.5s ease infinite"></span>
                <span style="font-size:11px;font-weight:700;color:rgba(253,164,175,.85);letter-spacing:.12em;text-transform:uppercase">Career Posts</span>
            </div>
            <a href="{{ route('admin.career-posts.create') }}" style="display:inline-flex;align-items:center;gap:7px;padding:8px 16px;border-radius:11px;font-size:12px;font-weight:700;color:#fff;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.22);text-decoration:none;transition:all .15s" onmouseover="this.style.background='rgba(255,255,255,.25)'" onmouseout="this.style.background='rgba(255,255,255,.15)'">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Post a Job
            </a>
        </div>
        <h1 style="font-size:2rem;font-weight:900;color:#fff;letter-spacing:-.5px">{{ number_format($posts->total()) }} <span style="font-size:1rem;font-weight:500;color:rgba(253,164,175,.55)">listings</span></h1>
    </div>
</div>

@if(session('status'))
    <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;padding:12px 18px;margin-bottom:20px;color:#15803d;font-size:13px;font-weight:600">{{ session('status') }}</div>
@endif

<div class="fade-up-1" style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">
    <div style="background:linear-gradient(135deg,#4c0519,#9f1239,#e11d48);padding:16px 22px;display:flex;align-items:center;gap:11px;position:relative;overflow:hidden">
        <div style="position:absolute;top:-24px;right:-16px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.05)"></div>
        <div style="width:36px;height:36px;border-radius:11px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;position:relative">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"/></svg>
        </div>
        <p style="font-size:14px;font-weight:700;color:#fff;position:relative">All Job Listings</p>
    </div>
    <div style="background:#fff;overflow-x:auto">
        <table style="width:100%;font-size:13px;border-collapse:collapse">
            <thead>
                <tr style="background:linear-gradient(90deg,#fff1f2,#ffe4e6)">
                    @foreach(['#','Title','Category / Type','Location','Deadline','Status','Actions'] as $th)
                        <th style="padding:12px 20px;text-align:{{ $loop->last ? 'right' : 'left' }};font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4">{{ $th }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr style="border-bottom:1px solid #f3f6fb;transition:background .1s" onmouseover="this.style.background='#fff1f2'" onmouseout="this.style.background='transparent'">
                        <td style="padding:13px 20px;color:#cbd5e1;font-size:11px;font-weight:700;width:40px">{{ str_pad($loop->iteration + ($posts->currentPage()-1)*$posts->perPage(), 2, '0', STR_PAD_LEFT) }}</td>
                        <td style="padding:13px 20px">
                            <p style="font-weight:700;color:#1e293b">{{ $post->title }}</p>
                            @if($post->experience)<p style="font-size:11px;color:#94a3b8;margin-top:2px">{{ $post->experience }}</p>@endif
                            @if($post->salary)<p style="font-size:11px;color:#16a34a;margin-top:1px;font-weight:600">{{ $post->salary }}</p>@endif
                        </td>
                        <td style="padding:13px 20px">
                            <span style="padding:3px 9px;border-radius:7px;background:#fff1f2;color:#9f1239;font-size:11px;font-weight:700;display:block;width:fit-content;margin-bottom:4px">{{ $post->category }}</span>
                            <span style="padding:2px 8px;border-radius:6px;background:#f1f5f9;color:#475569;font-size:10px;font-weight:700">{{ $post->type }}</span>
                        </td>
                        <td style="padding:13px 20px;color:#475569;font-size:12px">{{ $post->location ?? '—' }}</td>
                        <td style="padding:13px 20px;font-size:12px">
                            @if($post->deadline)
                                @php $expired = $post->deadline->isPast(); @endphp
                                <span style="color:{{ $expired ? '#dc2626' : '#0369a1' }};font-weight:600">{{ $post->deadline->format('d M Y') }}</span>
                                @if($expired)<p style="font-size:10px;color:#dc2626;font-weight:700;margin-top:1px">Expired</p>@endif
                            @else
                                <span style="color:#94a3b8">No deadline</span>
                            @endif
                        </td>
                        <td style="padding:13px 20px">
                            @if($post->is_active)
                                <span style="padding:4px 10px;border-radius:8px;background:#dcfce7;color:#15803d;font-size:11px;font-weight:700">Active</span>
                            @else
                                <span style="padding:4px 10px;border-radius:8px;background:#f1f5f9;color:#64748b;font-size:11px;font-weight:700">Inactive</span>
                            @endif
                        </td>
                        <td style="padding:13px 20px;text-align:right">
                            <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px">
                                <a href="{{ route('admin.career-posts.edit', $post) }}" class="act-btn" style="color:#9f1239;border-color:#fecdd3;background:#fff1f2" onmouseover="this.style.background='linear-gradient(135deg,#e11d48,#9f1239)';this.style.color='#fff';this.style.borderColor='transparent'" onmouseout="this.style.background='#fff1f2';this.style.color='#9f1239';this.style.borderColor='#fecdd3'">
                                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897z"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.career-posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this job post?')">
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
                    <tr><td colspan="7" style="padding:80px 24px;text-align:center">
                        <div style="width:56px;height:56px;border-radius:16px;background:linear-gradient(135deg,#4c0519,#e11d48);display:flex;align-items:center;justify-content:center;margin:0 auto 14px">
                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"/></svg>
                        </div>
                        <p style="font-size:15px;font-weight:700;color:#1e293b">No job posts yet</p>
                        <p style="font-size:13px;color:#94a3b8;margin-top:4px">Create your first career listing</p>
                        <a href="{{ route('admin.career-posts.create') }}" class="btn-primary" style="background:linear-gradient(135deg,#e11d48,#4c0519);margin-top:16px;display:inline-flex">+ Post a Job</a>
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($posts->hasPages())
        <div style="padding:14px 22px;border-top:1px solid #f1f5f9;background:#fff1f2">{{ $posts->links() }}</div>
    @endif
</div>
@endsection
