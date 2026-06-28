@extends('layouts.admin')
@section('title', 'Add Prompt')
@section('subtitle', 'Create a new prompt as admin')

@section('content')
<div class="fade-up" style="max-width:960px">

    <a href="{{ route('admin.prompts') }}" class="act-btn" style="color:#64748b;border-color:#e2e8f0;background:#fff;margin-bottom:20px;display:inline-flex">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
        Back to Prompts
    </a>

    <div style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">

        <div style="background:linear-gradient(135deg,#1a0536,#3b0764,#6d28d9);padding:20px 26px;display:flex;align-items:center;gap:14px;position:relative;overflow:hidden">
            <div style="position:absolute;top:-20px;right:-20px;width:120px;height:120px;border-radius:50%;background:rgba(255,255,255,.05);pointer-events:none"></div>
            <div style="width:42px;height:42px;border-radius:13px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            </div>
            <div>
                <p style="font-size:16px;font-weight:800;color:#fff;letter-spacing:-.2px">Create New Prompt</p>
                <p style="font-size:12px;color:rgba(221,214,254,.55);margin-top:2px">Admin-created prompts can be published immediately</p>
            </div>
        </div>

        <div style="background:#fff;padding:30px 26px">
            <form action="{{ route('admin.prompts.store') }}" method="POST">
                @csrf

                <div class="form-section">
                    <p class="form-section-title">Ownership</p>
                    <div class="form-group">
                        <label class="form-label">Assign to User <span>*</span></label>
                        <select name="user_id" class="form-input form-select" required>
                            <option value="">— Select a user —</option>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>
                                    {{ $u->name }} ({{ $u->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')<p class="form-error-msg">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="form-section">
                    <p class="form-section-title">Basic Info</p>
                    <div class="form-group" style="margin-bottom:18px">
                        <label class="form-label">Title <span>*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-input" placeholder="Enter a descriptive prompt title" required>
                        @error('title')<p class="form-error-msg">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Short Description <span>*</span></label>
                        <textarea name="description" class="form-input form-textarea" style="min-height:80px" placeholder="Brief description of what this prompt does..." required>{{ old('description') }}</textarea>
                        @error('description')<p class="form-error-msg">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="form-section">
                    <p class="form-section-title">Prompt Content</p>
                    <div class="form-group">
                        <label class="form-label">Full Prompt Text <span>*</span></label>
                        <textarea name="content" class="form-input form-textarea" style="min-height:180px" placeholder="Write the complete prompt here..." required>{{ old('content') }}</textarea>
                        @error('content')<p class="form-error-msg">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="form-section">
                    <p class="form-section-title">Classification</p>
                    <div class="form-grid-3">
                        <div class="form-group">
                            <label class="form-label">Category <span>*</span></label>
                            <input type="text" name="category" value="{{ old('category') }}" class="form-input" placeholder="e.g. Writing, Coding" required>
                            @error('category')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">AI Tool</label>
                            <input type="text" name="ai_tool" value="{{ old('ai_tool') }}" class="form-input" placeholder="e.g. GPT-4, Claude">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Difficulty <span>*</span></label>
                            <select name="difficulty_level" class="form-input form-select" required>
                                <option value="beginner" {{ old('difficulty_level','beginner') === 'beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="intermediate" {{ old('difficulty_level') === 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="pro" {{ old('difficulty_level') === 'pro' ? 'selected' : '' }}>Pro</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:18px">
                        <label class="form-label">Tags</label>
                        <input type="text" name="tags" value="{{ old('tags') }}" class="form-input" placeholder="Comma-separated: e.g. productivity, email, business">
                        <p class="form-hint">Separate tags with commas</p>
                    </div>
                </div>

                <div class="form-section">
                    <p class="form-section-title">Publishing</p>
                    <div class="form-grid-3">
                        <div class="form-group">
                            <label class="form-label">Visibility <span>*</span></label>
                            <select name="visibility" class="form-input form-select" required>
                                <option value="public" {{ old('visibility','public') === 'public' ? 'selected' : '' }}>Public</option>
                                <option value="private" {{ old('visibility') === 'private' ? 'selected' : '' }}>Private</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status <span>*</span></label>
                            <select name="status" class="form-input form-select" required>
                                <option value="approved" {{ old('status','approved') === 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="rejected" {{ old('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        <div class="form-group" style="justify-content:flex-end;padding-bottom:4px">
                            <label class="form-label">Featured</label>
                            <label class="form-check">
                                <input type="hidden" name="is_featured" value="0">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                <span class="form-check-label">Mark as Featured</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div style="display:flex;align-items:center;gap:12px;padding-top:8px;border-top:1px solid #f1f5f9;margin-top:4px">
                    <button type="submit" class="btn-primary" style="background:linear-gradient(135deg,#7c3aed,#6d28d9)">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        Publish Prompt
                    </button>
                    <a href="{{ route('admin.prompts') }}" class="btn-cancel">Cancel</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
