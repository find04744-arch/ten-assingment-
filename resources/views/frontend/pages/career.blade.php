@extends('frontend.layout.template')

@section('content')
    <!-- page-title -->
    <div class="ttm-page-title-row ttm-bg ttm-bgimage-yes ttm-bgcolor-darkgrey clearfix">
        <div class="ttm-row-wrapper-bg-layer ttm-bg-layer"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="ttm-page-title-row-inner">
                        <div class="page-title-heading">
                            <h2 class="title">Careers</h2>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span>
                                <a title="Homepage" href="{{ route('home') }}">Home</a>
                            </span>
                            <span>Careers</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-title end -->

    <div class="site-main">

        <!-- ============================================================== -->
        <!-- SECTION 2: WHY WORK WITH US -->
        <!-- ============================================================== -->
        <section class="ttm-row about-section ttm-bgcolor-grey clearfix">
            <div class="container">
                <!-- Row 1: Section Title -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title title-style-center_text mb-5">
                            <div class="title-header">
                                <h5 class="text-skincolor">WHY WORK WITH US</h5>
                                <h2 class="title">Build Your Career at <b>Integra</b></h2>
                            </div>
                            <div class="title-desc">
                                <p>Integra Apparels is more than just a workplace; it's a community where passion meets
                                    craftsmanship. We believe in empowering our people to create the best for the world.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Row 2: Image & Benefits Grid -->
                <div class="row align-items-center">
                    <!-- Left Column: Image -->
                    <div class="col-lg-5 col-md-12">
                        <div class="ttm_single_image-wrapper text-center position-relative mb-4 mb-lg-0 h-100">
                            <div class="ttm-bg-layer-inner border-radius-5 overflow-hidden shadow-lg p-2 bg-white h-100">
                                <img class="img-fluid border-radius-5 w-100 h-100"
                                    style="object-fit: cover; min-height: 400px;"
                                    src="{{ asset('frontend/assets/images/dresses/8.webp') }}" alt="Why Work With Us">
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Benefits Grid -->
                    <div class="col-lg-7 col-md-12">
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 mb-4">
                                    <div class="featured-icon-box style1 p-4 bg-white shadow-sm border-radius-5 h-100 hover-top transition-all text-center"
                                        style="border-top: 4px solid var(--skin-color);">
                                        <div class="featured-icon mb-3">
                                            <div class="ttm-icon ttm-icon_element-color-skincolor ttm-icon_element-size-md bg-grey rounded-circle d-inline-flex align-items-center justify-content-center"
                                                style="width: 70px; height: 70px;">
                                                <i class="ti-shield"></i>
                                            </div>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h5 class="mb-2">Safe Workplace</h5>
                                            </div>
                                            <div class="featured-desc">
                                                <p class="mb-0 text-muted small">We prioritize international safety
                                                    protocols to
                                                    ensure a secure environment for everyone.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 mb-4">
                                    <div class="featured-icon-box style1 p-4 bg-white shadow-sm border-radius-5 h-100 hover-top transition-all text-center"
                                        style="border-top: 4px solid var(--skin-color);">
                                        <div class="featured-icon mb-3">
                                            <div class="ttm-icon ttm-icon_element-color-skincolor ttm-icon_element-size-md bg-grey rounded-circle d-inline-flex align-items-center justify-content-center"
                                                style="width: 70px; height: 70px;">
                                                <i class="ti-stats-up"></i>
                                            </div>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h5 class="mb-2">Career Growth</h5>
                                            </div>
                                            <div class="featured-desc">
                                                <p class="mb-0 text-muted small">Clear promotion pathways and leadership
                                                    grooming
                                                    to help you climb the ladder.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 mb-4">
                                    <div class="featured-icon-box style1 p-4 bg-white shadow-sm border-radius-5 h-100 hover-top transition-all text-center"
                                        style="border-top: 4px solid var(--skin-color);">
                                        <div class="featured-icon mb-3">
                                            <div class="ttm-icon ttm-icon_element-color-skincolor ttm-icon_element-size-md bg-grey rounded-circle d-inline-flex align-items-center justify-content-center"
                                                style="width: 70px; height: 70px;">
                                                <i class="ti-book"></i>
                                            </div>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h5 class="mb-2">Skill Training</h5>
                                            </div>
                                            <div class="featured-desc">
                                                <p class="mb-0 text-muted small">Continuous mentorship programs and
                                                    on-the-job
                                                    training to enhance your skills.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 mb-4">
                                    <div class="featured-icon-box style1 p-4 bg-white shadow-sm border-radius-5 h-100 hover-top transition-all text-center"
                                        style="border-top: 4px solid var(--skin-color);">
                                        <div class="featured-icon mb-3">
                                            <div class="ttm-icon ttm-icon_element-color-skincolor ttm-icon_element-size-md bg-grey rounded-circle d-inline-flex align-items-center justify-content-center"
                                                style="width: 70px; height: 70px;">
                                                <i class="ti-wallet"></i>
                                            </div>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h5 class="mb-2">Fair Wages</h5>
                                            </div>
                                            <div class="featured-desc">
                                                <p class="mb-0 text-muted small">Competitive salaries, timely payments, and
                                                    benefits compliant with labor laws.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>




        <!-- ============================================================== -->
        <!-- SECTION 4: CURRENT JOB OPENINGS -->
        <!-- ============================================================== -->
        <section class="ttm-row clearfix" id="job-openings">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title title-style-center_text">
                            <div class="title-header">
                                <h5 class="text-skincolor">OPPORTUNITIES</h5>
                                <h2 class="title">Current <b>Job Openings</b></h2>
                            </div>
                            <div class="title-desc">
                                <p class="mb-0">Explore exciting career opportunities at Integra Apparels. Find the role
                                    that fits your skills and passion.</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($careerPosts->count() > 0)
                    @foreach ($careerPosts as $category => $posts)
                        <div class="job-category mb-5">
                            <div class="d-flex align-items-center mb-4 pb-2 border-bottom">
                                <div class="ttm-icon ttm-icon_element-color-skincolor ttm-icon_element-size-sm mr-3 bg-grey rounded-circle d-flex align-items-center justify-content-center"
                                    style="width:50px; height:50px;">
                                    <i class="ti-briefcase"></i>
                                </div>
                                <h4 class="mb-0">{{ $category }}</h4>
                            </div>
                            <div class="row">
                                @foreach ($posts as $post)
                                    <div class="col-lg-6 col-md-12 mb-4">
                                        <div class="featured-icon-box style1 p-4 border-radius-5 shadow-sm bg-white hover-top transition-all h-100"
                                            style="border-left: 5px solid var(--skin-color);">
                                            <div class="featured-content">
                                                <div
                                                    class="featured-title d-flex justify-content-between align-items-center mb-3">
                                                    <h5 class="mb-0">{{ $post->title }}</h5>
                                                    <span
                                                        class="badge badge-light text-skincolor px-2 py-1">{{ $post->type }}</span>
                                                </div>
                                                <div class="featured-desc">
                                                    <ul class="list-unstyled mb-3 text-muted small">
                                                        <li class="d-inline-block mr-3"><i
                                                                class="ti-folder mr-1 text-skincolor"></i>
                                                            {{ $post->category }}</li>
                                                        <li class="d-inline-block mr-3"><i
                                                                class="ti-location-pin mr-1 text-skincolor"></i>
                                                            {{ $post->location }}</li>
                                                        <li class="d-inline-block mr-3"><i
                                                                class="ti-time mr-1 text-skincolor"></i>
                                                            {{ $post->experience }}
                                                        </li>
                                                        <li class="d-inline-block"><i
                                                                class="ti-tag mr-1 text-skincolor"></i> {{ $post->type }}
                                                        </li>
                                                    </ul>
                                                    <p class="mb-3 text-dark">{{ Str::limit($post->description, 100) }}</p>
                                                    <a class="ttm-btn btn-inline ttm-btn-size-sm ttm-btn-color-skincolor font-weight-bold"
                                                        href="#apply-form">Apply Now <i
                                                            class="ti-arrow-right ml-1"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12">
                        <div class="alert alert-info text-center">No job openings available at the moment.</div>
                    </div>
                @endif

            </div>
        </section>


        <!-- ============================================================== -->
        <!-- SECTION 5: HOW WE HIRE -->
        <!-- ============================================================== -->



        <!-- ============================================================== -->
        <!-- SECTION 6 & 7: TRAINING & BENEFITS -->
        <!-- ============================================================== -->
        <section class="ttm-row clearfix">
            <div class="container">
                <div class="row">
                    <!-- Training & Growth -->
                    <div class="col-lg-6">
                        <div class="pr-lg-4">
                            <div class="section-title">
                                <div class="title-header">
                                    <h3>GROWTH</h3>
                                    <h2 class="title">Training & <b>Career Growth</b></h2>
                                </div>
                            </div>
                            <div class="mb-4">
                                <!-- Item 1 -->
                                <div class="training-box">
                                    <div class="training-icon">
                                        <i class="ti-blackboard"></i>
                                    </div>
                                    <div class="training-content">
                                        <h5>On-the-Job Training</h5>
                                        <p>Learn while you work with experienced mentors in a hands-on environment.</p>
                                    </div>
                                </div>
                                <!-- Item 2 -->
                                <div class="training-box">
                                    <div class="training-icon">
                                        <i class="ti-ruler-pencil"></i>
                                    </div>
                                    <div class="training-content">
                                        <h5>Skill Development</h5>
                                        <p>Regular workshops on the latest garment technologies and production techniques.
                                        </p>
                                    </div>
                                </div>
                                <!-- Item 3 -->
                                <div class="training-box">
                                    <div class="training-icon">
                                        <i class="ti-medall"></i>
                                    </div>
                                    <div class="training-content">
                                        <h5>Leadership Grooming</h5>
                                        <p>Structured programs to prepare dedicated employees for future management roles.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Benefits -->
                    <div class="col-lg-6">
                        <div class="pl-lg-4 mt-4 mt-lg-0">
                            <div class="section-title">
                                <div class="title-header">
                                    <h3>PERKS</h3>
                                    <h2 class="title">Employee <b>Benefits</b></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="benefit-card">
                                        <div class="benefit-icon">
                                            <i class="ti-wallet"></i>
                                        </div>
                                        <h5>Competitive Salary</h5>
                                        <p class="text-muted mb-0">Market-leading pay structure.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="benefit-card">
                                        <div class="benefit-icon">
                                            <i class="ti-timer"></i>
                                        </div>
                                        <h5>Overtime Benefits</h5>
                                        <p class="text-muted mb-0">Paid OT as per labor laws.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="benefit-card">
                                        <div class="benefit-icon">
                                            <i class="ti-gift"></i>
                                        </div>
                                        <h5>Festival Bonuses</h5>
                                        <p class="text-muted mb-0">Two bonuses every year.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="benefit-card">
                                        <div class="benefit-icon">
                                            <i class="ti-heart"></i>
                                        </div>
                                        <h5>Medical Support</h5>
                                        <p class="text-muted mb-0">Free checkups & medicine.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- ============================================================== -->
        <!-- SECTION 8: INTERNSHIP CALL TO ACTION -->
        <!-- ============================================================== -->
        <section class="ttm-row ttm-bg ttm-bgimage-yes ttm-bgcolor-skincolor clearfix">
            <div class="ttm-row-wrapper-bg-layer ttm-bg-layer"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-9">
                        <div class="section-title mb-0">
                            <div class="title-header">
                                <h3 class="text-white">STUDENTS & GRADUATES</h3>
                                <h2 class="title text-white">Start Your Career With <b>Integra</b></h2>
                            </div>
                            <div class="title-desc">
                                <p class="text-white mb-0">We offer internship opportunities and fresh graduate hiring for
                                    textile students and aspiring professionals. Industrial training programs available.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 text-lg-right mt-4 mt-lg-0">
                        <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-border ttm-btn-color-white"
                            href="#apply-form">Apply For Internship</a>
                    </div>
                </div>
            </div>
        </section>


        <!-- ============================================================== -->
        <!-- SECTION 9: APPLY FORM -->
        <!-- ============================================================== -->
        <section id="apply-form" class="ttm-row ttm-bgcolor-grey clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="section-title title-style-center_text">
                            <div class="title-header">
                                <h3>APPLY NOW</h3>
                                <h2 class="title">Submit Your <b>CV</b></h2>
                            </div>
                            <div class="title-desc">
                                <p>Don't see a matching role? Upload your CV for future opportunities.</p>
                            </div>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="career-apply-form"
                            class="ttm-contactform-2 wrap-form clearfix bg-white p-5 border-radius-5 shadow-lg"
                            method="post" action="{{ route('career.apply') }}" enctype="multipart/form-data"
                            novalidate="novalidate">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label>
                                        <span class="text-input"><input name="name" type="text"
                                                placeholder="Your Name" required="required"></span>
                                    </label>
                                    <span class="text-danger small d-block mt-1" data-error-for="name"></span>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        <span class="text-input"><input name="email" type="email"
                                                placeholder="Your Email" required="required"></span>
                                    </label>
                                    <span class="text-danger small d-block mt-1" data-error-for="email"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>
                                        <span class="text-input"><input name="phone" type="text"
                                                placeholder="Phone Number"></span>
                                    </label>
                                    <span class="text-danger small d-block mt-1" data-error-for="phone"></span>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        <span class="text-input">
                                            <select name="department">
                                                <option value="">Select Department</option>
                                                <option value="Merchandising">Merchandising</option>
                                                <option value="Production">Production</option>
                                                <option value="QA">Quality Assurance</option>
                                                <option value="HR">HR & Admin</option>
                                                <option value="Accounts">Accounts & Finance</option>
                                                <option value="Internship">Internship</option>
                                            </select>
                                        </span>
                                    </label>
                                    <span class="text-danger small d-block mt-1" data-error-for="department"></span>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        <span class="text-input">
                                            <select name="type">
                                                <option value="">Select Employment Type</option>
                                                <option value="Full Time">Full Time</option>
                                                <option value="Part Time">Part Time</option>
                                                <option value="Contract">Contract</option>
                                                <option value="Internship">Internship</option>
                                            </select>
                                        </span>
                                    </label>
                                    <span class="text-danger small d-block mt-1" data-error-for="type"></span>
                                </div>
                            </div>
                            <label>
                                <span class="text-input">
                                    <textarea name="message" rows="3" placeholder="Short Message"></textarea>
                                </span>
                            </label>
                            <label>
                                <span class="text-input"><input name="resume" type="file" accept=".pdf,.doc,.docx"
                                        class="pt-2"></span>
                                <small class="text-muted">Upload CV (PDF/DOC)</small>
                            </label>
                            <span class="text-danger small d-block mt-1" data-error-for="resume"></span>
                            <button
                                class="submit ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor w-100 mt-3"
                                type="submit">Submit Application</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>


        <!-- ============================================================== -->
        <!-- SECTION 8: COMPLIANCE -->
        <!-- ============================================================== -->


        <!-- ============================================================== -->
        <!-- SECTION 9: CONTACT -->
        <!-- ============================================================== -->
        <section class="career-contact-section clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center mb-5">
                            <div class="title-header">
                                <h2 class="title">Get in Touch</h2>
                            </div>
                            <div class="title-desc">
                                <p>Have questions about your application? Our HR team is here to help.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <div class="career-contact-card">
                            <div class="career-contact-icon">
                                <i class="ti-email"></i>
                            </div>
                            <div class="career-contact-title">Email HR</div>
                            <p class="career-contact-text"><a href="mailto:hr@integra-apparels.com"
                                    class="text-dark">hr@integra-apparels.com</a></p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 mb-md-0">
                        <div class="career-contact-card">
                            <div class="career-contact-icon">
                                <i class="ti-headphone-alt"></i>
                            </div>
                            <div class="career-contact-title">Call Us</div>
                            <p class="career-contact-text"><a href="tel:+8801234567890" class="text-dark">+880 1234
                                    567890</a></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="career-contact-card">
                            <div class="career-contact-icon">
                                <i class="ti-location-pin"></i>
                            </div>
                            <div class="career-contact-title">Location</div>
                            <p class="career-contact-text">Gazipur, Dhaka, Bangladesh</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div id="resume-success-modal" class="resume-success-modal">
            <div class="resume-success-toast">
                <div class="resume-success-toast-icon">
                    <i class="ti-check"></i>
                </div>
                <div class="resume-success-toast-content">
                    <h5>Resume Submitted Successfully</h5>
                    <p>Thank you for applying. Our HR team will contact you soon.</p>
                </div>
                <button type="button" class="resume-success-close-btn" id="resume-success-close">&times;</button>
            </div>
        </div>

    </div>
