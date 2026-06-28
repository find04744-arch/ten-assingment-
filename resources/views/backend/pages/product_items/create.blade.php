@extends('backend.layout.template')
@section('title')
    Add Product Item
@endsection
@section('page_subtitle')
    Create a new product or item
@endsection
@section('body-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>New Product Item Form</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.product-items.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Category <span class="text-danger">*</span></label>
                                <select name="category" class="form-select @error('category') is-invalid @enderror"
                                    required>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>
                                            {{ ucfirst($cat) }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Item Type <span class="text-danger">*</span></label>
                                <select name="item_type" class="form-select @error('item_type') is-invalid @enderror"
                                    required>
                                    <option value="feature" {{ old('item_type') == 'feature' ? 'selected' : '' }}>Feature
                                        Item (Icon + Text + Image)</option>
                                    <option value="gallery" {{ old('item_type') == 'gallery' ? 'selected' : '' }}>Gallery
                                        Image (Image only)</option>
                                </select>
                                @error('item_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3" id="subcategory-field">
                                <label class="form-label">Gallery Category <span class="text-danger">*</span></label>
                                <input type="text" name="subcategory"
                                    class="form-control @error('subcategory') is-invalid @enderror"
                                    value="{{ old('subcategory') }}" list="subcategory-options"
                                    placeholder="e.g. T-Shirts, Party Wear, Jackets & Blazers">
                                <datalist id="subcategory-options">
                                    @foreach ($subcategoriesByCategory as $subs)
                                        @foreach ($subs as $sub)
                                            <option value="{{ $sub }}"></option>
                                        @endforeach
                                    @endforeach
                                </datalist>
                                @error('subcategory')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror" required
                                    placeholder="e.g. Casual Elegance" value="{{ old('title') }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Icon Class</label>
                                <input type="text" name="icon"
                                    class="form-control @error('icon') is-invalid @enderror" placeholder="e.g. fa fa-user"
                                    value="{{ old('icon') }}">
                                <div class="form-text">FontAwesome icon class (e.g. fa fa-user, fa fa-briefcase).</div>
                                @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4"
                                    placeholder="Enter product description...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Product Image</label>
                                <input type="file" name="image_path"
                                    class="form-control @error('image_path') is-invalid @enderror" accept="image/*">
                                <div class="form-text">Recommended dimensions: 600x445 px. Maximum file size: 300KB
                                    (200–300KB recommended).</div>
                                @error('image_path')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.product-items.index') }}" class="btn btn-light">Cancel</a>
                                <button class="btn btn-primary" type="submit">Save Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        (function() {
            const itemTypeSelect = document.querySelector('select[name="item_type"]');
            const subcategoryField = document.getElementById('subcategory-field');
            const subcategoryInput = document.querySelector('input[name="subcategory"]');
            const imageInput = document.querySelector('input[name="image_path"]');

            function syncVisibility() {
                const isGallery = itemTypeSelect && itemTypeSelect.value === 'gallery';
                if (subcategoryField) subcategoryField.style.display = isGallery ? '' : 'none';
                if (subcategoryInput) subcategoryInput.required = isGallery;
            }

            if (itemTypeSelect) {
                itemTypeSelect.addEventListener('change', syncVisibility);
            }

            syncVisibility();

            // Client-side file size guard (300KB)
            if (imageInput) {
                imageInput.addEventListener('change', function() {
                    const file = this.files && this.files[0];
                    if (!file) return;
                    const MAX_BYTES = 300 * 1024; // 300KB
                    if (file.size > MAX_BYTES) {
                        alert('Please upload an image up to 300KB. Your file is ' + Math.ceil(file.size /
                            1024) + 'KB.');
                        this.value = '';
                    }
                });
            }
        })();
    </script>
@endsection
