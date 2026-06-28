@extends('layouts.admin')
@section('title', 'About Us')
@section('subtitle', 'Edit all About Us page content')

@section('content')
<div class="fade-up" style="max-width:960px">
    <div style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">
        <div style="background:linear-gradient(135deg,#2e1065,#5b21b6,#7c3aed);padding:22px 26px;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden">
            <div style="position:absolute;top:-20px;right:-20px;width:120px;height:120px;border-radius:50%;background:rgba(255,255,255,.04)"></div>
            <div style="display:flex;align-items:center;gap:14px">
                <div style="width:44px;height:44px;border-radius:13px;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.18);display:flex;align-items:center;justify-content:center">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#c4b5fd" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
                </div>
                <div>
                    <p style="font-size:16px;font-weight:800;color:#fff">About Us Editor</p>
                    <p style="font-size:12px;color:rgba(196,181,253,.5);margin-top:2px">Singleton — updates the About page content site-wide</p>
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
            <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- ── Intro ── --}}
                <div class="form-section">
                    <p class="form-section-title">Intro Section</p>
                    <div class="form-grid-2" style="margin-bottom:18px">
                        <div class="form-group">
                            <label class="form-label">Subtitle</label>
                            <input type="text" name="intro_subtitle" value="{{ old('intro_subtitle',$about->intro_subtitle) }}" class="form-input" placeholder="e.g. About Our Company">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Heading / Title</label>
                            <input type="text" name="intro_title" value="{{ old('intro_title',$about->intro_title) }}" class="form-input" placeholder="e.g. Who We Are">
                        </div>
                    </div>
                    <div class="form-grid-2" style="margin-bottom:18px">
                        <div class="form-group">
                            <label class="form-label">Experience Badge — Years</label>
                            <input type="number" name="experience_years" value="{{ old('experience_years',$about->experience_years) }}" class="form-input" placeholder="e.g. 10">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Experience Badge — Label</label>
                            <input type="text" name="experience_title" value="{{ old('experience_title',$about->experience_title) }}" class="form-input" placeholder="e.g. Years of Experience">
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom:18px">
                        <label class="form-label">Description Paragraph 1</label>
                        <textarea name="intro_description_1" class="form-input form-textarea">{{ old('intro_description_1',$about->intro_description_1) }}</textarea>
                    </div>
                    <div class="form-group" style="margin-bottom:18px">
                        <label class="form-label">Description Paragraph 2</label>
                        <textarea name="intro_description_2" class="form-input form-textarea">{{ old('intro_description_2',$about->intro_description_2) }}</textarea>
                    </div>
                    <div class="form-group" style="margin-bottom:18px">
                        <label class="form-label">Intro Features <span style="color:#94a3b8;font-weight:400;margin-left:4px">— one per line</span></label>
                        <textarea name="intro_features" class="form-input form-textarea" placeholder="ISO Certified&#10;Global Partner&#10;24/7 Support">{{ old('intro_features', is_array($about->intro_features) ? implode("\n", $about->intro_features) : $about->intro_features) }}</textarea>
                        <p class="form-hint">Each line becomes one feature bullet</p>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Intro Image</label>
                        @if($about->intro_image_path)<img src="{{ Storage::url($about->intro_image_path) }}" class="img-preview" style="margin-bottom:8px;width:120px;height:80px">@endif
                        <input type="file" name="intro_image" class="form-input" accept="image/*" style="padding:7px 14px">
                        <p class="form-hint">Leave blank to keep current image</p>
                    </div>
                </div>

                {{-- ── Mission / Vision / Values ── --}}
                <div class="form-section">
                    <p class="form-section-title">Mission, Vision & Values</p>
                    <div class="form-grid-2" style="margin-bottom:18px">
                        <div>
                            <div class="form-group" style="margin-bottom:12px">
                                <label class="form-label">Mission Title</label>
                                <input type="text" name="mission_title" value="{{ old('mission_title',$about->mission_title) }}" class="form-input" placeholder="Our Mission">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Mission Description</label>
                                <textarea name="mission_description" class="form-input form-textarea">{{ old('mission_description',$about->mission_description) }}</textarea>
                            </div>
                        </div>
                        <div>
                            <div class="form-group" style="margin-bottom:12px">
                                <label class="form-label">Vision Title</label>
                                <input type="text" name="vision_title" value="{{ old('vision_title',$about->vision_title) }}" class="form-input" placeholder="Our Vision">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Vision Description</label>
                                <textarea name="vision_description" class="form-input form-textarea">{{ old('vision_description',$about->vision_description) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom:18px">
                        <label class="form-label">Values Title</label>
                        <input type="text" name="values_title" value="{{ old('values_title',$about->values_title) }}" class="form-input" placeholder="Our Core Values">
                    </div>
                    <div class="form-group" style="margin-bottom:18px">
                        <label class="form-label">Values Description</label>
                        <textarea name="values_description" class="form-input form-textarea">{{ old('values_description',$about->values_description) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Values List <span style="color:#94a3b8;font-weight:400;margin-left:4px">— one per line</span></label>
                        <textarea name="values_list" class="form-input form-textarea" placeholder="Integrity&#10;Innovation&#10;Collaboration&#10;Excellence">{{ old('values_list', is_array($about->values_list) ? implode("\n", $about->values_list) : $about->values_list) }}</textarea>
                    </div>
                </div>

                {{-- ── Why Choose Us ── --}}
                <div class="form-section">
                    <p class="form-section-title">Why Choose Us</p>
                    <div class="form-grid-2" style="margin-bottom:18px">
                        <div class="form-group">
                            <label class="form-label">Subtitle</label>
                            <input type="text" name="why_choose_subtitle" value="{{ old('why_choose_subtitle',$about->why_choose_subtitle) }}" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Title</label>
                            <input type="text" name="why_choose_title" value="{{ old('why_choose_title',$about->why_choose_title) }}" class="form-input">
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom:18px">
                        <label class="form-label">Description</label>
                        <textarea name="why_choose_description" class="form-input form-textarea">{{ old('why_choose_description',$about->why_choose_description) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Feature Points <span style="color:#94a3b8;font-weight:400;margin-left:4px">— one per line</span></label>
                        <textarea name="why_choose_features" class="form-input form-textarea" placeholder="Industry expertise&#10;Client-first approach&#10;Transparent processes">{{ old('why_choose_features', is_array($about->why_choose_features) ? implode("\n", $about->why_choose_features) : $about->why_choose_features) }}</textarea>
                    </div>
                </div>

                {{-- ── CTA ── --}}
                <div class="form-section">
                    <p class="form-section-title">Call-to-Action Banner</p>
                    <div class="form-grid-2" style="margin-bottom:18px">
                        <div class="form-group">
                            <label class="form-label">CTA Title</label>
                            <input type="text" name="cta_title" value="{{ old('cta_title',$about->cta_title) }}" class="form-input" placeholder="Ready to get started?">
                        </div>
                        <div class="form-group">
                            <label class="form-label">CTA Description</label>
                            <input type="text" name="cta_description" value="{{ old('cta_description',$about->cta_description) }}" class="form-input" placeholder="Short supporting sentence">
                        </div>
                    </div>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Button Text</label>
                            <input type="text" name="cta_button_text" value="{{ old('cta_button_text',$about->cta_button_text) }}" class="form-input" placeholder="e.g. Contact Us">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Button Link</label>
                            <input type="text" name="cta_button_link" value="{{ old('cta_button_link',$about->cta_button_link) }}" class="form-input" placeholder="/contact or https://...">
                        </div>
                    </div>
                </div>

                <div style="display:flex;gap:12px;padding-top:8px;border-top:1px solid #f1f5f9;margin-top:4px">
                    <button type="submit" class="btn-primary" style="background:linear-gradient(135deg,#7c3aed,#5b21b6)">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        Save About Us
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
