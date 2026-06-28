@extends('layouts.admin')
@section('title', 'Add User')
@section('subtitle', 'Create a new user account')

@section('content')
<div class="fade-up" style="max-width:860px">

    <a href="{{ route('admin.users') }}" class="act-btn" style="color:#64748b;border-color:#e2e8f0;background:#fff;margin-bottom:20px;display:inline-flex">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
        Back to Users
    </a>

    <div style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">

        <div style="background:linear-gradient(135deg,#082047,#1040a0,#0369a1);padding:20px 26px;display:flex;align-items:center;gap:14px;position:relative;overflow:hidden">
            <div style="position:absolute;top:-20px;right:-20px;width:120px;height:120px;border-radius:50%;background:rgba(255,255,255,.05);pointer-events:none"></div>
            <div style="width:42px;height:42px;border-radius:13px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"/></svg>
            </div>
            <div>
                <p style="font-size:16px;font-weight:800;color:#fff;letter-spacing:-.2px">Create New User</p>
                <p style="font-size:12px;color:rgba(186,230,253,.55);margin-top:2px">Fill in the details to add a new account</p>
            </div>
        </div>

        <div style="background:#fff;padding:30px 26px">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="form-section">
                    <p class="form-section-title">Account Details</p>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Full Name <span>*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-input" placeholder="e.g. John Doe" required>
                            @error('name')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email Address <span>*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="e.g. john@example.com" required>
                            @error('email')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password <span>*</span></label>
                            <input type="password" name="password" class="form-input" placeholder="Minimum 8 characters" required>
                            @error('password')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirm Password <span>*</span></label>
                            <input type="password" name="password_confirmation" class="form-input" placeholder="Repeat password">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <p class="form-section-title">Role & Subscription</p>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Role <span>*</span></label>
                            <select name="role" class="form-input form-select" required>
                                <option value="user" {{ old('role','user') === 'user' ? 'selected' : '' }}>User</option>
                                <option value="creator" {{ old('role') === 'creator' ? 'selected' : '' }}>Creator</option>
                                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Subscription Status <span>*</span></label>
                            <select name="subscription_status" class="form-input form-select" required>
                                <option value="free" {{ old('subscription_status','free') === 'free' ? 'selected' : '' }}>Free</option>
                                <option value="premium" {{ old('subscription_status') === 'premium' ? 'selected' : '' }}>Premium</option>
                            </select>
                            @error('subscription_status')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <p class="form-section-title">Profile</p>
                    <div class="form-group">
                        <label class="form-label">Bio</label>
                        <textarea name="bio" class="form-input form-textarea" placeholder="Short user bio...">{{ old('bio') }}</textarea>
                        @error('bio')<p class="form-error-msg">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div style="display:flex;align-items:center;gap:12px;padding-top:8px;border-top:1px solid #f1f5f9;margin-top:4px">
                    <button type="submit" class="btn-primary" style="background:linear-gradient(135deg,#0284c7,#0369a1)">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"/></svg>
                        Create User
                    </button>
                    <a href="{{ route('admin.users') }}" class="btn-cancel">Cancel</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
