@extends('layouts.admin')
@section('title', 'Clients')
@section('subtitle', 'Manage partner & client logos')

@section('content')

{{-- Header --}}
<div class="fade-up" style="position:relative;overflow:hidden;border-radius:24px;margin-bottom:28px;background:linear-gradient(135deg,#431407 0%,#7c2d12 35%,#c2410c 70%,#ea580c 100%);min-height:140px">
    <div style="position:absolute;inset:0;pointer-events:none;background-image:radial-gradient(rgba(255,255,255,.04) 1px,transparent 1px);background-size:28px 28px"></div>
    <div style="position:absolute;top:-60px;right:-30px;width:280px;height:280px;border-radius:50%;background:radial-gradient(circle,rgba(251,146,60,.2) 0%,transparent 65%);pointer-events:none"></div>
    <div style="position:relative;padding:26px 30px">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px">
            <div style="display:inline-flex;align-items:center;gap:7px;padding:5px 13px;border-radius:99px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12)">
                <span style="width:6px;height:6px;border-radius:50%;background:#fb923c;flex-shrink:0;animation:ap-pulse 2.5s ease infinite"></span>
                <span style="font-size:11px;font-weight:700;color:rgba(254,215,170,.85);letter-spacing:.12em;text-transform:uppercase">Client Management</span>
            </div>
            <a href="{{ route('admin.clients.create') }}" style="display:inline-flex;align-items:center;gap:7px;padding:8px 16px;border-radius:11px;font-size:12px;font-weight:700;color:#fff;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.22);text-decoration:none;transition:all .15s" onmouseover="this.style.background='rgba(255,255,255,.25)'" onmouseout="this.style.background='rgba(255,255,255,.15)'">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Add Client
            </a>
        </div>
        <h1 style="font-size:2rem;font-weight:900;color:#fff;letter-spacing:-.5px">{{ number_format($clients->total()) }} <span style="font-size:1rem;font-weight:500;color:rgba(254,215,170,.55)">clients</span></h1>
        <p style="font-size:13px;color:rgba(254,215,170,.45);margin-top:6px">Partner logos displayed on the platform</p>
    </div>
</div>

{{-- Table --}}
<div class="fade-up-1" style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">
    <div style="background:linear-gradient(135deg,#431407,#7c2d12,#c2410c);padding:16px 22px;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden">
        <div style="position:absolute;top:-24px;right:-16px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.05);pointer-events:none"></div>
        <div style="display:flex;align-items:center;gap:11px;position:relative">
            <div style="width:36px;height:36px;border-radius:11px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
            </div>
            <div>
                <p style="font-size:14px;font-weight:700;color:#fff">All Clients</p>
                <p style="font-size:11px;color:rgba(254,215,170,.6)">{{ $clients->total() }} total</p>
            </div>
        </div>
    </div>

    <div style="background:#fff;overflow-x:auto">
        <table style="width:100%;font-size:13px;border-collapse:collapse">
            <thead>
                <tr style="background:linear-gradient(90deg,#fff7ed,#fff3e0)">
                    <th style="padding:12px 20px;text-align:left;font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4">#</th>
                    <th style="padding:12px 20px;text-align:left;font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4">Logo</th>
                    <th style="padding:12px 20px;text-align:left;font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4">Name</th>
                    <th style="padding:12px 20px;text-align:left;font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4">Website</th>
                    <th style="padding:12px 20px;text-align:left;font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4">Status</th>
                    <th style="padding:12px 20px;text-align:left;font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4">Added</th>
                    <th style="padding:12px 20px;text-align:right;font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                    <tr style="border-bottom:1px solid #f3f6fb;transition:background .1s" onmouseover="this.style.background='#fff7ed'" onmouseout="this.style.background='transparent'">
                        <td style="padding:13px 20px;color:#cbd5e1;font-size:11px;font-weight:700;width:40px">{{ str_pad($loop->iteration + ($clients->currentPage()-1)*$clients->perPage(), 2, '0', STR_PAD_LEFT) }}</td>
                        <td style="padding:13px 20px">
                            @if($client->logo_path)
                                <img src="{{ Storage::url($client->logo_path) }}" alt="{{ $client->name }}" class="img-preview" style="width:48px;height:48px">
                            @else
                                <div style="width:48px;height:48px;border-radius:12px;background:linear-gradient(135deg,#fb923c,#ea580c);display:flex;align-items:center;justify-content:center;font-size:18px;font-weight:800;color:#fff">{{ strtoupper(substr($client->name,0,1)) }}</div>
                            @endif
                        </td>
                        <td style="padding:13px 20px;font-weight:700;color:#1e293b">{{ $client->name }}</td>
                        <td style="padding:13px 20px">
                            @if($client->website_url)
                                <a href="{{ $client->website_url }}" target="_blank" style="font-size:12px;color:#6366f1;text-decoration:none">{{ Str::limit($client->website_url, 30) }} ↗</a>
                            @else
                                <span style="color:#cbd5e1;font-size:12px">—</span>
                            @endif
                        </td>
                        <td style="padding:13px 20px">
                            <span style="display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:99px;font-size:11px;font-weight:700;{{ $client->status ? 'background:rgba(220,252,231,.8);color:#065f46' : 'background:rgba(241,245,249,.8);color:#94a3b8' }}">
                                <span style="width:5px;height:5px;border-radius:50%;background:{{ $client->status ? '#10b981' : '#cbd5e1' }}"></span>
                                {{ $client->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td style="padding:13px 20px;font-size:12px;color:#64748b">{{ $client->created_at?->format('M j, Y') }}</td>
                        <td style="padding:13px 20px;text-align:right">
                            <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px">
                                <a href="{{ route('admin.clients.edit', $client) }}" class="act-btn" style="color:#ea580c;border-color:#fed7aa;background:#fff7ed" onmouseover="this.style.background='linear-gradient(135deg,#ea580c,#c2410c)';this.style.color='#fff';this.style.borderColor='transparent'" onmouseout="this.style.background='#fff7ed';this.style.color='#ea580c';this.style.borderColor='#fed7aa'">
                                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.clients.destroy', $client) }}" method="POST" onsubmit="return confirm('Delete {{ addslashes($client->name) }}?')">
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
                        <div style="width:64px;height:64px;border-radius:20px;background:linear-gradient(135deg,#fff7ed,#ffedd5);display:flex;align-items:center;justify-content:center;margin:0 auto 16px">
                            <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#ea580c" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18"/></svg>
                        </div>
                        <p style="font-size:15px;font-weight:700;color:#1e293b">No clients yet</p>
                        <p style="font-size:13px;color:#94a3b8;margin-top:5px">Add your first client partner above.</p>
                        <a href="{{ route('admin.clients.create') }}" class="btn-primary" style="background:linear-gradient(135deg,#ea580c,#c2410c);margin-top:16px;display:inline-flex">+ Add Client</a>
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($clients->hasPages())
        <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 22px;border-top:1px solid #f1f5f9;background:#fffaf7">
            <p style="font-size:12px;color:#94a3b8">Showing {{ $clients->firstItem() }}–{{ $clients->lastItem() }} of {{ $clients->total() }}</p>
            {{ $clients->links() }}
        </div>
    @endif
</div>
@endsection
