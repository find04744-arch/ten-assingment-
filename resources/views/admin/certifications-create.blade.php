@extends('layouts.admin')
@section('title', 'Add Certification')
@section('subtitle', 'Add a new certificate or accreditation')

@section('content')
<div class="fade-up" style="max-width:760px">
    <a href="{{ route('admin.certifications') }}" class="act-btn" style="color:#64748b;border-color:#e2e8f0;background:#fff;margin-bottom:20px;display:inline-flex">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
        Back to Certifications
    </a>
    <div style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">
        <div style="background:linear-gradient(135deg,#1e3a8a,#1d4ed8);padding:20px 26px;display:flex;align-items:center;gap:14px;position:relative;overflow:hidden">
            <div style="position:absolute;top:-20px;right:-20px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.05)"></div>
            <div style="width:42px;height:42px;border-radius:13px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            </div>
            <div><p style="font-size:16px;font-weight:800;color:#fff">Add Certification</p><p style="font-size:12px;color:rgba(191,219,254,.55);margin-top:2px">Certificates displayed on the platform</p></div>
        </div>
        <div style="background:#fff;padding:30px 26px">
            <form action="{{ route('admin.certifications.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-section">
                    <p class="form-section-title">Certificate Details</p>
                    <div class="form-group" style="margin-bottom:18px">
                        <label class="form-label">Title <span>*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-input" placeholder="e.g. ISO 9001:2015 Certified" required>
                        @error('title')<p class="form-error-msg">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Issued By</label>
                            <input type="text" name="issued_by" value="{{ old('issued_by') }}" class="form-input" placeholder="e.g. International Standards Organization">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Issue Date</label>
                            <input type="date" name="issued_at" value="{{ old('issued_at') }}" class="form-input">
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:18px">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-input form-textarea" placeholder="Brief description of this certification...">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="form-section">
                    <p class="form-section-title">Certificate Image</p>
                    <div class="form-group">
                        <label class="form-label">Upload Image</label>
                        <input type="file" name="image" class="form-input" accept="image/*" style="padding:7px 14px">
                        <p class="form-hint">PNG or JPG. Max 4MB.</p>
                        @error('image')<p class="form-error-msg">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div style="display:flex;gap:12px;padding-top:8px;border-top:1px solid #f1f5f9;margin-top:4px">
                    <button type="submit" class="btn-primary" style="background:linear-gradient(135deg,#1d4ed8,#1e40af)">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        Add Certification
                    </button>
                    <a href="{{ route('admin.certifications') }}" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
