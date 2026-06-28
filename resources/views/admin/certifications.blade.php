@extends('layouts.admin')
@section('title', 'Certifications')
@section('subtitle', 'Manage certificates and accreditations')

@section('content')

<div class="fade-up" style="position:relative;overflow:hidden;border-radius:24px;margin-bottom:28px;background:linear-gradient(135deg,#1e3a8a 0%,#1d4ed8 50%,#2563eb 100%);min-height:140px">
    <div style="position:absolute;inset:0;pointer-events:none;background-image:radial-gradient(rgba(255,255,255,.04) 1px,transparent 1px);background-size:28px 28px"></div>
    <div style="position:absolute;top:-60px;right:-30px;width:280px;height:280px;border-radius:50%;background:radial-gradient(circle,rgba(96,165,250,.2) 0%,transparent 65%);pointer-events:none"></div>
    <div style="position:relative;padding:26px 30px">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px">
            <div style="display:inline-flex;align-items:center;gap:7px;padding:5px 13px;border-radius:99px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12)">
                <span style="width:6px;height:6px;border-radius:50%;background:#60a5fa;flex-shrink:0;animation:ap-pulse 2.5s ease infinite"></span>
                <span style="font-size:11px;font-weight:700;color:rgba(191,219,254,.85);letter-spacing:.12em;text-transform:uppercase">Certifications</span>
            </div>
            <a href="{{ route('admin.certifications.create') }}" style="display:inline-flex;align-items:center;gap:7px;padding:8px 16px;border-radius:11px;font-size:12px;font-weight:700;color:#fff;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.22);text-decoration:none;transition:all .15s" onmouseover="this.style.background='rgba(255,255,255,.25)'" onmouseout="this.style.background='rgba(255,255,255,.15)'">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Add Certification
            </a>
        </div>
        <h1 style="font-size:2rem;font-weight:900;color:#fff;letter-spacing:-.5px">{{ number_format($certifications->total()) }} <span style="font-size:1rem;font-weight:500;color:rgba(191,219,254,.55)">certifications</span></h1>
    </div>
</div>

<div class="fade-up-1" style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">
    <div style="background:linear-gradient(135deg,#1e3a8a,#1d4ed8);padding:16px 22px;display:flex;align-items:center;gap:11px;position:relative;overflow:hidden">
        <div style="position:absolute;top:-24px;right:-16px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.05)"></div>
        <div style="width:36px;height:36px;border-radius:11px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;position:relative">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/></svg>
        </div>
        <p style="font-size:14px;font-weight:700;color:#fff;position:relative">All Certifications</p>
    </div>

    <div style="background:#fff;overflow-x:auto">
        <table style="width:100%;font-size:13px;border-collapse:collapse">
            <thead>
                <tr style="background:linear-gradient(90deg,#eff6ff,#dbeafe)">
                    @foreach(['#','Image','Title','Issued By','Date','Actions'] as $th)
                        <th style="padding:12px 20px;text-align:{{ $loop->last ? 'right' : 'left' }};font-size:10px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.14em;border-bottom:1px solid #e8ecf4">{{ $th }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse($certifications as $cert)
                    <tr style="border-bottom:1px solid #f3f6fb;transition:background .1s" onmouseover="this.style.background='#eff6ff'" onmouseout="this.style.background='transparent'">
                        <td style="padding:13px 20px;color:#cbd5e1;font-size:11px;font-weight:700;width:40px">{{ str_pad($loop->iteration + ($certifications->currentPage()-1)*$certifications->perPage(), 2, '0', STR_PAD_LEFT) }}</td>
                        <td style="padding:13px 20px">
                            @if($cert->image_path)
                                <img src="{{ Storage::url($cert->image_path) }}" alt="{{ $cert->title }}" class="img-preview">
                            @else
                                <div style="width:48px;height:48px;border-radius:12px;background:linear-gradient(135deg,#1d4ed8,#1e40af);display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;font-weight:800">C</div>
                            @endif
                        </td>
                        <td style="padding:13px 20px">
                            <p style="font-weight:700;color:#1e293b">{{ $cert->title }}</p>
                            @if($cert->description)<p style="font-size:11px;color:#94a3b8;margin-top:2px">{{ Str::limit($cert->description, 50) }}</p>@endif
                        </td>
                        <td style="padding:13px 20px;color:#64748b;font-size:12.5px">{{ $cert->issued_by ?? '—' }}</td>
                        <td style="padding:13px 20px;color:#64748b;font-size:12.5px">{{ $cert->issued_at ? \Carbon\Carbon::parse($cert->issued_at)->format('M Y') : '—' }}</td>
                        <td style="padding:13px 20px;text-align:right">
                            <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px">
                                <a href="{{ route('admin.certifications.edit', $cert) }}" class="act-btn" style="color:#1d4ed8;border-color:#bfdbfe;background:#eff6ff" onmouseover="this.style.background='linear-gradient(135deg,#1d4ed8,#1e40af)';this.style.color='#fff';this.style.borderColor='transparent'" onmouseout="this.style.background='#eff6ff';this.style.color='#1d4ed8';this.style.borderColor='#bfdbfe'">
                                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487z"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.certifications.destroy', $cert) }}" method="POST" onsubmit="return confirm('Delete this certification?')">
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
                        <p style="font-size:15px;font-weight:700;color:#1e293b">No certifications yet</p>
                        <a href="{{ route('admin.certifications.create') }}" class="btn-primary" style="background:linear-gradient(135deg,#1d4ed8,#1e40af);margin-top:16px;display:inline-flex">+ Add Certification</a>
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($certifications->hasPages())
        <div style="padding:14px 22px;border-top:1px solid #f1f5f9;background:#f8faff">{{ $certifications->links() }}</div>
    @endif
</div>
@endsection
