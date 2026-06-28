@extends('backend.layout.template')
@section('title')
    Add Career Post
@endsection
@section('page_subtitle')
    Create a new job opportunity
@endsection
@section('body-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>New Career Form</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.careers.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Job Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" required
                                        placeholder="e.g. Senior Software Engineer">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Job Category <span class="text-danger">*</span></label>
                                    <select name="category" class="form-control" required>
                                        <option value="">Select Category</option>
                                        <option value="Merchandising">Merchandising</option>
                                        <option value="Production">Production</option>
                                        <option value="QA/QC">QA/QC</option>
                                        <option value="HR & Admin">HR & Admin</option>
                                        <option value="IT & Software">IT & Software</option>
                                        <option value="Marketing">Marketing</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Employment Type <span class="text-danger">*</span></label>
                                    <select name="type" class="form-control" required>
                                        <option value="Full Time">Full Time</option>
                                        <option value="Part Time">Part Time</option>
                                        <option value="Contract">Contract</option>
                                        <option value="Internship">Internship</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Location</label>
                                    <input type="text" name="location" class="form-control"
                                        placeholder="e.g. Gazipur, Dhaka">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Experience</label>
                                    <input type="text" name="experience" class="form-control"
                                        placeholder="e.g. 5-7 Years">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Salary (Optional)</label>
                                    <input type="text" name="salary" class="form-control"
                                        placeholder="e.g. Negotiable or 50k-80k">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Application Deadline (Optional)</label>
                                    <input type="date" name="deadline" class="form-control">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control" rows="5" required placeholder="Enter job description..."></textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                            id="is_active" checked>
                                        <label class="form-check-label" for="is_active">Active Status</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.careers.index') }}" class="btn btn-light">Cancel</a>
                                <button class="btn btn-primary" type="submit">Save Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
