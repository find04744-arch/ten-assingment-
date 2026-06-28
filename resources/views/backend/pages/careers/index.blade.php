@extends('backend.layout.template')
@section('title')
    Careers
@endsection
@section('page_subtitle')
    Manage career posts and incoming applications
@endsection
@section('page_actions')
    <a href="{{ route('admin.careers.create') }}" class="btn btn-primary">
        <i data-feather="plus"></i> Add Career Post
    </a>
@endsection
@section('body-content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0">Careers List</h3>
                            <small class="text-muted">Total: {{ $items->total() }} posts</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Type</th>
                                        <th>Location</th>
                                        <th>Deadline</th>
                                        <th>Status</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>
                                                <div class="fw-bold">{{ $item->title }}</div>
                                                <small class="text-muted">{{ Str::limit($item->description, 50) }}</small>
                                            </td>
                                            <td><span class="badge bg-light text-dark">{{ $item->category }}</span></td>
                                            <td><span class="badge bg-info">{{ $item->type }}</span></td>
                                            <td>{{ $item->location }}</td>
                                            <td>{{ $item->deadline ? $item->deadline->format('d M, Y') : 'N/A' }}</td>
                                            <td><span
                                                    class="badge {{ $item->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $item->is_active ? 'Active' : 'Inactive' }}</span>
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('admin.careers.edit', $item) }}"
                                                    class="btn btn-sm btn-outline-primary" title="Edit">
                                                    <i data-feather="edit-2"></i>
                                                </a>
                                                <form action="{{ route('admin.careers.destroy', $item) }}" method="post"
                                                    class="d-inline">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger" title="Delete"
                                                        onclick="return confirm('Are you sure?')">
                                                        <i data-feather="trash-2"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if ($items->hasPages())
                        <div class="card-footer text-center">
                            <div class="d-flex justify-content-center mt-3">
                                {{ $items->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0">Career Applications</h3>
                            <small class="text-muted">Total: {{ $applications->total() }} applications</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th style="width: 18%;">Name</th>
                                        <th style="width: 22%;">Email</th>
                                        <th style="width: 16%;">Phone</th>
                                        <th style="width: 16%;">Department</th>
                                        <th style="width: 12%;">Type</th>
                                        <th style="width: 16%;">Applied At</th>
                                        <th class="text-end" style="width: 18%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($applications as $application)
                                        <tr>
                                            <td>
                                                <div class="fw-bold">{{ $application->name }}</div>
                                            </td>
                                            <td>
                                                @if ($application->email)
                                                    <a
                                                        href="mailto:{{ $application->email }}">{{ $application->email }}</a>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($application->phone)
                                                    <a href="tel:{{ $application->phone }}">{{ $application->phone }}</a>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($application->department)
                                                    <span class="badge bg-light text-dark">
                                                        {{ $application->department }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($application->type)
                                                    <span class="badge bg-info text-white">
                                                        {{ $application->type }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>{{ $application->created_at?->format('d M, Y H:i') }}</td>
                                            <td class="text-end">
                                                <div class="btn-group btn-group-sm" role="group"
                                                    aria-label="Application actions">
                                                    @if ($application->resume_path)
                                                        <a href="{{ asset('storage/' . $application->resume_path) }}"
                                                            class="btn btn-outline-primary" target="_blank"
                                                            title="View / Download Resume">
                                                            <i data-feather="eye"></i>
                                                        </a>
                                                    @endif
                                                    <form
                                                        action="{{ route('admin.career-applications.destroy', $application) }}"
                                                        method="post" class="d-inline">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-outline-danger" title="Delete Application"
                                                            onclick="return confirm('Are you sure you want to delete this application?')">
                                                            <i data-feather="trash-2"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No applications found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if ($applications->hasPages())
                        <div class="card-footer text-center">
                            <div class="d-flex justify-content-center mt-3">
                                {{ $applications->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
