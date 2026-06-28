@extends('backend.layout.template')
@section('title')
    Edit Career Post
@endsection
@section('page_subtitle')
    Update job opportunity details
@endsection
@section('body-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Career Form</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.careers.update', $career->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Job Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" required
                                        value="{{ old('title', $career->title) }}"
                                        placeholder="e.g. Senior Software Engineer">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Job Category <span class="text-danger">*</span></label>
                                    <select name="category" class="form-control" required>
                                        <option value="">Select Category</option>
                                        @foreach (['Merchandising', 'Production', 'QA/QC', 'HR & Admin', 'IT & Software', 'Marketing', 'Others'] as $cat)
                                            <option value="{{ $cat }}"
                                                {{ old('category', $career->category) == $cat ? 'selected' : '' }}>
                                                {{ $cat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Employment Type <span class="text-danger">*</span></label>
                                    <select name="type" class="form-control" required>
                                        @foreach (['Full Time', 'Part Time', 'Contract', 'Internship'] as $type)
                                            <option value="{{ $type }}"
                                                {{ old('type', $career->type) == $type ? 'selected' : '' }}>
                                                {{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Location</label>
                                    <input type="text" name="location" class="form-control"
                                        value="{{ old('location', $career->location) }}" placeholder="e.g. Gazipur, Dhaka">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Experience</label>
                                    <input type="text" name="experience" class="form-control"
                                        value="{{ old('experience', $career->experience) }}" placeholder="e.g. 5-7 Years">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Salary (Optional)</label>
                                    <input type="text" name="salary" class="form-control"
                                        value="{{ old('salary', $career->salary) }}"
                                        placeholder="e.g. Negotiable or 50k-80k">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Application Deadline (Optional)</label>
                                    <input type="date" name="deadline" class="form-control"
                                        value="{{ old('deadline', $career->deadline ? $career->deadline->format('Y-m-d') : '') }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control" rows="5" required placeholder="Enter job description...">{{ old('description', $career->description) }}</textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                            id="is_active" {{ $career->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active Status</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.careers.index') }}" class="btn btn-light">Cancel</a>
                                <button class="btn btn-primary" type="submit">Update Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
