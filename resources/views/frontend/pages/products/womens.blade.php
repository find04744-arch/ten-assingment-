@extends('frontend.layout.template')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <style>
        :root {
            --primary-color: #0512b2;
        }

        .gallery-section-title {
            position: relative;
            z-index: 1;
            padding: 40px 0 30px;
            text-align: center;
        }

        .gallery-pre-title {
            font-size: 14px;
            font-weight: 600;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 10px;
            display: block;
        }

        .gallery-main-title {
            font-size: 42px;
            font-weight: 700;
            color: #2d3238;
            margin: 0;
            text-transform: uppercase;
            position: relative;
            display: inline-block;
            letter-spacing: 2px;
            padding-bottom: 15px;
        }

        .gallery-main-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
            border-radius: 2px;
        }

        .gallery-subtitle {
            max-width: 600px;
            margin: 20px auto 0;
            color: #666;
            font-size: 16px;
            line-height: 1.6;
            font-style: italic;
        }

        /* Filter Tabs */
        .gallery-filter {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 40px;
        }

        .filter-btn {
            background: transparent;
            border: 2px solid transparent;
            padding: 8px 25px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            color: #555;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .filter-btn:hover,
        .filter-btn.active {
            color: var(--primary-color);
            background: rgba(5, 18, 178, 0.05);
            border-color: rgba(5, 18, 178, 0.1);
        }

        .filter-btn.active {
            background: var(--primary-color);
            color: #fff;
            border-color: var(--primary-color);
            box-shadow: 0 5px 15px rgba(5, 18, 178, 0.2);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .gallery-main-title {
                font-size: 32px !important;
            }

            .gallery-subtitle {
                font-size: 15px;
                padding: 0 15px;
            }

            .gallery-filter {
                gap: 10px;
            }

            .filter-btn {
                padding: 6px 15px;
                font-size: 12px;
            }
        }

        /* Fixed Product List Image Dimensions & Styling */
        .ttm_single_image-wrapper.ttm_single_image_hover {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 5px solid #fff;
            position: relative;
            transition: all 0.4s ease;
        }

        .ttm_single_image-wrapper.ttm_single_image_hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .ttm_single_image-wrapper.ttm_single_image_hover img {
            width: 100%;
            height: 445px;
            object-fit: cover;
            object-position: center;
            border-radius: 10px;
            transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .ttm_single_image-wrapper.ttm_single_image_hover:hover img {
            transform: scale(1.03);
        }

        /* Override for Gallery Grid Items (keep existing gallery size) */
        .gallery-grid-item .ttm_single_image-wrapper img {
            width: 475px;
            height: 600px;
            object-fit: cover;
            object-position: center;
        }

        /* Hover Overlay & Icon for Gallery */
        .gallery-grid-item .ttm_single_image-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 5px;
        }

        .gallery-grid-item .ttm_single_image-wrapper a {
            display: block;
            position: relative;
        }

        .gallery-grid-item .ttm_single_image-wrapper .ttm-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            z-index: 2;
            opacity: 0;
            transition: all 0.4s ease;
            background-color: var(--primary-color);
            border-color: var(--primary-color) !important;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gallery-grid-item .ttm_single_image-wrapper .ttm-icon i {
            color: #fff;
            margin: 0;
        }

        .gallery-grid-item .ttm_single_image-wrapper:hover .ttm-icon {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }

        .gallery-grid-item .ttm_single_image-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            opacity: 0;
            transition: all 0.4s ease;
            z-index: 1;
            pointer-events: none;
        }

        .gallery-grid-item .ttm_single_image-wrapper:hover::before {
            opacity: 1;
        }

        /* Responsive adjustments for images */
        @media (max-width: 1200px) {
            .gallery-grid-item .ttm_single_image-wrapper img {
                width: 100%;
                /* Fallback to responsive width on smaller screens if needed, or keep fixed */
                height: auto;
                aspect-ratio: 475 / 600;
                /* Maintain aspect ratio */
            }
        }
    </style>
    <!-- page-title -->
    <div class="ttm-page-title-row ttm-bg ttm-bgimage-yes ttm-bgcolor-darkgrey clearfix"
        style="background-image: url('{{ asset('frontend/assets/images/services/services-06-1200x800.jpg') }}');">
        <div class="ttm-row-wrapper-bg-layer ttm-bg-layer" style="opacity: 0.6;"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="ttm-page-title-row-inner" style="padding: 100px 0;">
                        <div class="page-title-heading">
                            <h2 class="title" style="font-size: 60px;">Women's Products</h2>
                            <p style="color: #fff; font-size: 18px; margin-top: 10px; font-weight: 500;">Elegance & Grace
                                Redefined</p>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span>
                                <a title="Homepage" href="{{ route('home') }}">Home</a>
                            </span>
                            <span>Women's Products</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-title end -->

    <!--site-main start-->
    <div class="site-main">
        <div class="ttm-row clearfix">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12 content-area">
                        <div class="ttm-service-single-content-area">

                            <!-- About Section -->
                            <div class="ttm-service-description mb-50 text-center">
                                <div class="section-title">
                                    <div class="title-header">
                                        <h2 class="title" style="font-size: 50px;">About Women's Products</h2>
                                    </div>
                                    <div class="title-desc">
                                        <p class="lead text-muted">Embrace elegance and versatility with our exclusive
                                            women's collection. Designed for the modern woman, our range spans from chic
                                            professional attire to relaxed weekend wear. We focus on flattering cuts,
                                            high-quality fabrics, and contemporary designs to help you express your unique
                                            style.</p>

                                    </div>
                                </div>
                            </div>

                            <div class="ttm-horizontal_sep width-100 margin_bottom50"></div>

                            @forelse($products as $index => $product)
                                @if ($index % 2 == 0)
                                    <!-- Image Left, Content Right -->
                                    <div class="row align-items-center mb-50">
                                        <div class="col-md-6">
                                            <div class="pr-lg-4">
                                                <div class="ttm_single_image-wrapper ttm_single_image_hover">
                                                    @if ($product->image_path)
                                                        <img class="img-fluid border-radius-5"
                                                            src="{{ asset('storage/' . $product->image_path) }}"
                                                            alt="{{ $product->title }}">
                                                    @else
                                                        <img class="img-fluid border-radius-5"
                                                            src="{{ asset('frontend/assets/images/services/services-05-768x512.jpg') }}"
                                                            alt="placeholder">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="pl-lg-4 mt-4 mt-md-0">
                                                <div class="featured-icon-box icon-align-before-content icon-ver_align-top">
                                                    <div class="featured-icon">
                                                        <div
                                                            class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-color-skincolor ttm-icon_element-size-md">
                                                            <i class="{{ $product->icon ?? 'fa fa-cube' }}"></i>
                                                        </div>
                                                    </div>
                                                    <div class="featured-content">
                                                        <div class="featured-title">
                                                            <h3 style="font-size: 30px;">{{ $product->title }}</h3>
                                                        </div>
                                                        <div class="featured-desc">
                                                            <p>{{ $product->description }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <!-- Content Left, Image Right -->
                                    <div class="row align-items-center mb-50">
                                        <div class="col-md-6 order-2 order-md-1">
                                            <div class="pr-lg-4 mt-4 mt-md-0">
                                                <div class="featured-icon-box icon-align-before-content icon-ver_align-top">
                                                    <div class="featured-icon">
                                                        <div
                                                            class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-color-skincolor ttm-icon_element-size-md">
                                                            <i class="{{ $product->icon ?? 'fa fa-cube' }}"></i>
                                                        </div>
                                                    </div>
                                                    <div class="featured-content">
                                                        <div class="featured-title">
                                                            <h3 style="font-size: 30px;">{{ $product->title }}</h3>
                                                        </div>
                                                        <div class="featured-desc">
                                                            <p>{{ $product->description }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 order-1 order-md-2">
                                            <div class="pl-lg-4">
                                                <div class="ttm_single_image-wrapper ttm_single_image_hover">
                                                    @if ($product->image_path)
                                                        <img class="img-fluid border-radius-5"
                                                            src="{{ asset('storage/' . $product->image_path) }}"
                                                            alt="{{ $product->title }}">
                                                    @else
                                                        <img class="img-fluid border-radius-5"
                                                            src="{{ asset('frontend/assets/images/services/services-06-768x512.jpg') }}"
                                                            alt="placeholder">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <p>No products found in this category.</p>
                                    </div>
                                </div>
                            @endforelse

                            <!-- Gallery Section -->
                            <div class="ttm-horizontal_sep width-100 margin_bottom50"></div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="section-title text-center mb-50 gallery-section-title">
                                        {{-- <div class="gallery-bg-text">Gallery</div> --}}
                                        <div class="title-header">
                                            <span class="gallery-pre-title">Explore</span>
                                            <h2 class="title gallery-main-title">Gallery Collection</h2>
                                            <div class="gallery-separator"></div>
                                            <p class="gallery-subtitle">Discover our elegant and versatile women's
                                                collection.</p>

                                            @if (!empty($galleryCategories) && $galleryCategories->count())
                                                <div class="gallery-filter">
                                                    <button class="filter-btn active" data-filter="all">All</button>
                                                    @foreach ($galleryCategories as $cat)
                                                        <button class="filter-btn"
                                                            data-filter="{{ \Illuminate\Support\Str::slug($cat) }}">{{ $cat }}</button>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row gallery-grid">
                                        @forelse($gallery as $item)
                                            <div class="col-md-4 col-sm-6 mb-4 gallery-grid-item"
                                                data-category="{{ $item->subcategory ? \Illuminate\Support\Str::slug($item->subcategory) : 'uncategorized' }}">
                                                <div class="ttm_single_image-wrapper ttm_single_image_hover">
                                                    <a href="{{ $item->image_path ? asset('storage/' . $item->image_path) : asset('frontend/assets/images/portfolio/portfolio-04-600x700.jpg') }}"
                                                        class="gallery-lightbox" title="{{ $item->title }}">
                                                        @if ($item->image_path)
                                                            <img class="img-fluid border-radius-5"
                                                                src="{{ asset('storage/' . $item->image_path) }}"
                                                                alt="{{ $item->title }}">
                                                        @else
                                                            <img class="img-fluid border-radius-5"
                                                                src="{{ asset('frontend/assets/images/portfolio/portfolio-04-600x700.jpg') }}"
                                                                alt="placeholder">
                                                        @endif
                                                        <div class="ttm-icon ttm-icon_element-border ttm-icon_element-color-white ttm-icon_element-size-xs">
                                                            <i class="fa fa-search-plus"></i>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12">
                                                <div class="alert alert-info text-center">No gallery images available.
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- row end -->
            </div>
        </div>
    </div>
    <!--site-main end-->
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter Logic
            const filterBtns = document.querySelectorAll('.filter-btn');
            const galleryItems = document.querySelectorAll('.gallery-grid-item');

            if (filterBtns.length) {
                filterBtns.forEach(btn => {
                    btn.addEventListener('click', () => {
                        // Remove active class from all buttons
                        filterBtns.forEach(b => b.classList.remove('active'));
                        // Add active class to clicked button
                        btn.classList.add('active');

                        const filterValue = btn.getAttribute('data-filter');

                        galleryItems.forEach(item => {
                            const itemCategory = item.getAttribute('data-category');

                            if (filterValue === 'all' || filterValue === itemCategory) {
                                item.style.display = '';
                                // Add animation
                                item.style.opacity = '0';
                                setTimeout(() => {
                                    item.style.opacity = '1';
                                    item.style.transition = 'opacity 0.5s ease';
                                }, 50);
                            } else {
                                item.style.display = 'none';
                            }
                        });
                    });
                });
            }

            // Initialize Magnific Popup
            if (jQuery().magnificPopup) {
                jQuery('.gallery-grid').each(function() { // the containers for all your galleries
                    jQuery(this).magnificPopup({
                        delegate: 'a.gallery-lightbox', // the selector for gallery item
                        type: 'image',
                        gallery: {
                            enabled: true,
                            navigateByImgClick: true,
                            preload: [0,
                            1], // Will preload 0 - before current, and 1 after the current image
                            tPrev: 'Previous', // title for left button
                            tNext: 'Next', // title for right button
                            tCounter: '<span class="mfp-counter">%curr% of %total%</span>' // markup of counter
                        },
                        image: {
                            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                            titleSrc: function(item) {
                                return item.el.attr('title');
                            }
                        },
                        mainClass: 'mfp-zoom-in', // this class is for CSS animation below
                        removalDelay: 300, // delay removal by X to allow out-animation
                        callbacks: {
                            beforeOpen: function() {
                                // just a hack that adds mfp-anim class to markup
                                this.st.image.markup = this.st.image.markup.replace(
                                    'mfp-figure', 'mfp-figure mfp-with-anim');
                                this.st.mainClass = this.st.mainClass + ' mfp-zoom-in';
                            }
                        },
                        closeOnContentClick: true,
                        midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
                    });
                });
            }
        });
    </script>
@endpush
