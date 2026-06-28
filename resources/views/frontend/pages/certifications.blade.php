@extends('frontend.layout.template')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <!-- page-title -->
    <div class="ttm-page-title-row ttm-bg ttm-bgimage-yes ttm-bgcolor-darkgrey clearfix">
        <div class="ttm-row-wrapper-bg-layer ttm-bg-layer"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="ttm-page-title-row-inner">
                        <div class="page-title-heading">
                            <h2 class="title">Certifications</h2>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span>
                                <a title="Homepage" href="{{ route('home') }}">Home</a>
                            </span>
                            <span>Certifications</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-title end -->

    <!--site-main start-->
    <section class="ttm-row blog-section ttm-bgcolor-grey clearfix">
        <div class="row">
            <div class="col-lg-12">
                <!-- section-title -->
                <div class="section-title title-style-center_text">
                    <div class="title-header">
                        <h2 class="title">Our <b>Certifications</b> & Global Standards!</h2>
                        <h3>Integra Apparels Ltd. is globally certified, ensuring trusted quality, compliance, and ethical
                            excellence.</h3>
                    </div>
                </div>
                <!-- section-title end -->
            </div>
        </div>
        @php
            $firstWithImage = $certifications->firstWhere('image_path', '!=', null);
            $bannerSrc = $firstWithImage
                ? asset('storage/' . $firstWithImage->image_path)
                : asset('frontend/assets/images/slides/slider-mainbg-006.png');
            $bannerTitle = $firstWithImage->title ?? 'Our Certifications';
        @endphp
        <div class="banner_slider_wrapper container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <a href="{{ $bannerSrc }}" class="d-block gallery-lightbox" title="{{ $bannerTitle }}">
                        <img src="{{ $bannerSrc }}" alt="{{ $bannerTitle }}" class="img-fluid w-100 rounded shadow-sm">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!--site-main end-->
@endsection
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (jQuery().magnificPopup) {
                jQuery('.banner_slider_wrapper').magnificPopup({
                    delegate: 'a.gallery-lightbox',
                    type: 'image',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0, 1],
                        tPrev: 'Previous',
                        tNext: 'Next',
                        tCounter: '<span class="mfp-counter">%curr% of %total%</span>'
                    },
                    mainClass: 'mfp-zoom-in',
                    removalDelay: 300,
                    closeOnContentClick: true,
                    midClick: true
                });
            }
        });
    </script>
@endpush
