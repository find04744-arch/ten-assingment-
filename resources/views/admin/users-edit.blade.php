@extends('layouts.admin')
@section('title', 'Edit User')
@section('subtitle', 'Update user account details')

@section('content')
<div class="fade-up" style="max-width:860px">

    <a href="{{ route('admin.users') }}" class="act-btn" style="color:#64748b;border-color:#e2e8f0;background:#fff;margin-bottom:20px;display:inline-flex">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
        Back to Users
    </a>

    <div style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">

        <div style="background:linear-gradient(135deg,#082047,#1040a0,#0369a1);padding:20px 26px;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden">
            <div style="position:absolute;top:-20px;right:-20px;width:120px;height:120px;border-radius:50%;background:rgba(255,255,255,.05);pointer-events:none"></div>
            <div style="display:flex;align-items:center;gap:14px">
                <div style="width:42px;height:42px;border-radius:13px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/></svg>
                </div>
                <div>
                    <p style="font-size:16px;font-weight:800;color:#fff;letter-spacing:-.2px">Edit User — {{ $user->name }}</p>
                    <p style="font-size:12px;color:rgba(186,230,253,.55);margin-top:2px">{{ $user->email }} · Joined {{ $user->created_at->format('M j, Y') }}</p>
                </div>
            </div>
            <span style="font-size:11px;font-weight:700;padding:5px 12px;border-radius:99px;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.18);color:rgba(186,230,253,.8);position:relative">
                ID #{{ $user->id }}
            </span>
        </div>

        <div style="background:#fff;padding:30px 26px">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf @method('PUT')

                <div class="form-section">
                    <p class="form-section-title">Account Details</p>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Full Name <span>*</span></label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-input" required>
                            @error('name')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email Address <span>*</span></label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-input" required>
                            @error('email')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">New Password</label>
                            <input type="password" name="password" class="form-input" placeholder="Leave blank to keep current">
                            @error('password')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-input" placeholder="Repeat new password">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <p class="form-section-title">Role & Subscription</p>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Role <span>*</span></label>
                            <select name="role" class="form-input form-select" required>
                                <option value="user" {{ old('role',$user->role) === 'user' ? 'selected' : '' }}>User</option>
                                <option value="creator" {{ old('role',$user->role) === 'creator' ? 'selected' : '' }}>Creator</option>
                                <option value="admin" {{ old('role',$user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Subscription Status <span>*</span></label>
                            <select name="subscription_status" class="form-input form-select" required>
                                <option value="free" {{ old('subscription_status',$user->subscription_status) === 'free' ? 'selected' : '' }}>Free</option>
                                <option value="premium" {{ old('subscription_status',$user->subscription_status) === 'premium' ? 'selected' : '' }}>Premium</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <p class="form-section-title">Profile</p>
                    <div class="form-group">
                        <label class="form-label">Bio</label>
                        <textarea name="bio" class="form-input form-textarea">{{ old('bio', $user->bio) }}</textarea>
                    </div>
                </div>

                <div style="display:flex;align-items:center;gap:12px;padding-top:8px;border-top:1px solid #f1f5f9;margin-top:4px">
                    <button type="submit" class="btn-primary" style="background:linear-gradient(135deg,#0284c7,#0369a1)">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        Save Changes
                    </button>
                    <a href="{{ route('admin.users') }}" class="btn-cancel">Cancel</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
