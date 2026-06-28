@extends('layouts.admin')
@section('title', 'Edit Job Post')
@section('subtitle', 'Update this career listing')

@section('content')
<div class="fade-up" style="max-width:860px">
    <a href="{{ route('admin.career-posts') }}" class="act-btn" style="color:#64748b;border-color:#e2e8f0;background:#fff;margin-bottom:20px;display:inline-flex">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
        Back to Career Posts
    </a>
    <div style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">
        <div style="background:linear-gradient(135deg,#4c0519,#9f1239,#e11d48);padding:20px 26px;display:flex;align-items:center;gap:14px;position:relative;overflow:hidden">
            <div style="position:absolute;top:-20px;right:-20px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.05)"></div>
            <div style="width:42px;height:42px;border-radius:13px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897z"/></svg>
            </div>
            <div>
                <p style="font-size:16px;font-weight:800;color:#fff">Edit — {{ Str::limit($post->title, 40) }}</p>
                <p style="font-size:12px;color:rgba(253,164,175,.55);margin-top:2px">{{ $post->category }} · {{ $post->type }}</p>
            </div>
        </div>
        <div style="background:#fff;padding:30px 26px">
            <form action="{{ route('admin.career-posts.update', $post) }}" method="POST">
                @csrf @method('PUT')
                <div class="form-section">
                    <p class="form-section-title">Job Overview</p>
                    <div class="form-group" style="margin-bottom:18px">
                        <label class="form-label">Job Title <span>*</span></label>
                        <input type="text" name="title" value="{{ old('title',$post->title) }}" class="form-input" required>
                        @error('title')<p class="form-error-msg">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-grid-3">
                        <div class="form-group">
                            <label class="form-label">Category <span>*</span></label>
                            <input type="text" name="category" value="{{ old('category',$post->category) }}" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Job Type <span>*</span></label>
                            <select name="type" class="form-input form-select" required>
                                @foreach(['Full-time','Part-time','Contract','Freelance','Internship','Remote'] as $t)
                                    <option value="{{ $t }}" {{ old('type',$post->type)==$t?'selected':'' }}>{{ $t }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Experience</label>
                            <input type="text" name="experience" value="{{ old('experience',$post->experience) }}" class="form-input">
                        </div>
                    </div>
                </div>
                <div class="form-section">
                    <p class="form-section-title">Compensation & Location</p>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Salary Range</label>
                            <input type="text" name="salary" value="{{ old('salary',$post->salary) }}" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" value="{{ old('location',$post->location) }}" class="form-input">
                        </div>
                    </div>
                    <div class="form-grid-2" style="margin-top:18px">
                        <div class="form-group">
                            <label class="form-label">Application Deadline</label>
                            <input type="date" name="deadline" value="{{ old('deadline', $post->deadline?->format('Y-m-d')) }}" class="form-input">
                        </div>
                        <div class="form-group" style="justify-content:flex-end;padding-bottom:4px">
                            <label class="form-check" style="margin-top:auto">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active',$post->is_active)?'checked':'' }} style="width:16px;height:16px;accent-color:#e11d48;border-radius:4px">
                                <span style="font-size:13px;font-weight:600;color:#374151">Active listing</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-section">
                    <p class="form-section-title">Job Description</p>
                    <div class="form-group">
                        <label class="form-label">Description <span>*</span></label>
                        <textarea name="description" class="form-input form-textarea" style="min-height:200px" required>{{ old('description',$post->description) }}</textarea>
                        @error('description')<p class="form-error-msg">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div style="display:flex;gap:12px;padding-top:8px;border-top:1px solid #f1f5f9;margin-top:4px">
                    <button type="submit" class="btn-primary" style="background:linear-gradient(135deg,#e11d48,#9f1239)">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        Save Changes
                    </button>
                    <a href="{{ route('admin.career-posts') }}" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
