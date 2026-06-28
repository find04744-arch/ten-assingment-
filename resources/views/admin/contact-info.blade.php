@extends('layouts.admin')
@section('title', 'Contact Information')
@section('subtitle', 'Manage contact page content and details')

@section('content')
<div class="fade-up" style="max-width:900px">
    <div style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">
        <div style="background:linear-gradient(135deg,#0f172a,#1e293b,#334155);padding:22px 26px;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden">
            <div style="position:absolute;top:-20px;right:-20px;width:120px;height:120px;border-radius:50%;background:rgba(255,255,255,.04)"></div>
            <div style="display:flex;align-items:center;gap:14px">
                <div style="width:44px;height:44px;border-radius:13px;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#94a3b8" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                </div>
                <div>
                    <p style="font-size:16px;font-weight:800;color:#fff">Contact Information</p>
                    <p style="font-size:12px;color:rgba(148,163,184,.55);margin-top:2px">Singleton settings — changes apply site-wide</p>
                </div>
            </div>
            @if(session('status'))
                <div style="padding:6px 14px;border-radius:10px;background:rgba(34,197,94,.15);border:1px solid rgba(34,197,94,.3);color:#4ade80;font-size:12px;font-weight:700;position:relative">
                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="display:inline;margin-right:4px"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    Saved
                </div>
            @endif
        </div>
        <div style="background:#fff;padding:30px 26px">
            <form action="{{ route('admin.contact-info.update') }}" method="POST">
                @csrf
                <div class="form-section">
                    <p class="form-section-title">Primary Contact</p>
                    <div class="form-grid-3">
                        <div class="form-group">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone',$info->phone) }}" class="form-input" placeholder="+880 1234-567890">
                            @error('phone')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email',$info->email) }}" class="form-input" placeholder="contact@company.com">
                            @error('email')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" value="{{ old('address',$info->address) }}" class="form-input" placeholder="123 Main Street, City">
                        </div>
                    </div>
                </div>
                <div class="form-section">
                    <p class="form-section-title">Social Media</p>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Twitter URL</label>
                            <input type="url" name="twitter_url" value="{{ old('twitter_url',$info->twitter_url) }}" class="form-input" placeholder="https://twitter.com/...">
                            @error('twitter_url')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Facebook URL</label>
                            <input type="url" name="facebook_url" value="{{ old('facebook_url',$info->facebook_url) }}" class="form-input" placeholder="https://facebook.com/...">
                            @error('facebook_url')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-section">
                    <p class="form-section-title">Contact Page Section</p>
                    <div class="form-grid-2" style="margin-bottom:18px">
                        <div class="form-group">
                            <label class="form-label">Section Title</label>
                            <input type="text" name="contact_section_title" value="{{ old('contact_section_title',$info->contact_section_title) }}" class="form-input" placeholder="e.g. Contact Us">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Section Heading</label>
                            <input type="text" name="contact_section_heading" value="{{ old('contact_section_heading',$info->contact_section_heading) }}" class="form-input" placeholder="e.g. Get In Touch">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Section Description</label>
                        <textarea name="contact_section_description" class="form-input form-textarea">{{ old('contact_section_description',$info->contact_section_description) }}</textarea>
                    </div>
                </div>
                <div class="form-section">
                    <p class="form-section-title">Contact Form</p>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Form Title</label>
                            <input type="text" name="form_title" value="{{ old('form_title',$info->form_title) }}" class="form-input" placeholder="e.g. Send a Message">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Form Description</label>
                            <input type="text" name="form_description" value="{{ old('form_description',$info->form_description) }}" class="form-input" placeholder="Short description below the form title">
                        </div>
                    </div>
                </div>
                <div class="form-section">
                    <p class="form-section-title">Office Locations</p>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px">
                        <div style="padding:18px;border-radius:14px;background:#f8fafc;border:1px solid #e8ecf4">
                            <p style="font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:.12em;margin-bottom:14px">Head Office</p>
                            <div class="form-group">
                                <label class="form-label">Office Title</label>
                                <input type="text" name="head_office_title" value="{{ old('head_office_title',$info->head_office_title) }}" class="form-input" placeholder="e.g. Headquarters">
                            </div>
                        </div>
                        <div style="padding:18px;border-radius:14px;background:#f8fafc;border:1px solid #e8ecf4">
                            <p style="font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:.12em;margin-bottom:14px">Branch Office</p>
                            <div class="form-group" style="margin-bottom:12px">
                                <label class="form-label">Branch Title</label>
                                <input type="text" name="branch_office_title" value="{{ old('branch_office_title',$info->branch_office_title) }}" class="form-input" placeholder="e.g. Regional Office">
                            </div>
                            <div class="form-group" style="margin-bottom:12px">
                                <label class="form-label">Branch Address</label>
                                <input type="text" name="branch_office_address" value="{{ old('branch_office_address',$info->branch_office_address) }}" class="form-input">
                            </div>
                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label class="form-label">Branch Phone</label>
                                    <input type="text" name="branch_office_phone" value="{{ old('branch_office_phone',$info->branch_office_phone) }}" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Branch Email</label>
                                    <input type="email" name="branch_office_email" value="{{ old('branch_office_email',$info->branch_office_email) }}" class="form-input">
                                    @error('branch_office_email')<p class="form-error-msg">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-section">
                    <p class="form-section-title">Map Embed</p>
                    <div class="form-group">
                        <label class="form-label">Google Maps Embed Code</label>
                        <textarea name="map_embed" class="form-input form-textarea" placeholder="Paste the full &lt;iframe&gt; embed code from Google Maps here...">{{ old('map_embed',$info->map_embed) }}</textarea>
                        <p class="form-hint">Get this from Google Maps → Share → Embed a map → Copy HTML</p>
                    </div>
                </div>
                <div style="display:flex;gap:12px;padding-top:8px;border-top:1px solid #f1f5f9;margin-top:4px">
                    <button type="submit" class="btn-primary" style="background:linear-gradient(135deg,#334155,#0f172a)">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        Save Contact Info
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