@endsection

@push('script')
    <style>
        .resume-success-modal {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: none;
        }

        .resume-success-modal.show {
            display: block;
        }

        .resume-success-toast {
            background: #ffffff;
            border-radius: 6px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            padding: 15px 20px;
            min-width: 260px;
            max-width: 320px;
            display: flex;
            align-items: flex-start;
            border-left: 4px solid var(--skin-color);
        }

        .resume-success-toast-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--skin-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .resume-success-toast-content h5 {
            margin: 0 0 4px 0;
            font-size: 15px;
        }

        .resume-success-toast-content p {
            margin: 0;
            font-size: 13px;
        }

        .resume-success-close-btn {
            background: transparent;
            border: none;
            color: #888;
            font-size: 18px;
            line-height: 1;
            margin-left: 10px;
            cursor: pointer;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.querySelector('#career-apply-form');
            if (!form) {
                return;
            }

            var toastWrapper = document.getElementById('resume-success-modal');
            var toastClose = document.getElementById('resume-success-close');
            var toastTimeout;

            function showSuccessToast() {
                if (!toastWrapper) return;

                toastWrapper.classList.add('show');

                if (toastTimeout) {
                    clearTimeout(toastTimeout);
                }

                toastTimeout = setTimeout(function() {
                    toastWrapper.classList.remove('show');
                }, 4000);
            }

            if (toastClose && toastWrapper) {
                toastClose.addEventListener('click', function() {
                    toastWrapper.classList.remove('show');
                });
            }

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                var errorSpans = form.querySelectorAll('[data-error-for]');
                errorSpans.forEach(function(span) {
                    span.textContent = '';
                });

                var submitButton = form.querySelector('button[type="submit"]');
                if (submitButton) {
                    submitButton.disabled = true;
                }

                var hasClientError = false;
                var requiredFields = ['name', 'email', 'phone', 'department', 'type', 'resume'];

                requiredFields.forEach(function(field) {
                    var fieldElement = form.querySelector('[name="' + field + '"]');
                    if (!fieldElement) {
                        return;
                    }
                    var value;
                    if (fieldElement.type === 'file') {
                        value = fieldElement.files.length;
                    } else {
                        value = fieldElement.value.trim();
                    }
                    if (!value) {
                        var errorSpan = form.querySelector('[data-error-for="' + field + '"]');
                        if (errorSpan) {
                            errorSpan.textContent = 'This field is required.';
                        }
                        hasClientError = true;
                    }
                });

                if (hasClientError) {
                    if (submitButton) {
                        submitButton.disabled = false;
                    }
                    if (location.hash !== '#apply-form') {
                        location.hash = '#apply-form';
                    }
                    return;
                }

                var formData = new FormData(form);
                var tokenInput = form.querySelector('input[name="_token"]');

                fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': tokenInput ? tokenInput.value : ''
                        },
                        body: formData
                    })
                    .then(function(response) {
                        if (response.ok) {
                            return response.json();
                        }

                        return response.json().then(function(data) {
                            throw {
                                status: response.status,
                                data: data
                            };
                        });
                    })
                    .then(function() {
                        form.reset();
                        if (submitButton) {
                            submitButton.disabled = false;
                        }
                        if (location.hash !== '#apply-form') {
                            location.hash = '#apply-form';
                        }
                        showSuccessToast();
                    })
                    .catch(function(error) {
                        if (submitButton) {
                            submitButton.disabled = false;
                        }

                        if (error.status === 422 && error.data && error.data.errors) {
                            var errors = error.data.errors;
                            Object.keys(errors).forEach(function(key) {
                                var span = form.querySelector('[data-error-for="' + key + '"]');
                                if (span) {
                                    span.textContent = errors[key][0];
                                }
                            });
                            if (location.hash !== '#apply-form') {
                                location.hash = '#apply-form';
                            }
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    });
            });
        });
    </script>
@endpush
