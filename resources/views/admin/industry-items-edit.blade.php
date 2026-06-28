@extends('layouts.admin')
@section('title', 'Edit Industry Item')
@section('subtitle', 'Update industry item details')

@section('content')
<div class="fade-up" style="max-width:760px">
    <a href="{{ route('admin.industry-items') }}" class="act-btn" style="color:#64748b;border-color:#e2e8f0;background:#fff;margin-bottom:20px;display:inline-flex">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
        Back to Industry Items
    </a>
    <div style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">
        <div style="background:linear-gradient(135deg,#0c4a6e,#0369a1,#0891b2);padding:20px 26px;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden">
            <div style="position:absolute;top:-20px;right:-20px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.05)"></div>
            <div style="display:flex;align-items:center;gap:14px">
                <div style="width:42px;height:42px;border-radius:13px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897z"/></svg>
                </div>
                <div><p style="font-size:16px;font-weight:800;color:#fff">Edit — {{ $item->title }}</p><p style="font-size:12px;color:rgba(186,230,253,.55);margin-top:2px">{{ $item->category }}</p></div>
            </div>
            @if($item->image_path)
                <img src="{{ Storage::url($item->image_path) }}" style="width:48px;height:48px;border-radius:10px;object-fit:cover;border:2px solid rgba(255,255,255,.2);position:relative">
            @endif
        </div>
        <div style="background:#fff;padding:30px 26px">
            <form action="{{ route('admin.industry-items.update', $item) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="form-section">
                    <p class="form-section-title">Details</p>
                    <div class="form-grid-2" style="margin-bottom:18px">
                        <div class="form-group">
                            <label class="form-label">Title <span>*</span></label>
                            <input type="text" name="title" value="{{ old('title',$item->title) }}" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Category <span>*</span></label>
                            <input type="text" name="category" value="{{ old('category',$item->category) }}" class="form-input" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-input form-textarea">{{ old('description',$item->description) }}</textarea>
                    </div>
                </div>
                <div class="form-section">
                    <p class="form-section-title">Image</p>
                    <div class="form-group">
                        <label class="form-label">Replace Image</label>
                        @if($item->image_path)<img src="{{ Storage::url($item->image_path) }}" class="img-preview" style="margin-bottom:8px">@endif
                        <input type="file" name="image" class="form-input" accept="image/*" style="padding:7px 14px">
                        <p class="form-hint">Leave blank to keep current</p>
                    </div>
                </div>
                <div style="display:flex;gap:12px;padding-top:8px;border-top:1px solid #f1f5f9;margin-top:4px">
                    <button type="submit" class="btn-primary" style="background:linear-gradient(135deg,#0369a1,#0c4a6e)">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        Save Changes
                    </button>
                    <a href="{{ route('admin.industry-items') }}" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
