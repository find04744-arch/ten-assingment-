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
                            <h2 class="title">About Us</h2>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span>
                                <a title="Homepage" href="{{ route('home') }}">Home</a>
                            </span>
                            <span>About Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-title end -->

    <!--site-main start-->
    <div class="site-main">

        <!-- Intro Section -->
        <section class="section-padding bg-white">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="position-relative pr-lg-5">
                            <div class="ttm_single_image-wrapper">
                                <img class="img-fluid rounded shadow-lg"
                                    src="{{ !empty($aboutUs->intro_image_path) ? asset('storage/' . $aboutUs->intro_image_path) : asset('frontend/assets/images/apparel/2.webp') }}"
                                    alt="Garment Manufacturing" style="border-radius: 12px;" />
                            </div>
                            <!-- Experience Badge -->
                            <div class="bg-white p-4 rounded shadow-lg position-absolute d-none d-md-block"
                                style="bottom: 30px; right: 0px; border-left: 5px solid var(--primary-color); max-width: 220px;">
                                <div class="d-flex align-items-center">
                                    <h2 class="fw-bold mb-0 text-primary-custom display-4 mr-3">
                                        {{ $aboutUs->experience_years ?? '25+' }}</h2>
                                    <div class="line-height-1">
                                        <span
                                            class="fw-bold text-dark d-block">{{ \Illuminate\Support\Str::before($aboutUs->experience_title ?? 'YEARS OF EXCELLENCE', ' ') }}</span>
                                        <span
                                            class="small text-muted">{{ \Illuminate\Support\Str::after($aboutUs->experience_title ?? 'YEARS OF EXCELLENCE', ' ') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-xs-12 mt-4 mt-lg-0">
                        <div class="pl-lg-4">
                            <span
                                class="text-primary-custom fw-bold text-uppercase ls-1">{{ $aboutUs->intro_subtitle ?? 'Who We Are' }}</span>
                            <h2 class="title fw-bold mt-2 mb-3" style="color: var(--secondary-color);">
                                {{ $aboutUs->intro_title ?? 'World-Class Apparel Manufacturing' }}
                            </h2>
                            <p class="text-muted lead mb-3">
                                {{ $aboutUs->intro_description_1 ?? 'Integra Apparels is a premier garment manufacturer delivering high-quality fashion solutions to global brands.' }}
                            </p>
                            <p class="text-muted mb-4">
                                {{ $aboutUs->intro_description_2 ?? 'We combine traditional craftsmanship with modern technology to produce garments that meet the highest international standards. Our commitment to sustainability, ethical labor practices, and operational excellence makes us the preferred partner for leading retailers.' }}
                            </p>

                            <div class="row mb-4">
                                @php
                                    $features = $aboutUs->intro_features ?? [
                                        'Advanced Machinery',
                                        'Global Compliance',
                                        'Sustainable Fabrics',
                                        'On-Time Delivery',
                                    ];
                                    $count = count($features);
                                    $chunkSize = ceil($count / 2);
                                    $chunks = $count > 0 ? array_chunk($features, $chunkSize) : [];
                                @endphp
                                @foreach ($chunks as $chunk)
                                    <div class="col-md-6">
                                        <ul class="ttm-list ttm-list-style-icon ttm-list-icon-color-skincolor">
                                            @foreach ($chunk as $feature)
                                                <li class="mb-2"><i class="ti ti-check"></i><span
                                                        class="ttm-list-li-content fw-medium text-secondary">{{ $feature }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>

                            <a href="{{ route('contact.us') }}"
                                class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor">
                                CONTACT US
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission/Vision/Values -->
        <section class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-8 text-center">
                        <span class="text-primary-custom fw-bold text-uppercase">Our Core</span>
                        <h2 class="fw-bold mt-2" style="color: var(--secondary-color);">Mission, Vision & Values</h2>
                    </div>
                </div>
                <div class="row">
                    <!-- Mission -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="feature-card h-100 bg-white shadow-sm p-4 rounded-3 border-0">
                            <div class="feature-icon-box mb-4">
                                <i class="ti-target text-primary-custom fs-1"></i>
                            </div>
                            <h4 class="fw-bold mb-3" style="color: var(--secondary-color);">
                                {{ $aboutUs->mission_title ?? 'Our Mission' }}</h4>
                            <p class="text-muted mb-0">
                                {{ $aboutUs->mission_description ?? 'To revolutionize the garment industry by delivering superior quality apparel through ethical practices, innovation, and sustainability.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Vision -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="feature-card h-100 bg-white shadow-sm p-4 rounded-3 border-0">
                            <div class="feature-icon-box mb-4">
                                <i class="ti-world text-primary-custom fs-1"></i>
                            </div>
                            <h4 class="fw-bold mb-3" style="color: var(--secondary-color);">
                                {{ $aboutUs->vision_title ?? 'Our Vision' }}</h4>
                            <p class="text-muted mb-0">
                                {{ $aboutUs->vision_description ?? 'To be the global benchmark in apparel manufacturing, recognized for our commitment to quality, speed, and social responsibility.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Values -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="feature-card h-100 bg-white shadow-sm p-4 rounded-3 border-0">
                            <div class="feature-icon-box mb-4">
                                <i class="ti-heart text-primary-custom fs-1"></i>
                            </div>
                            <h4 class="fw-bold mb-3" style="color: var(--secondary-color);">
                                {{ $aboutUs->values_title ?? 'Core Values' }}</h4>
                            <p class="text-muted mb-0">
                                {{ $aboutUs->values_description ?? 'Integrity & Transparency, Quality First, Innovation Driven' }}
                            </p>
                            <!-- Legacy List Support (Hidden if description exists) -->
                            @if (empty($aboutUs->values_description) && !empty($aboutUs->values_list))
                                <ul class="list-unstyled text-muted mb-0 pl-0 mt-3">
                                    @foreach ($aboutUs->values_list as $value)
                                        <li class="mb-2"><i
                                                class="ti-check text-primary-custom mr-2"></i>{{ $value }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Mission/Vision Cards End -->

        <!-- Team Section -->
        <section class="section-padding bg-white">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-8 text-center">
                        <span class="text-primary-custom fw-bold text-uppercase">Our Experts</span>
                        <h2 class="fw-bold mt-2" style="color: var(--secondary-color);">Meet The Team</h2>
                        <p class="text-muted">The passionate people behind our success</p>
                    </div>
                </div>
                @php
                    $team = $aboutUs->team_members ?? [];
                @endphp
                @if (!empty($team))
                    <div class="row">
                        @foreach ($team as $member)
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="team-card">
                                    <div class="team-img-wrapper">
                                        <img src="{{ !empty($member['image_path']) ? asset('storage/' . $member['image_path']) : asset('frontend/assets/images/team-member/team-img01.jpg') }}"
                                            class="img-fluid" alt="Team Member">
                                        <div class="team-social-overlay">
                                            <ul class="list-inline mb-0">
                                                @if (!empty($member['facebook']))
                                                    <li class="list-inline-item"><a href="{{ $member['facebook'] }}"><i
                                                                class="ti-facebook"></i></a></li>
                                                @endif
                                                @if (!empty($member['twitter']))
                                                    <li class="list-inline-item"><a href="{{ $member['twitter'] }}"><i
                                                                class="ti-twitter"></i></a></li>
                                                @endif
                                                @if (!empty($member['linkedin']))
                                                    <li class="list-inline-item"><a href="{{ $member['linkedin'] }}"><i
                                                                class="ti-linkedin"></i></a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="team-content">
                                        <h5 class="fw-bold mb-1" style="color: var(--secondary-color);">
                                            {{ $member['name'] ?? 'Team Member' }}</h5>
                                        <span
                                            class="text-primary-custom small fw-bold text-uppercase">{{ $member['role'] ?? '' }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="row">
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="team-card">
                                <div class="team-img-wrapper">
                                    <img src="{{ asset('frontend/assets/images/team-member/team-img01.jpg') }}"
                                        class="img-fluid" alt="Team Member">
                                    <div class="team-social-overlay">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item"><a href="#"><i
                                                        class="ti-facebook"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="ti-twitter"></i></a>
                                            </li>
                                            <li class="list-inline-item"><a href="#"><i
                                                        class="ti-linkedin"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="team-content">
                                    <h5 class="fw-bold mb-1" style="color: var(--secondary-color);">Team Member</h5>
                                    <span class="text-primary-custom small fw-bold text-uppercase">Role</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="team-card">
                                <div class="team-img-wrapper">
                                    <img src="{{ asset('frontend/assets/images/team-member/team-img02.jpg') }}"
                                        class="img-fluid" alt="Team Member">
                                    <div class="team-social-overlay">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item"><a href="#"><i
                                                        class="ti-facebook"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="ti-twitter"></i></a>
                                            </li>
                                            <li class="list-inline-item"><a href="#"><i
                                                        class="ti-linkedin"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="team-content">
                                    <h5 class="fw-bold mb-1" style="color: var(--secondary-color);">Team Member</h5>
                                    <span class="text-primary-custom small fw-bold text-uppercase">Role</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="team-card">
                                <div class="team-img-wrapper">
                                    <img src="{{ asset('frontend/assets/images/team-member/team-img03.jpg') }}"
                                        class="img-fluid" alt="Team Member">
                                    <div class="team-social-overlay">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item"><a href="#"><i
                                                        class="ti-facebook"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="ti-twitter"></i></a>
                                            </li>
                                            <li class="list-inline-item"><a href="#"><i
                                                        class="ti-linkedin"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="team-content">
                                    <h5 class="fw-bold mb-1" style="color: var(--secondary-color);">Team Member</h5>
                                    <span class="text-primary-custom small fw-bold text-uppercase">Role</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="team-card">
                                <div class="team-img-wrapper">
                                    <img src="{{ asset('frontend/assets/images/team-member/team-img04.jpg') }}"
                                        class="img-fluid" alt="Team Member">
                                    <div class="team-social-overlay">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item"><a href="#"><i
                                                        class="ti-facebook"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="ti-twitter"></i></a>
                                            </li>
                                            <li class="list-inline-item"><a href="#"><i
                                                        class="ti-linkedin"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="team-content">
                                    <h5 class="fw-bold mb-1" style="color: var(--secondary-color);">Team Member</h5>
                                    <span class="text-primary-custom small fw-bold text-uppercase">Role</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
        <!-- Team Section End -->



        <!-- CTA Section -->
        <section class="ttm-row cta-section bg-img1 clearfix" style="background-color: #1a1a1a;">
            <div class="container">
                <div class="row align-items-center text-center text-lg-start">
                    <div class="col-lg-9">
                        <h2 class="title fw-bold mb-2 text-white">
                            {{ $aboutUs->cta_title ?? 'Looking for a Reliable Manufacturing Partner?' }}</h2>
                        <p class="mb-0 text-white-50 fs-18">
                            {{ $aboutUs->cta_description ?? "Let's bring your clothing line to life with precision and care." }}
                        </p>
                    </div>
                    <div class="col-lg-3 mt-4 mt-lg-0 text-lg-end">
                        <a href="{{ $aboutUs->cta_button_link ?? '#' }}"
                            class="ttm-btn ttm-btn-size-md ttm-btn-shape-rounded ttm-btn-style-fill ttm-btn-color-skincolor fw-bold">{{ $aboutUs->cta_button_text ?? 'Get a Quote' }}</a>
                    </div>
                </div>
            </div>
        </section>

    </div><!--site-main end-->

    <style>
        :root {
            --primary-color: #0512b2;
            --secondary-color: #2d3238;
            --accent-color: #ff4757;
            --light-bg: #f8f9fa;
        }

        /* General Utils */
        .fs-30 {
            font-size: 30px;
        }

        .text-accent-custom {
            color: var(--accent-color) !important;
        }

        .bg-white-10 {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .opacity-90 {
            opacity: 0.9;
        }

        .rounded-lg {
            border-radius: 15px;
        }

        /* Card Borders */
        .border-top-primary {
            border-top: 4px solid var(--primary-color);
        }

        .border-top-secondary {
            border-top: 4px solid var(--secondary-color);
        }

        .border-top-accent {
            border-top: 4px solid var(--accent-color);
        }

        /* Section Padding */
        .section-padding {
            padding: 80px 0;
        }

        /* Feature Cards (Mission/Vision - Matches Home Theme) */
        .feature-card {
            background: #fff;
            padding: 40px 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            height: 100%;
            position: relative;
            overflow: hidden;
            z-index: 1;
            border: none;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
            z-index: 2;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-icon-box {
            width: 70px;
            height: 70px;
            background: rgba(5, 18, 178, 0.05);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            transition: all 0.4s ease;
        }

        .feature-card:hover .feature-icon-box {
            background: var(--primary-color);
            transform: rotateY(180deg);
        }

        .feature-icon-box i {
            font-size: 32px;
            color: var(--primary-color);
            transition: all 0.4s ease;
        }

        .feature-card:hover .feature-icon-box i {
            color: #fff;
            transform: rotateY(180deg);
        }

        /* Intro Image */
        .intro-img {
            border-radius: 30px 0 30px 0;
            object-fit: cover;
            height: 600px;
            width: 100%;
        }

        @media (max-width: 991px) {
            .intro-img {
                height: 400px;
                margin-bottom: 30px;
            }
        }

        @media (max-width: 575px) {
            .intro-img {
                height: 300px;
            }
        }

        /* Feature Cards (Why Choose Us) */
        .feature-card-2 {
            border: 1px solid #eee;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
            background: #fff;
        }

        .feature-card-2:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-color);
        }

        .feature-card-2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--primary-color);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.4s ease;
        }

        .feature-card-2:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        .feature-number {
            position: absolute;
            top: -25px;
            right: -10px;
            font-size: 100px;
            font-weight: 900;
            color: #f3f3f3;
            line-height: 1;
            transition: all 0.4s ease;
            z-index: 0;
        }

        /* Team Section Styles */
        .team-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.4s ease;
            text-align: center;
            height: 100%;
            border: 1px solid #eee;
            position: relative;
        }

        .team-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
            z-index: 2;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: transparent;
            /* Border replaced by shadow/gradient */
        }

        .team-card:hover::before {
            transform: scaleX(1);
        }

        .team-img-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 12px 12px 0 0;
        }

        .team-img-wrapper img {
            width: 100%;
            height: 320px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .team-card:hover .team-img-wrapper img {
            transform: scale(1.1);
        }

        .team-social-overlay {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.4s ease;
        }

        .team-card:hover .team-social-overlay {
            opacity: 1;
            transform: translateY(0);
        }

        .team-social-overlay ul {
            background: #fff;
            padding: 10px 20px;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin: 0;
        }

        .team-social-overlay ul li a {
            color: var(--secondary-color);
            font-size: 16px;
            margin: 0 8px;
            transition: color 0.3s ease;
        }

        .team-social-overlay ul li a:hover {
            color: var(--primary-color);
        }

        .team-content {
            padding: 25px 20px;
            position: relative;
            z-index: 2;
            background: #fff;
        }
    </style>
@endsection
