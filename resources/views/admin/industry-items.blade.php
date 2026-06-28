@extends('layouts.admin')
@section('title', 'Industry Items')
@section('subtitle', 'Manage industries and sector content')

@section('content')
<div class="fade-up" style="position:relative;overflow:hidden;border-radius:24px;margin-bottom:28px;background:linear-gradient(135deg,#0c4a6e 0%,#0369a1 50%,#0891b2 100%);min-height:140px">
    <div style="position:absolute;inset:0;pointer-events:none;background-image:radial-gradient(rgba(255,255,255,.04) 1px,transparent 1px);background-size:28px 28px"></div>
    <div style="position:relative;padding:26px 30px">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px">
            <div style="display:inline-flex;align-items:center;gap:7px;padding:5px 13px;border-radius:99px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12)">
                <span style="width:6px;height:6px;border-radius:50%;background:#22d3ee;flex-shrink:0;animation:ap-pulse 2.5s ease infinite"></span>
                <span style="font-size:11px;font-weight:700;color:rgba(186,230,253,.85);letter-spacing:.12em;text-transform:uppercase">Industry Items</span>
            </div>
            <a href="{{ route('admin.industry-items.create') }}" style="display:inline-flex;align-items:center;gap:7px;padding:8px 16px;border-radius:11px;font-size:12px;font-weight:700;color:#fff;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.22);text-decoration:none;transition:all .15s" onmouseover="this.style.background='rgba(255,255,255,.25)'" onmouseout="this.style.background='rgba(255,255,255,.15)'">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Add Industry Item
            </a>
        </div>
        <h1 style="font-size:2rem;font-weight:900;color:#fff;letter-spacing:-.5px">{{ number_format($items->total()) }} <span style="font-size:1rem;font-weight:500;color:rgba(186,230,253,.55)">items</span></h1>
    </div>
</div>

<div class="fade-up-1" style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">
    <div style="background:linear-gradient(135deg,#0c4a6e,#0369a1,#0891b2);padding:16px 22px;display:flex;align-items:center;gap:11px;position:relative;overflow:hidden">
        <div style="position:absolute;top:-24px;right:-16px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.05)"></div>
        <div style="width:36px;height:36px;border-radius:11px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;position:relative">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21"/></svg>
        </div>
        <p style="font-size:14px;font-weight:700;color:#fff;position:relative">All Industry Items</p>
    </div>

    <div style="background:#fff;overflow-x:auto">
        <table style="width:100%;font-size:13px;border-collapse:collapse">
            <thead>
                <tr style="background:linear-gradient(90deg,#e0f2fe,#bae6fd)">
                    @foreach(['#','Image','Title','Category','Actions'] as $th)
                        <th style="padding:12px 20px;text-align:{{ $loop->last ? 'right' : 'left' }};font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4">{{ $th }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr style="border-bottom:1px solid #f3f6fb;transition:background .1s" onmouseover="this.style.background='#e0f2fe'" onmouseout="this.style.background='transparent'">
                        <td style="padding:13px 20px;color:#cbd5e1;font-size:11px;font-weight:700;width:40px">{{ str_pad($loop->iteration + ($items->currentPage()-1)*$items->perPage(), 2, '0', STR_PAD_LEFT) }}</td>
                        <td style="padding:13px 20px">
                            @if($item->image_path)
                                <img src="{{ Storage::url($item->image_path) }}" class="img-preview" style="width:44px;height:44px">
                            @else
                                <div style="width:44px;height:44px;border-radius:12px;background:linear-gradient(135deg,#0891b2,#0e7490);display:flex;align-items:center;justify-content:center;color:#fff;font-size:16px;font-weight:800">{{ strtoupper(substr($item->title,0,1)) }}</div>
                            @endif
                        </td>
                        <td style="padding:13px 20px">
                            <p style="font-weight:700;color:#1e293b">{{ $item->title }}</p>
                            @if($item->description)<p style="font-size:11px;color:#94a3b8;margin-top:2px">{{ Str::limit($item->description, 50) }}</p>@endif
                        </td>
                        <td style="padding:13px 20px"><span style="padding:3px 9px;border-radius:7px;background:#e0f2fe;color:#0369a1;font-size:11px;font-weight:700">{{ $item->category }}</span></td>
                        <td style="padding:13px 20px;text-align:right">
                            <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px">
                                <a href="{{ route('admin.industry-items.edit', $item) }}" class="act-btn" style="color:#0369a1;border-color:#bae6fd;background:#e0f2fe" onmouseover="this.style.background='linear-gradient(135deg,#0369a1,#0c4a6e)';this.style.color='#fff';this.style.borderColor='transparent'" onmouseout="this.style.background='#e0f2fe';this.style.color='#0369a1';this.style.borderColor='#bae6fd'">
                                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897z"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.industry-items.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this item?')">
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
                    <tr><td colspan="5" style="padding:80px 24px;text-align:center">
                        <p style="font-size:15px;font-weight:700;color:#1e293b">No industry items yet</p>
                        <a href="{{ route('admin.industry-items.create') }}" class="btn-primary" style="background:linear-gradient(135deg,#0369a1,#0c4a6e);margin-top:16px;display:inline-flex">+ Add Item</a>
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($items->hasPages())
        <div style="padding:14px 22px;border-top:1px solid #f1f5f9;background:#e0f2fe">{{ $items->links() }}</div>
    @endif
</div>
@endsection
