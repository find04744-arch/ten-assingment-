@extends('backend.layout.template')
@section('title')
    Certifications
@endsection
@section('page_subtitle')
    Manage your certifications and awards
@endsection
@section('page_actions')
    <a href="{{ route('admin.certifications.create') }}" class="btn btn-primary">
        <i data-feather="plus"></i> Add Certification
    </a>
@endsection
@section('body-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>Certifications List</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Issued At</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>
                                                @if ($item->image_path)
                                                    <img src="{{ asset('storage/' . $item->image_path) }}" alt=""
                                                        style="height:36px; border-radius: 4px;">
                                                @endif
                                            </td>
                                            <td>{{ optional($item->issued_at)->format('Y-m-d') }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('admin.certifications.edit', $item) }}"
                                                    class="btn btn-sm btn-outline-primary" title="Edit">
                                                    <i data-feather="edit-2"></i>
                                                </a>
                                                <form action="{{ route('admin.certifications.destroy', $item) }}"
                                                    method="post" class="d-inline">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger" title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this item?')">
                                                        <i data-feather="trash-2"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $items->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
