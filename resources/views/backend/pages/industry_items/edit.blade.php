@extends('backend.layout.template')
@section('title')
    Edit Industry Item
@endsection
@section('page_subtitle')
    Update industry sector or offering
@endsection
@section('body-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Edit Industry Item</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.industry-items.update', $industry_item) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Category <span class="text-danger">*</span></label>
                                    <select name="category" class="form-select @error('category') is-invalid @enderror"
                                        required>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat }}"
                                                {{ old('category', $industry_item->category) === $cat ? 'selected' : '' }}>
                                                {{ ucfirst(str_replace('_', ' ', $cat)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title', $industry_item->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $industry_item->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Image</label>
                                    @if ($industry_item->image_path)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $industry_item->image_path) }}"
                                                alt="Current Image" style="height: 60px; border-radius: 6px;">
                                        </div>
                                    @endif
                                    <input type="file" name="image_path"
                                        class="form-control @error('image_path') is-invalid @enderror" accept="image/*">
                                    <div class="form-text">Leave empty to keep current image.</div>
                                    @error('image_path')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.industry-items.index') }}" class="btn btn-light">Cancel</a>
                                <button class="btn btn-primary" type="submit">
                                    <i data-feather="save" class="me-1"></i> Update Item
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
