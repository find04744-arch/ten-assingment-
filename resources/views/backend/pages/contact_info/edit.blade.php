@extends('backend.layout.template')
@section('title')
    Contact Information
@endsection
@section('page_subtitle')
    Manage your contact details, form settings, and map location
@endsection
@section('body-content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Contact Messages</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data_table" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Company</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($messages as $message)
                                        <tr>
                                            <td>{{ $message->created_at->format('Y-m-d H:i') }}</td>
                                            <td>{{ $message->name }}</td>
                                            <td>{{ $message->email }}</td>
                                            <td>{{ $message->phone }}</td>
                                            <td>{{ $message->company_name ?? '-' }}</td>
                                            <td>{{ $message->subject }}</td>
                                            <td title="{{ $message->message }}">{{ Str::limit($message->message, 50) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No messages found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.contact-info.update') }}" method="post" class="needs-validation" novalidate>
            @csrf

            <div class="row">
                <!-- Head Office -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>Head Office Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="head_office_title" class="form-control"
                                    value="{{ old('head_office_title', optional($info)->head_office_title) }}"
                                    placeholder="e.g. Head Office">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address <span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control" rows="3" required placeholder="Physical address">{{ old('address', optional($info)->address) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i data-feather="phone"></i></span>
                                    <input type="text" name="phone" class="form-control"
                                        value="{{ old('phone', optional($info)->phone) }}" required
                                        placeholder="Phone number">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i data-feather="mail"></i></span>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', optional($info)->email) }}" required
                                        placeholder="Email address">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Branch Office -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>Branch Office Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="branch_office_title" class="form-control"
                                    value="{{ old('branch_office_title', optional($info)->branch_office_title) }}"
                                    placeholder="e.g. Branch Office">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="branch_office_address" class="form-control" rows="3" placeholder="Physical address">{{ old('branch_office_address', optional($info)->branch_office_address) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i data-feather="phone"></i></span>
                                    <input type="text" name="branch_office_phone" class="form-control"
                                        value="{{ old('branch_office_phone', optional($info)->branch_office_phone) }}"
                                        placeholder="Phone number">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i data-feather="mail"></i></span>
                                    <input type="email" name="branch_office_email" class="form-control"
                                        value="{{ old('branch_office_email', optional($info)->branch_office_email) }}"
                                        placeholder="Email address">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Map Location</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Map Embed Code <span class="text-danger">*</span></label>
                                <textarea name="map_embed" class="form-control" rows="4" required
                                    placeholder="Paste Google Maps embed iframe code here">{{ old('map_embed', optional($info)->map_embed) }}</textarea>
                                <div class="form-text text-muted">Paste the &lt;iframe&gt; code from Google Maps share
                                    options.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                            <i data-feather="arrow-left" class="me-1"></i> Cancel
                        </a>
                        <button class="btn btn-primary" type="submit">
                            <i data-feather="save" class="me-1"></i> Update Information
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
@endsection
