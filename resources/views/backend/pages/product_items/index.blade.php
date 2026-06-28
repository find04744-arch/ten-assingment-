@extends('backend.layout.template')
@section('title')
    Product Items
@endsection
@section('page_subtitle')
    Manage your products and items
@endsection
@section('page_actions')
    <a href="{{ route('admin.product-items.create') }}" class="btn btn-primary">
        <i data-feather="plus"></i> Add Product Item
    </a>
@endsection
@section('body-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>Product Items List</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Type</th>
                                        <th>Gallery Category</th>
                                        <th>Title</th>
                                        <th>Icon</th>
                                        <th>Image</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ ucfirst($item->category) }}</td>
                                            <td>
                                                @if ($item->item_type == 'gallery')
                                                    <span class="badge bg-info">Gallery</span>
                                                @else
                                                    <span class="badge bg-success">Feature</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->item_type == 'gallery')
                                                    {{ $item->subcategory ?: '-' }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $item->title }}</td>
                                            <td>
                                                @if ($item->icon)
                                                    <i class="{{ $item->icon }}"></i> ({{ $item->icon }})
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->image_path)
                                                    <img src="{{ asset('storage/' . $item->image_path) }}" alt=""
                                                        style="height:36px; border-radius: 4px;">
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('admin.product-items.edit', $item) }}"
                                                    class="btn btn-sm btn-outline-primary" title="Edit">
                                                    <i data-feather="edit-2"></i>
                                                </a>
                                                <form action="{{ route('admin.product-items.destroy', $item) }}"
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
