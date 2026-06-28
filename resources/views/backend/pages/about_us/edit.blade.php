@extends('backend.layout.template')
@section('title')
    About Us
@endsection
@section('page_subtitle')
    Manage content for the About Us page
@endsection
@section('body-content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.about-us.update') }}" method="post" enctype="multipart/form-data">
            @csrf

            <!-- Intro Section -->
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-light">
                    <h3 class="mb-0">Intro Section</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Intro Image</label>
                                <input type="file" name="intro_image_path" class="form-control" accept="image/*">
                                <small class="form-text text-muted">Recommended size: 600x800px. Maximum file size: 300KB
                                    (200–300KB recommended).</small>
                                @if (optional($aboutUs)->intro_image_path)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $aboutUs->intro_image_path) }}" width="150"
                                            class="img-thumbnail rounded">
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Experience Years</label>
                                        <input type="text" name="experience_years" class="form-control" required
                                            value="{{ old('experience_years', optional($aboutUs)->experience_years ?? '25+') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Experience Title</label>
                                        <input type="text" name="experience_title" class="form-control" required
                                            value="{{ old('experience_title', optional($aboutUs)->experience_title ?? 'YEARS OF EXCELLENCE') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Subtitle</label>
                                <input type="text" name="intro_subtitle" class="form-control" required
                                    value="{{ old('intro_subtitle', optional($aboutUs)->intro_subtitle ?? 'Who We Are') }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Title</label>
                                <input type="text" name="intro_title" class="form-control" required
                                    value="{{ old('intro_title', optional($aboutUs)->intro_title ?? 'World-Class Apparel Manufacturing') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="font-weight-bold">Description 1</label>
                                <textarea name="intro_description_1" class="form-control" rows="3">{{ old('intro_description_1', optional($aboutUs)->intro_description_1) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Description 2</label>
                                <textarea name="intro_description_2" class="form-control" rows="3">{{ old('intro_description_2', optional($aboutUs)->intro_description_2) }}</textarea>
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="font-weight-bold mb-0">Intro Features List</label>
                                    <button type="button" class="btn btn-sm btn-success add-intro-feature">
                                        <i class="ik ik-plus"></i> Add Feature
                                    </button>
                                </div>
                                <div id="intro-features-list" class="bg-light p-3 rounded">
                                    @if (isset($aboutUs) && is_array($aboutUs->intro_features))
                                        @foreach ($aboutUs->intro_features as $feature)
                                            <div class="input-group mb-2">
                                                <input type="text" name="intro_features[]" class="form-control"
                                                    value="{{ $feature }}">
                                                <button type="button" class="btn btn-danger remove-row">-</button>
                                            </div>
                                        @endforeach
                                    @endif
                                    <!-- Default empty if none -->
                                    @if (!isset($aboutUs) || empty($aboutUs->intro_features))
                                        <div class="input-group mb-2">
                                            <input type="text" name="intro_features[]" class="form-control"
                                                placeholder="Feature">
                                        </div>
                                    @endif
                                </div>
                                <!-- Button moved to header -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mission / Vision / Values -->
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-light">
                    <h3 class="mb-0">Mission, Vision & Values</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">Mission Title</label>
                                <input type="text" name="mission_title" class="form-control" required
                                    value="{{ old('mission_title', optional($aboutUs)->mission_title ?? 'Our Mission') }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Mission Description</label>
                                <textarea name="mission_description" class="form-control" rows="4">{{ old('mission_description', optional($aboutUs)->mission_description) }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">Vision Title</label>
                                <input type="text" name="vision_title" class="form-control" required
                                    value="{{ old('vision_title', optional($aboutUs)->vision_title ?? 'Our Vision') }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Vision Description</label>
                                <textarea name="vision_description" class="form-control" rows="4">{{ old('vision_description', optional($aboutUs)->vision_description) }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">Values Title</label>
                                <input type="text" name="values_title" class="form-control" required
                                    value="{{ old('values_title', optional($aboutUs)->values_title ?? 'Core Values') }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Values Description</label>
                                <textarea name="values_description" class="form-control" rows="4">{{ old('values_description', optional($aboutUs)->values_description) }}</textarea>
                            </div>
                        </div>
                        <div class="col-12" style="display: none;">
                            <div class="form-group">
                                <label>Core Values List (Deprecated)</label>
                                <div id="values-list">
                                    @if (isset($aboutUs) && is_array($aboutUs->values_list))
                                        @foreach ($aboutUs->values_list as $value)
                                            <div class="input-group mb-2">
                                                <input type="text" name="values_list[]" class="form-control"
                                                    value="{{ $value }}">
                                                <button type="button" class="btn btn-danger remove-row">-</button>
                                            </div>
                                        @endforeach
                                    @endif
                                    @if (!isset($aboutUs) || empty($aboutUs->values_list))
                                        <div class="input-group mb-2">
                                            <input type="text" name="values_list[]" class="form-control"
                                                placeholder="Value">
                                        </div>
                                    @endif
                                </div>
                                <button type="button" class="btn btn-sm btn-success add-value">+ Add Value</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Meet The Team -->
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Meet The Team</h3>
                    <button type="button" class="btn btn-sm btn-success" id="add-team-member"><i
                            class="ik ik-plus"></i> Add Member</button>
                </div>
                <div class="card-body">
                    @php
                        $team = optional($aboutUs)->team_members ?? [];
                        if (!is_array($team)) {
                            $team = [];
                        }
                        if (count($team) === 0) {
                            $team = [
                                [
                                    'name' => '',
                                    'role' => '',
                                    'facebook' => '',
                                    'twitter' => '',
                                    'linkedin' => '',
                                    'image_path' => null,
                                ],
                                [
                                    'name' => '',
                                    'role' => '',
                                    'facebook' => '',
                                    'twitter' => '',
                                    'linkedin' => '',
                                    'image_path' => null,
                                ],
                                [
                                    'name' => '',
                                    'role' => '',
                                    'facebook' => '',
                                    'twitter' => '',
                                    'linkedin' => '',
                                    'image_path' => null,
                                ],
                                [
                                    'name' => '',
                                    'role' => '',
                                    'facebook' => '',
                                    'twitter' => '',
                                    'linkedin' => '',
                                    'image_path' => null,
                                ],
                            ];
                        }
                    @endphp
                    <div id="team-members-wrapper" class="row">
                        @foreach ($team as $index => $member)
                            <div class="col-lg-6 mb-4 team-member-item">
                                <div class="card p-3 border h-100 shadow-sm">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="font-weight-bold text-primary mb-0">Member {{ $index + 1 }}</h6>
                                        <button type="button"
                                            class="btn btn-sm btn-outline-danger remove-team-member">Remove</button>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Photo</label>
                                        <input type="file" name="team_members[{{ $index }}][image]"
                                            class="form-control team-image-input" accept="image/*">
                                        <small class="form-text text-muted">Maximum file size: 300KB (200–300KB
                                            recommended).</small>
                                        @if (!empty($member['image_path']))
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $member['image_path']) }}"
                                                    alt="Member Photo" style="height:80px; border-radius:6px;">
                                            </div>
                                            <input type="hidden" name="team_members[{{ $index }}][image_path]"
                                                value="{{ $member['image_path'] }}">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Name</label>
                                        <input type="text" name="team_members[{{ $index }}][name]"
                                            class="form-control" value="{{ $member['name'] ?? '' }}"
                                            placeholder="e.g. Michael Andrews">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Role</label>
                                        <input type="text" name="team_members[{{ $index }}][role]"
                                            class="form-control" value="{{ $member['role'] ?? '' }}"
                                            placeholder="e.g. CEO & Founder">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Facebook URL</label>
                                                <input type="url" name="team_members[{{ $index }}][facebook]"
                                                    class="form-control" value="{{ $member['facebook'] ?? '' }}"
                                                    placeholder="https://facebook.com/...">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Twitter URL</label>
                                                <input type="url" name="team_members[{{ $index }}][twitter]"
                                                    class="form-control" value="{{ $member['twitter'] ?? '' }}"
                                                    placeholder="https://twitter.com/...">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">LinkedIn URL</label>
                                                <input type="url" name="team_members[{{ $index }}][linkedin]"
                                                    class="form-control" value="{{ $member['linkedin'] ?? '' }}"
                                                    placeholder="https://linkedin.com/in/...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-light">
                    <h3 class="mb-0">CTA Section</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">CTA Title</label>
                                <input type="text" name="cta_title" class="form-control" required
                                    value="{{ old('cta_title', optional($aboutUs)->cta_title ?? 'Looking for a Reliable Manufacturing Partner?') }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">CTA Description</label>
                                <textarea name="cta_description" class="form-control" rows="3">{{ old('cta_description', optional($aboutUs)->cta_description) }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Button Text</label>
                                <input type="text" name="cta_button_text" class="form-control"
                                    value="{{ old('cta_button_text', optional($aboutUs)->cta_button_text ?? 'Get a Quote') }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Button Link</label>
                                <input type="text" name="cta_button_link" class="form-control"
                                    placeholder="e.g. {{ route('contact.us') }}"
                                    value="{{ old('cta_button_link', optional($aboutUs)->cta_button_link ?? '#') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-right mb-5">
                <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Add Intro Feature
            $('.add-intro-feature').click(function() {
                $('#intro-features-list').append(`
                    <div class="input-group mb-2">
                        <input type="text" name="intro_features[]" class="form-control" placeholder="Feature">
                        <button type="button" class="btn btn-danger remove-row">-</button>
                    </div>
                `);
            });

            // Add Value
            $('.add-value').click(function() {
                $('#values-list').append(`
                    <div class="input-group mb-2">
                        <input type="text" name="values_list[]" class="form-control" placeholder="Value">
                        <button type="button" class="btn btn-danger remove-row">-</button>
                    </div>
                `);
            });

            // Remove Row
            $(document).on('click', '.remove-row', function() {
                $(this).closest('.input-group').remove();
            });

            // Team: add member
            $('#add-team-member').on('click', function() {
                const index = $('#team-members-wrapper .team-member-item').length;
                const html = `
                <div class="col-lg-6 mb-4 team-member-item">
                    <div class="card p-3 border h-100 shadow-sm">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="font-weight-bold text-primary mb-0">Member ${index + 1}</h6>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-team-member">Remove</button>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Photo</label>
                            <input type="file" name="team_members[${index}][image]" class="form-control team-image-input" accept="image/*">
                            <small class="form-text text-muted">Maximum file size: 300KB (200–300KB recommended).</small>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Name</label>
                            <input type="text" name="team_members[${index}][name]" class="form-control" placeholder="e.g. John Doe">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Role</label>
                            <input type="text" name="team_members[${index}][role]" class="form-control" placeholder="e.g. CTO">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="font-weight-bold">Facebook URL</label>
                                    <input type="url" name="team_members[${index}][facebook]" class="form-control" placeholder="https://facebook.com/...">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="font-weight-bold">Twitter URL</label>
                                    <input type="url" name="team_members[${index}][twitter]" class="form-control" placeholder="https://twitter.com/...">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="font-weight-bold">LinkedIn URL</label>
                                    <input type="url" name="team_members[${index}][linkedin]" class="form-control" placeholder="https://linkedin.com/in/...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
                $('#team-members-wrapper').append(html);
            });

            // Team: remove member
            $(document).on('click', '.remove-team-member', function() {
                $(this).closest('.team-member-item').remove();
                // reindex names? keeping indexes is fine; backend handles sparse array via iteration
            });

            // Team image size check
            $(document).on('change', '.team-image-input', function() {
                const file = this.files && this.files[0];
                if (!file) return;
                const MAX_BYTES = 300 * 1024;
                if (file.size > MAX_BYTES) {
                    alert('Please upload an image up to 300KB. Your file is ' + Math.ceil(file.size /
                        1024) + 'KB.');
                    this.value = '';
                }
            });

            // Client-side image size check (300KB)
            const imageInput = document.querySelector('input[name="intro_image_path"]');
            if (imageInput) {
                imageInput.addEventListener('change', function() {
                    const file = this.files && this.files[0];
                    if (!file) return;
                    const MAX_BYTES = 300 * 1024; // 300KB
                    if (file.size > MAX_BYTES) {
                        alert('Please upload an image up to 300KB. Your file is ' + Math.ceil(file.size /
                            1024) + 'KB.');
                        this.value = '';
                    }
                });
            }
        });
    </script>
@endsection
