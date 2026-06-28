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
                            <h2 class="title">Apparels</h2>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span>
                                <a title="Homepage" href="{{ route('home') }}">Home</a>
                            </span>
                            <span>Apparels</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-title end -->

    <!--site-main start-->
    <div class="site-main">
        <!--services-section-->
        <section class="ttm-row service-section ttm-bgcolor-grey position-relative z-index-2 clearfix">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <!-- section-title -->
                        <div class="section-title title-style-center_text">
                            <div class="title-header">
                                <h3>INDUSTRIES &amp; PRODUCTION</h3>
                                <h2 class="title">
                                    Let's Experience <b>Exclusive Quality</b>
                                </h2>
                            </div>
                        </div>
                        <!-- section-title end -->
                    </div>
                </div>
                <!-- row end -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="featuredbox-number">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <!--featured-icon-box-->
                                    <div class="featured-icon-box icon-align-top-content style5">
                                        <i class="ttm-num"></i>
                                        <div class="featured-icon">
                                            <div
                                                class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-color-skincolor ttm-icon_element-size-md">
                                                <i class="flaticon flaticon-textile-1"></i>
                                            </div>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h3>Fabric Treatment</h3>
                                            </div>
                                            <div class="featured-desc">
                                                <p>We do execute stabilization including reweaving &amp; stitch repair
                                                    details.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- featured-icon-box end-->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <!--featured-icon-box-->
                                    <div class="featured-icon-box icon-align-top-content style5">
                                        <i class="ttm-num"></i>
                                        <div class="featured-icon">
                                            <div
                                                class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-color-skincolor ttm-icon_element-size-md">
                                                <i class="flaticon flaticon-silk"></i>
                                            </div>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h3>Artistic Direction</h3>
                                            </div>
                                            <div class="featured-desc">
                                                <p>Assist collection strategies, storage, application and pest production
                                                    management.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- featured-icon-box end-->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <!--featured-icon-box-->
                                    <div class="featured-icon-box icon-align-top-content style5">
                                        <i class="ttm-num"></i>
                                        <div class="featured-icon">
                                            <div
                                                class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-color-skincolor ttm-icon_element-size-md">
                                                <i class="flaticon flaticon-moisture-wicking-fabric"></i>
                                            </div>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h3>Satin weaving</h3>
                                            </div>
                                            <div class="featured-desc">
                                                <p>Continuous weft yarn, with as few interruptions of warp as it possible.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- featured-icon-box end-->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <!--featured-icon-box-->
                                    <div class="featured-icon-box icon-align-top-content style5">
                                        <i class="flaticon flaticon-sewing-machine"></i>
                                        <div class="featured-icon">
                                            <div
                                                class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-color-skincolor ttm-icon_element-size-md">
                                                <i class="flaticon flaticon-sewing-machine"></i>
                                            </div>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h3>Fabric Dyeing</h3>
                                            </div>
                                            <div class="featured-desc">
                                                <p>Transfer dyes from aqueous solution onto the fiber surface &amp;
                                                    diffusion.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- featured-icon-box end-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--services-section end-->

        <section class="ttm-row grid-section clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title title-style-center_text">
                            <div class="title-header">
                                <h3>GALLERY</h3>
                                <h2 class="title">Explore Our <b>Apparels</b></h2>
                            </div>
                            <div class="title-desc">
                                <p>Selected visuals of our apparel workflows, finishes, and product details.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row slick_slider mb_15 mt_15"
                    data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "arrows":false, "autoplay":true, "autoplaySpeed":3500, "pauseOnHover":true, "adaptiveHeight":true, "dots":true, "infinite":true, "responsive":[{"breakpoint":992,"settings":{"slidesToShow": 2}},{"breakpoint":840,"settings":{"slidesToShow": 2}},{"breakpoint":650,"settings":{"slidesToShow": 1}}]}'>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="featured-imagebox featured-imagebox-portfolio style2">
                            <div class="ttm-box-view-overlay ttm-portfolio-box-view-overlay">
                                <div class="featured-thumbnail">
                                    <img class="img-fluid"
                                        src="{{ asset('frontend/assets/images/portfolio/portfolio-01-768x512.jpg') }}"
                                        alt="Apparel image 1" />
                                </div>
                                <div class="ttm-media-link">
                                    <a class="ttm_prettyphoto ttm_image" title="Apparel Detail" data-rel="prettyPhoto"
                                        href="{{ asset('frontend/assets/images/portfolio/portfolio-01-1200x800.jpg') }}">
                                        <i class="flaticon flaticon-measuring-tape"></i>
                                    </a>
                                    <a href="#" class="ttm_link"><i class="flaticon flaticon-returning"></i></a>
                                </div>
                            </div>
                            <div class="featured-content">
                                <div class="featured-title">
                                    <h3><a href="#">Fine Stitching</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="featured-imagebox featured-imagebox-portfolio style2">
                            <div class="ttm-box-view-overlay ttm-portfolio-box-view-overlay">
                                <div class="featured-thumbnail">
                                    <img class="img-fluid"
                                        src="{{ asset('frontend/assets/images/portfolio/portfolio-02-768x512.jpg') }}"
                                        alt="Apparel image 2" />
                                </div>
                                <div class="ttm-media-link">
                                    <a class="ttm_prettyphoto ttm_image" title="Fabric Selection" data-rel="prettyPhoto"
                                        href="{{ asset('frontend/assets/images/portfolio/portfolio-02-1200x800.jpg') }}">
                                        <i class="flaticon flaticon-measuring-tape"></i>
                                    </a>
                                    <a href="#" class="ttm_link"><i class="flaticon flaticon-returning"></i></a>
                                </div>
                            </div>
                            <div class="featured-content">
                                <div class="featured-title">
                                    <h3><a href="#">Fabric Selection</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="featured-imagebox featured-imagebox-portfolio style2">
                            <div class="ttm-box-view-overlay ttm-portfolio-box-view-overlay">
                                <div class="featured-thumbnail">
                                    <img class="img-fluid"
                                        src="{{ asset('frontend/assets/images/portfolio/portfolio-03-768x512.jpg') }}"
                                        alt="Apparel image 3" />
                                </div>
                                <div class="ttm-media-link">
                                    <a class="ttm_prettyphoto ttm_image" title="Finish & Quality" data-rel="prettyPhoto"
                                        href="{{ asset('frontend/assets/images/portfolio/portfolio-03-1200x800.jpg') }}">
                                        <i class="flaticon flaticon-measuring-tape"></i>
                                    </a>
                                    <a href="#" class="ttm_link"><i class="flaticon flaticon-returning"></i></a>
                                </div>
                            </div>
                            <div class="featured-content">
                                <div class="featured-title">
                                    <h3><a href="#">Finish & Quality</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--cta-section-->
        <section class="ttm-row cta-section ttm-bgimage-yes bg-img1 ttm-bg ttm-bgcolor-darkgrey clearfix">
            <div class="ttm-row-wrapper-bg-layer ttm-bg-layer"></div>
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-lg-9">
                        <div class="position-relative">
                            <h2>The Textile, Product, And Apparel Manufacturing Industries.</h2>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="text-lg-end">
                            <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor"
                                href="{{ route('contact.us') }}">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--site-main end-->
@endsection
