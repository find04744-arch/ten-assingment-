@extends('frontend.layout.template')

@section('content')
    <style>
        :root {
            --primary-color: #0512b2;
            --secondary-color: #2d3238;
            --accent-color: #ff4757;
            --light-bg: #f8f9fa;
        }

        /* Custom Typography & Utils */
        .text-primary-custom {
            color: var(--primary-color) !important;
        }

        .bg-primary-custom {
            background-color: var(--primary-color) !important;
        }

        .section-padding {
            padding: 80px 0;
        }

        .home-feature-section {
            background-color: var(--light-bg);
            padding-top: 60px;
            padding-bottom: 60px;
            margin-top: 0;
            position: relative;
            z-index: 2;
        }

        .fw-bold {
            font-weight: 700 !important;
        }

        .fw-medium {
            font-weight: 500 !important;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            height: 700px;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            color: #fff;
            overflow: hidden;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(rgba(5, 18, 178, 0.6), rgba(45, 50, 56, 0.7));
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-subtitle {
            font-size: 20px;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 15px;
            display: block;
            color: #f1f1f1;
            font-weight: 600;
        }

        .hero-title {
            font-size: 72px;
            line-height: 1.1;
            font-weight: 800;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        /* Feature Cards */
        .feature-card {
            background: #fff;
            padding: 40px 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.4s ease, opacity 0.6s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
            z-index: 1;
            border: none;
            opacity: 0;
            transform: translateY(30px) scale(0.98);
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

        .feature-card.feature-card-visible {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card::after {
            display: none;
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

        .feature-icon {
            font-size: 32px;
            color: var(--primary-color);
            transition: all 0.4s ease;
            line-height: 1;
        }

        .feature-card:hover .feature-icon {
            color: #fff;
            transform: rotateY(180deg);
        }

        .feature-card h4 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--secondary-color);
        }

        .feature-bg-num {
            position: absolute;
            top: -10px;
            right: -10px;
            font-size: 80px;
            font-weight: 900;
            color: rgba(0, 0, 0, 0.03);
            line-height: 1;
            transition: all 0.4s ease;
            z-index: -1;
            font-family: sans-serif;
        }

        .feature-card:hover .feature-bg-num {
            color: rgba(5, 18, 178, 0.06);
            transform: scale(1.1);
        }

        .feature-read-more {
            display: inline-flex;
            align-items: center;
            margin-top: 20px;
            font-weight: 600;
            font-size: 14px;
            color: var(--primary-color);
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .feature-read-more i {
            margin-left: 5px;
            transition: margin-left 0.3s ease;
        }

        .feature-card:hover .feature-read-more i {
            margin-left: 10px;
        }

        /* Product Categories */
        .category-card {
            position: relative;
            height: 500px;
            overflow: hidden;
            border-radius: 12px;
            margin-bottom: 30px;
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .category-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.2, 1, 0.2, 1);
        }

        .category-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.9), transparent);
            padding: 40px 30px;
            transition: all 0.4s ease;
        }

        .category-card:hover .category-img {
            transform: scale(1.05);
        }

        .category-title {
            color: #fff;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .category-btn {
            display: inline-block;
            color: #fff;
            text-transform: uppercase;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 1px;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.4s ease 0.1s;
            border-bottom: 2px solid var(--accent-color);
            padding-bottom: 5px;
        }

        .category-card:hover .category-btn {
            opacity: 1;
            transform: translateY(0);
        }

        /* Process Section */
        .process-step {
            text-align: center;
            position: relative;
            padding: 20px;
        }

        .process-icon-box {
            position: relative;
            width: 100px;
            height: 100px;
            margin: 0 auto 25px;
            z-index: 2;
        }

        .process-icon {
            width: 100%;
            height: 100%;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: var(--primary-color);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .process-step:hover .process-icon {
            background: var(--primary-color);
            color: #fff;
            transform: scale(1.1);
        }

        .process-arrow {
            position: absolute;
            top: 50px;
            right: -50%;
            width: 100%;
            height: 2px;
            background: #e9ecef;
            z-index: 1;
        }

        .process-arrow::after {
            content: '';
            position: absolute;
            right: 0;
            top: -4px;
            width: 10px;
            height: 10px;
            border-top: 2px solid #e9ecef;
            border-right: 2px solid #e9ecef;
            transform: rotate(45deg);
        }

        .process-step:last-child .process-arrow {
            display: none;
        }

        /* Stats Section */
        .stats-section {
            background: linear-gradient(rgba(5, 18, 178, 0.85), rgba(45, 50, 56, 0.9)), url('{{ asset('frontend/assets/images/pattern-bg.png') }}');
            background-size: cover;
            background-attachment: fixed;
            color: #fff;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }

        .stats-bg-pattern {
            display: none;
        }

        .stat-item {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px 20px;
            border-radius: 12px;
            height: 100%;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .stat-item:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .stat-item i {
            font-size: 48px;
            color: var(--accent-color);
            margin-bottom: 20px;
            display: inline-block;
            transition: transform 0.3s ease;
        }

        .stat-item:hover i {
            transform: scale(1.1) rotate(5deg);
        }

        .stat-item h2 {
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 10px;
            line-height: 1;
            color: #fff;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .stat-item p {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 700;
            margin-bottom: 0;
        }

        /* Industries */
        .industry-card {
            display: block;
            background: #fff;
            padding: 30px;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid #eee;
            height: 100%;
        }

        .industry-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-color);
        }

        .industry-icon {
            font-size: 40px;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .industry-card h4 {
            color: var(--secondary-color);
            font-size: 20px;
            font-weight: 700;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .hero-title {
                font-size: 48px;
            }

            .hero-section {
                height: 600px;
            }

            .process-arrow {
                display: none;
            }

            .category-card {
                height: 350px;
            }
        }

        @media (max-width: 767px) {
            .hero-title {
                font-size: 36px;
            }

            .hero-section {
                height: 500px;
                text-align: center;
            }

            .hero-content .d-flex {
                justify-content: center;
            }

            .section-padding {
                padding: 50px 0;
            }
        }
    </style>

    <!-- Hero Section -->
    <div class="hero-section"
        style="background-image: url('{{ asset('frontend/assets/images/apparel/27.webp') }}');">
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <div class="row">
                <div class="col-lg-9">
                    <span class="hero-subtitle text-white" data-animation="fadeInDown"
                        style="color: #ffffff !important;">Redefining Apparel Manufacturing</span>
                    <h1 class="hero-title text-white" data-animation="fadeInUp" style="color: #ffffff !important;">Crafting
                        The Future<br>Of Global Fashion</h1>
                    <p class="mb-5 lead text-white"
                        style="max-width: 700px; font-size: 20px; font-weight: 500; opacity: 1; color: #ffffff !important; text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">
                        Empowering brands with sustainable production, superior quality, and on-time delivery. Your vision,
                        our expertise—seamlessly integrated to create world-class garments.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('contact.us') }}"
                            class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor margin_right15">
                            GET A QUOTE
                        </a>
                        <a href="#products"
                            class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-border ttm-btn-color-white">
                            VIEW COLLECTIONS
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section class="section-padding home-feature-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <span class="feature-bg-num">01</span>
                        <div class="feature-icon-box">
                            <i class="feature-icon flaticon-sewing-machine"></i>
                        </div>
                        <h4>Advanced Manufacturing</h4>
                        <p class="text-muted mb-4">State-of-the-art machinery ensuring precision stitching and consistent
                            quality for bulk orders.</p>
                        <a href="{{ route('about.us') }}" class="feature-read-more">Read More <i
                                class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <span class="feature-bg-num">02</span>
                        <div class="feature-icon-box">
                            <i class="feature-icon ti-world"></i>
                        </div>
                        <h4>Global Export Ready</h4>
                        <p class="text-muted mb-4">Seamless logistics network delivering to Europe, USA, and Asia with full
                            compliance documentation.</p>
                        <a href="{{ route('contact.us') }}" class="feature-read-more">Read More <i
                                class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <span class="feature-bg-num">03</span>
                        <div class="feature-icon-box">
                            <i class="feature-icon fa fa-leaf"></i>
                        </div>
                        <h4>Sustainable Practices</h4>
                        <p class="text-muted mb-4">Eco-friendly dyeing, waste reduction, and ethical labor practices
                            certified by global standards.</p>
                        <a href="{{ route('certifications') }}" class="feature-read-more">Read More <i
                                class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About/Capabilities Section -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="pr-lg-5">
                        <span class="text-primary-custom fw-bold text-uppercase ls-1">Who We Are</span>
                        <h3 class="mb-4 mt-2 fw-bold" style="color: var(--secondary-color);">Your Trusted Partner
                            in<br>Garment Production</h3>
                        <p class="text-muted mb-4" style="line-height: 1.8;">
                            With over two decades of experience, we specialize in knitting, dyeing, and garment
                            manufacturing.
                            Our vertically integrated facility ensures total control over quality and timelines, making us
                            the preferred choice for leading international brands.
                        </p>

                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <ul class="ttm-list ttm-list-style-icon ttm-list-icon-color-skincolor">
                                    <li><i class="ti ti-check"></i><span class="ttm-list-li-content">Custom Fabric
                                            Development</span></li>
                                    <li><i class="ti ti-check"></i><span class="ttm-list-li-content">Private Label
                                            Manufacturing</span></li>
                                </ul>
                            </div>
                            <div class="col-md-6 mb-3">
                                <ul class="ttm-list ttm-list-style-icon ttm-list-icon-color-skincolor">
                                    <li><i class="ti ti-check"></i><span class="ttm-list-li-content">Oeko-Tex
                                            Certified</span></li>
                                    <li><i class="ti ti-check"></i><span class="ttm-list-li-content">Fast Turnaround
                                            Time</span></li>
                                </ul>
                            </div>
                        </div>

                        <a href="{{ route('about.us') }}"
                            class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-border ttm-btn-color-dark margin_top20">
                            MORE ABOUT US
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-6">
                            <img src="{{ asset('frontend/assets/images/apparel/30.webp') }}"
                                class="img-fluid rounded shadow-lg mb-4" alt="Production">
                            <img src="{{ asset('frontend/assets/images/apparel/31.webp') }}"
                                class="img-fluid rounded shadow-lg" alt="Fabric">
                        </div>
                        <div class="col-6 mt-5">
                            <img src="{{ asset('frontend/assets/images/apparel/32.webp') }}"
                                class="img-fluid rounded shadow-lg" alt="Quality">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Industries Section -->
    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <span class="text-primary-custom fw-bold text-uppercase">Our Expertise</span>
                    <h2 class="fw-bold mt-2" style="color: var(--secondary-color);">Industries We Serve</h2>
                    <p class="text-muted">Specialized solutions across the textile value chain</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <!-- Apparels -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('industries.apparels') }}" class="industry-card text-decoration-none">
                        <div class="industry-icon">
                            {{-- <i class="flaticon flaticon-textile"></i> --}}
                        </div>
                        <h4 class="mt-3">Apparels</h4>
                        <p class="text-muted small">Comprehensive apparel manufacturing solutions.</p>
                    </a>
                </div>
                <!-- Design -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('industries.design') }}" class="industry-card text-decoration-none">
                        <div class="industry-icon">
                            <i class="flaticon flaticon-designer"></i>
                        </div>
                        <h4 class="mt-3">Design Studio</h4>
                        <p class="text-muted small">Creative fashion design & prototyping.</p>
                    </a>
                </div>
                <!-- Dresses -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('industries.dresses') }}" class="industry-card text-decoration-none">
                        <div class="industry-icon">
                            <i class="flaticon flaticon-dress"></i>
                        </div>
                        <h4 class="mt-3">Dresses</h4>
                        <p class="text-muted small">Premium dress production for all occasions.</p>
                    </a>
                </div>
                <!-- Washing Plant -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('industries.washingplant') }}" class="industry-card text-decoration-none">
                        <div class="industry-icon">
                            <i class="flaticon flaticon-laundry"></i>
                        </div>
                        <h4 class="mt-3">Washing Plant</h4>
                        <p class="text-muted small">Advanced fabric washing & finishing services.</p>
                    </a>
                </div>
                <!-- Togs -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('industries.togs') }}" class="industry-card text-decoration-none">
                        <div class="industry-icon">
                            <i class="flaticon flaticon-online-shopping"></i>
                        </div>
                        <h4 class="mt-3">Togs (E-Commerce)</h4>
                        <p class="text-muted small">Direct-to-consumer retail solutions.</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="section-padding">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <span class="text-primary-custom fw-bold text-uppercase">Our Collections</span>
                    <h2 class="fw-bold mt-2" style="color: var(--secondary-color);">Product Categories</h2>
                    <p class="text-muted">Comprehensive apparel solutions for every segment</p>
                </div>
            </div>

            <div class="row">
                <!-- Men -->
                <div class="col-lg-4 col-md-6">
                    <div class="category-card" onclick="window.location.href='{{ route('products.mens') }}'">
                        <img src="{{ asset('frontend/assets/images/blog/blog-01.jpg') }}" alt="Mens Wear"
                            class="category-img">
                        <div class="category-overlay">
                            <h3 class="category-title">Men's Wear</h3>
                            <p class="text-white-50 mb-3">T-Shirts, Polos, Joggers, and more.</p>
                            <span class="category-btn">View Collection <i class="fa fa-arrow-right ml-2"></i></span>
                        </div>
                    </div>
                </div>

                <!-- Women -->
                <div class="col-lg-4 col-md-6">
                    <div class="category-card" onclick="window.location.href='{{ route('products.womens') }}'">
                        <img src="{{ asset('frontend/assets/images/blog/blog-02.jpg') }}" alt="Womens Wear"
                            class="category-img">
                        <div class="category-overlay">
                            <h3 class="category-title">Women's Wear</h3>
                            <p class="text-white-50 mb-3">Fashion tops, Leggings, Activewear.</p>
                            <span class="category-btn">View Collection <i class="fa fa-arrow-right ml-2"></i></span>
                        </div>
                    </div>
                </div>

                <!-- Kids -->
                <div class="col-lg-4 col-md-6">
                    <div class="category-card" onclick="window.location.href='{{ route('products.kids') }}'">
                        <img src="{{ asset('frontend/assets/images/blog/blog-03.jpg') }}" alt="Kids Wear"
                            class="category-img">
                        <div class="category-overlay">
                            <h3 class="category-title">Kids' Wear</h3>
                            <p class="text-white-50 mb-3">Comfortable, durable, and safe clothing.</p>
                            <span class="category-btn">View Collection <i class="fa fa-arrow-right ml-2"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="stats-bg-pattern"></div>
        <div class="container position-relative">
            <div class="row text-center">
                <div class="col-md-3 col-6 mb-4 mb-md-0">
                    <div class="stat-item">
                        <i class="ti-timer" style="color: #00d2d3; text-shadow: 0 0 20px rgba(0, 210, 211, 0.4);"></i>
                        <h2>
                            <span class="count-up" data-count="25">0</span>+
                        </h2>
                        <p>Years Experience</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4 mb-md-0">
                    <div class="stat-item">
                        <i class="ti-package" style="color: #feca57; text-shadow: 0 0 20px rgba(254, 202, 87, 0.4);"></i>
                        <h2>
                            <span class="count-up" data-count="5">0</span>M+
                        </h2>
                        <p>Monthly Capacity</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <i class="ti-world" style="color: #54a0ff; text-shadow: 0 0 20px rgba(84, 160, 255, 0.4);"></i>
                        <h2>
                            <span class="count-up" data-count="150">0</span>+
                        </h2>
                        <p>Global Partners</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <i class="ti-check-box"
                            style="color: #ff6b6b; text-shadow: 0 0 20px rgba(255, 107, 107, 0.4);"></i>
                        <h2>
                            <span class="count-up" data-count="98">0</span>%
                        </h2>
                        <p>On-Time Delivery</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.count-up');
            const speed = 200;

            const statsObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        const updateCount = () => {
                            const target = +counter.getAttribute('data-count');
                            const count = +counter.innerText;
                            const inc = target / speed;

                            if (count < target) {
                                counter.innerText = Math.ceil(count + inc);
                                setTimeout(updateCount, 20);
                            } else {
                                counter.innerText = target;
                            }
                        };
                        updateCount();
                        statsObserver.unobserve(counter);
                    }
                });
            }, {
                threshold: 0.5
            });

            counters.forEach(counter => {
                statsObserver.observe(counter);
            });

            const featureCards = document.querySelectorAll('.feature-card');

            const featureObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('feature-card-visible');
                        featureObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.2
            });

            featureCards.forEach((card, index) => {
                card.style.transitionDelay = (index * 0.1) + 's';
                featureObserver.observe(card);
            });
        });
    </script>

    <!-- Manufacturing Process -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <span class="text-primary-custom fw-bold text-uppercase">How We Work</span>
                    <h2 class="fw-bold mt-2" style="color: var(--secondary-color);">Our Manufacturing Process</h2>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="process-step">
                        <div class="process-arrow"></div>
                        <div class="process-icon-box">
                            <div class="process-icon">
                                <i class="flaticon flaticon-textile"></i>
                            </div>
                        </div>
                        <h4>Design & Sampling</h4>
                        <p class="text-muted">Creating prototypes and perfecting fit before production.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="process-step">
                        <div class="process-arrow"></div>
                        <div class="process-icon-box">
                            <div class="process-icon">
                                <i class="flaticon flaticon-sewing"></i>
                            </div>
                        </div>
                        <h4>Bulk Production</h4>
                        <p class="text-muted">Efficient manufacturing using advanced technology.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="process-step">
                        <div class="process-arrow"></div>
                        <div class="process-icon-box">
                            <div class="process-icon">
                                <i class="flaticon flaticon-sewing-machine"></i>
                            </div>
                        </div>
                        <h4>Quality Control</h4>
                        <p class="text-muted">Rigorous inspection to ensure zero-defect output.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="process-step">
                        <div class="process-icon-box">
                            <div class="process-icon">
                                <i class="flaticon flaticon-placeholder"></i>
                            </div>
                        </div>
                        <h4>Global Delivery</h4>
                        <p class="text-muted">Timely shipment to your warehouse anywhere.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <!-- CTA Section -->
    <section class="section-padding position-relative"
        style="background: linear-gradient(rgba(45, 50, 56, 0.92), rgba(45, 50, 56, 0.96)), url('{{ asset('frontend/assets/images/dresses/9.webp') }}'); background-attachment: fixed; background-size: cover;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <span class="d-block mb-3 text-uppercase fw-bold" style="color: #ffffff; letter-spacing: 2px;">Premium
                        Manufacturing Partner</span>
                    <h2 class="text-white mb-4 fw-bold display-5" style="text-shadow: 0 5px 15px rgba(0,0,0,0.3);">Turn
                        Your Fashion Vision Into Reality</h2>
                    <p class="text-white-50 mb-5 lead mx-auto" style="max-width: 780px; font-size: 20px;">
                        Scale your brand with a manufacturer that prioritizes quality, sustainability, and speed. From
                        intricate designs to bulk production, we deliver excellence in every stitch.
                    </p>
                    <div class="d-flex justify-content-center align-items-center flex-wrap gap-3">
                        <a href="{{ route('contact.us') }}"
                            class="ttm-btn ttm-btn-size-lg ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor">
                            START YOUR PROJECT
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--blog-section-->
    <section class="ttm-row blog-section ttm-bgcolor-grey clearfix">
        <div class="row">
            <div class="col-lg-12">
                <!-- section-title -->
                <div class="section-title title-style-center_text">
                    <div class="title-header">
                        <h2 class="title">Our Valuable <b>Buyers!</b></h2>
                        <h3>Integra Apparels Ltd. proudly partners with some of the world’s most renowned retailers and
                            global buyers</h3>
                    </div>
                </div>
                <!-- section-title end -->
            </div>
        </div>
        <div class="banner_slider_wrapper container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <a href="{{ route('our.clients') }}" class="d-block">
                        <img src="{{ asset('frontend/assets/images/slides/slider-mainbg-006.png') }}"
                            alt="Our Valuable Buyers" class="img-fluid w-100 rounded shadow-sm">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!--blog-section end-->
@endsection
