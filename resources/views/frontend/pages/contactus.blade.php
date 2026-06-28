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
                            <h2 class="title">Contact Us</h2>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span>
                                <a title="Homepage" href="{{ route('home') }}">Home</a>
                            </span>
                            <span>Contact Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-title end -->

    <!--site-main start-->
    <div class="site-main">
        <!-- padding_bottom_zero-section -->
        <section class="ttm-row padding_bottom_zero-section clearfix">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ttm-bgcolor-white box-shadow p-50">
                            <!-- section title -->
                            <div class="section-title title-style-center_text">
                                <div class="title-header">
                                    <h2 class="title">{!! optional($contactInfo)->form_title ?? 'Contact <b>Form</b>' !!}</h2>
                                </div>
                                <div class="title-desc">
                                    <p>
                                        {{ optional($contactInfo)->form_description ?? 'Feel free to contact us through' }}
                                        @if (optional($contactInfo)->twitter_url)
                                            <a class="ttm-textcolor-skincolor"
                                                href="{{ $contactInfo->twitter_url }}">Twitter</a>
                                        @endif
                                        @if (optional($contactInfo)->twitter_url && optional($contactInfo)->facebook_url)
                                            or
                                        @endif
                                        @if (optional($contactInfo)->facebook_url)
                                            <a class="ttm-textcolor-skincolor"
                                                href="{{ $contactInfo->facebook_url }}">Facebook</a>
                                        @endif
                                        @if (optional($contactInfo)->twitter_url || optional($contactInfo)->facebook_url)
                                            if you prefer.
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <!-- section title end -->
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form id="request_qoute_form" class="request_qoute_form wrap-form clearfix" method="post"
                                novalidate="novalidate" action="{{ route('contact.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <span class="text-input"><input name="name" type="text" value=""
                                                placeholder="Your Name" required="required" /></span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="text-input"><input name="email" type="email" value=""
                                                placeholder="Your Email" required="required" /></span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="text-input"><input name="phone" type="text" value=""
                                                placeholder="Phone Number" required="required" /></span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="text-input"><input name="company_name" type="text" value=""
                                                placeholder="Company Name" /></span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="text-input"><input name="subject" type="text" value=""
                                                placeholder="Subject" required="required" /></span>
                                    </div>
                                    <div class="col-lg-12">
                                        <span class="text-input">
                                            <textarea name="message" rows="5" placeholder="Message" required="required"></textarea>
                                        </span>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="pt-15 text-center">
                                            <p class="cookies padding_bottom20">
                                                <input id="cookies-consent" name="cookies-consent" type="checkbox"
                                                    value="yes" />
                                                <label for="cookies-consent">Save my name, email, and website in this
                                                    browser
                                                    for the next time I comment.</label>
                                            </p>
                                            <button
                                                class="submit ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor"
                                                type="submit">
                                                Send now!
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- row end -->
            </div>
        </section>
        <!-- padding_bottom_zero-section end -->

        <!--- conatact-section -->
        <section class="ttm-row conatact-section clearfix">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-xl-5">
                        <div class="map-wrapper">
                            {!! optional($contactInfo)->map_embed ??
                                '<iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d14604.938383086297!2d90.40309515!3d23.774659050000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x3755c53713a61921%3A0xd654d861a7192faf!2sIntegra%20Design%20Limited%2C%20V9VG%2B4RX%2C%20Dhaka!3m2!1d23.8928543!2d90.3771197!5e0!3m2!1sen!2sbd!4v1778740617074!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>' !!}
                        </div>
                    </div>
                    <div class="col-xl-7">
                        <div class="padding_left15 res-1199-padding_left0 padding_top20 res-1199-padding_top40">
                            <!-- section title -->
                            <div class="section-title">
                                <div class="title-header">
                                    <h3>{{ optional($contactInfo)->contact_section_title ?? 'CONTACT US' }}</h3>
                                    <h2 class="title">{!! optional($contactInfo)->contact_section_heading ?? 'Get In <b>Touch!</b>' !!}</h2>
                                </div>
                                <div class="title-desc">
                                    <p>
                                        {{ optional($contactInfo)->contact_section_description ?? 'Loream ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' }}
                                    </p>
                                </div>
                            </div>
                            <!-- section title end -->
                            <h2 class="fs-24 padding_top10">{{ optional($contactInfo)->head_office_title ?? 'Head Office' }}
                            </h2>
                            <div class="ttm-horizontal_sep width-100 margin_top20 margin_bottom5"></div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <!--featured-icon-box-->
                                    <div class="featured-icon-box icon-align-before-content">
                                        <div class="featured-icon">
                                            <div
                                                class="ttm-icon ttm-icon_element-fill ttm-icon_element-color-grey ttm-icon_element-size-md ttm-icon_element-style-rounded">
                                                <i class="flaticon flaticon-placeholder ttm-textcolor-skincolor"></i>
                                            </div>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h3 class="margin_bottom0 fs-18">Address</h3>
                                            </div>
                                            <div class="featured-desc">
                                                {{ optional($contactInfo)->address ?? '123 King Street,Melbourne Victoria 5000,New York.' }}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- featured-icon-box end-->
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <!--featured-icon-box-->
                                    <div class="featured-icon-box icon-align-before-content">
                                        <div class="featured-icon">
                                            <div
                                                class="ttm-icon ttm-icon_element-fill ttm-icon_element-color-grey ttm-icon_element-size-md ttm-icon_element-style-rounded">
                                                <i class="flaticon flaticon-email-2 ttm-textcolor-skincolor"></i>
                                            </div>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h3 class="margin_bottom0 fs-18">
                                                    Call Us / Email
                                                </h3>
                                            </div>
                                            <div class="featured-desc">
                                                {{ optional($contactInfo)->phone ?? '+1800-200-123456' }}<br />{{ optional($contactInfo)->email ?? 'fablio.support@yourmail.com' }}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- featured-icon-box end-->
                                </div>
                            </div>
                            <h2 class="fs-24 padding_top20">
                                {{ optional($contactInfo)->branch_office_title ?? 'Branch Office' }}</h2>
                            <div class="ttm-horizontal_sep width-100 margin_top20 margin_bottom5"></div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <!--featured-icon-box-->
                                    <div class="featured-icon-box icon-align-before-content">
                                        <div class="featured-icon">
                                            <div
                                                class="ttm-icon ttm-icon_element-fill ttm-icon_element-color-grey ttm-icon_element-size-md ttm-icon_element-style-rounded">
                                                <i class="flaticon flaticon-placeholder ttm-textcolor-skincolor"></i>
                                            </div>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h3 class="margin_bottom0 fs-18">Address</h3>
                                            </div>
                                            <div class="featured-desc">
                                                {{ optional($contactInfo)->branch_office_address ?? '123 King Street,Melbourne Victoria 5000,New York.' }}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- featured-icon-box end-->
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <!--featured-icon-box-->
                                    <div class="featured-icon-box icon-align-before-content">
                                        <div class="featured-icon">
                                            <div
                                                class="ttm-icon ttm-icon_element-fill ttm-icon_element-color-grey ttm-icon_element-size-md ttm-icon_element-style-rounded">
                                                <i class="flaticon flaticon-email-2 ttm-textcolor-skincolor"></i>
                                            </div>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h3 class="margin_bottom0 fs-18">
                                                    Call Us / Email
                                                </h3>
                                            </div>
                                            <div class="featured-desc">
                                                {{ optional($contactInfo)->branch_office_phone ?? '+1800-200-123456' }}<br />{{ optional($contactInfo)->branch_office_email ?? 'fablio.support@yourmail.com' }}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- featured-icon-box end-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row end -->
            </div>
        </section>
        <!-- conatact-section end -->


    </div>
    <!--site-main end-->
@endsection
