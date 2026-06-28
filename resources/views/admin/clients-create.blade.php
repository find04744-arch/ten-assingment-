@extends('layouts.admin')
@section('title', 'Add Client')
@section('subtitle', 'Add a new partner client')

@section('content')
<div class="fade-up" style="max-width:760px">
    <a href="{{ route('admin.clients') }}" class="act-btn" style="color:#64748b;border-color:#e2e8f0;background:#fff;margin-bottom:20px;display:inline-flex">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
        Back to Clients
    </a>

    <div style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">
        <div style="background:linear-gradient(135deg,#431407,#7c2d12,#c2410c);padding:20px 26px;display:flex;align-items:center;gap:14px;position:relative;overflow:hidden">
            <div style="position:absolute;top:-20px;right:-20px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.05)"></div>
            <div style="width:42px;height:42px;border-radius:13px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            </div>
            <div>
                <p style="font-size:16px;font-weight:800;color:#fff">Add New Client</p>
                <p style="font-size:12px;color:rgba(254,215,170,.55);margin-top:2px">Partner logos shown in the clients section</p>
            </div>
        </div>

        <div style="background:#fff;padding:30px 26px">
            <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-section">
                    <p class="form-section-title">Client Info</p>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Client Name <span>*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-input" placeholder="e.g. Acme Corporation" required>
                            @error('name')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Website URL</label>
                            <input type="url" name="website_url" value="{{ old('website_url') }}" class="form-input" placeholder="https://example.com">
                            @error('website_url')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <p class="form-section-title">Logo & Status</p>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Logo Image</label>
                            <input type="file" name="logo" class="form-input" accept="image/*" style="padding:7px 14px">
                            <p class="form-hint">PNG, JPG or SVG. Max 2MB.</p>
                            @error('logo')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status <span>*</span></label>
                            <select name="status" class="form-input form-select" required>
                                <option value="1" {{ old('status','1') === '1' ? 'selected' : '' }}>Active — visible on site</option>
                                <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Inactive — hidden</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div style="display:flex;gap:12px;padding-top:8px;border-top:1px solid #f1f5f9;margin-top:4px">
                    <button type="submit" class="btn-primary" style="background:linear-gradient(135deg,#ea580c,#c2410c)">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        Add Client
                    </button>
                    <a href="{{ route('admin.clients') }}" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
