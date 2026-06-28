@extends('layouts.admin')
@section('title', 'Add Product Item')
@section('subtitle', 'Create a new product or service entry')

@section('content')
<div class="fade-up" style="max-width:860px">
    <a href="{{ route('admin.product-items') }}" class="act-btn" style="color:#64748b;border-color:#e2e8f0;background:#fff;margin-bottom:20px;display:inline-flex">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
        Back to Product Items
    </a>
    <div style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">
        <div style="background:linear-gradient(135deg,#042f2e,#115e59,#0d9488);padding:20px 26px;display:flex;align-items:center;gap:14px;position:relative;overflow:hidden">
            <div style="position:absolute;top:-20px;right:-20px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.05)"></div>
            <div style="width:42px;height:42px;border-radius:13px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            </div>
            <div><p style="font-size:16px;font-weight:800;color:#fff">Add Product Item</p><p style="font-size:12px;color:rgba(153,246,228,.55);margin-top:2px">Products and services displayed on the platform</p></div>
        </div>
        <div style="background:#fff;padding:30px 26px">
            <form action="{{ route('admin.product-items.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-section">
                    <p class="form-section-title">Classification</p>
                    <div class="form-grid-3">
                        <div class="form-group">
                            <label class="form-label">Category <span>*</span></label>
                            <input type="text" name="category" value="{{ old('category') }}" class="form-input" placeholder="e.g. Software" required>
                            @error('category')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Subcategory</label>
                            <input type="text" name="subcategory" value="{{ old('subcategory') }}" class="form-input" placeholder="e.g. Analytics">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Item Type</label>
                            <input type="text" name="item_type" value="{{ old('item_type') }}" class="form-input" placeholder="e.g. SaaS, Tool">
                        </div>
                    </div>
                </div>
                <div class="form-section">
                    <p class="form-section-title">Content</p>
                    <div class="form-group" style="margin-bottom:18px">
                        <label class="form-label">Title <span>*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-input" placeholder="Product or service name" required>
                        @error('title')<p class="form-error-msg">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-input form-textarea" placeholder="Describe this product or service...">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="form-section">
                    <p class="form-section-title">Visuals</p>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-input" accept="image/*" style="padding:7px 14px">
                            <p class="form-hint">PNG or JPG. Max 4MB.</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Icon / Emoji</label>
                            <input type="text" name="icon" value="{{ old('icon') }}" class="form-input" placeholder="e.g. 🔧 or icon name">
                            <p class="form-hint">Emoji or icon identifier for fallback display</p>
                        </div>
                    </div>
                </div>
                <div style="display:flex;gap:12px;padding-top:8px;border-top:1px solid #f1f5f9;margin-top:4px">
                    <button type="submit" class="btn-primary" style="background:linear-gradient(135deg,#0d9488,#0f766e)">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        Add Item
                    </button>
                    <a href="{{ route('admin.product-items') }}" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
