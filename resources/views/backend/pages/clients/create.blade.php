@extends('backend.layout.template')
@section('title')
    Add Client
@endsection
@section('page_subtitle')
    Create a new client record
@endsection
@section('body-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>New Client Form</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.clients.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Client Logo</label>
                                <input type="file" name="logo_path"
                                    class="form-control @error('logo_path') is-invalid @enderror" accept="image/*" required>
                                <div class="form-text">Maximum file size: 300KB (200–300KB recommended).</div>
                                @error('logo_path')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Website URL</label>
                                <input type="url" name="website_url"
                                    class="form-control @error('website_url') is-invalid @enderror"
                                    value="{{ old('website_url') }}">
                                @error('website_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.clients.index') }}" class="btn btn-light">Cancel</a>
                                <button class="btn btn-primary" type="submit">
                                    <i data-feather="save" class="me-1"></i> Save Client
                                </button>
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
            const imageInput = document.querySelector('input[name="logo_path"]');
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
