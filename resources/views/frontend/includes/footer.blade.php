<style>
    /* Global Footer Overrides */
    .ttm-bgcolor-ash {
        background-color: #2d3238 !important;
    }

    .footer-bg-overlay {
        background-image: linear-gradient(rgba(45, 50, 56, 0.92), rgba(45, 50, 56, 0.9)), url('{{ asset('frontend/assets/images/img-pattern-bg1.png') }}');
        background-repeat: repeat;
        position: relative;
        z-index: 1;
        background-size: auto;
    }

    /* Newsletter Section */
    .newsletter-box {
        background: rgba(255, 255, 255, 0.05);
        padding: 60px 40px;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
        margin-bottom: 60px;
    }

    .newsletter-title {
        font-size: 32px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 10px;
    }

    .newsletter-desc {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 35px;
    }

    .newsletter-form input {
        background: rgba(0, 0, 0, 0.2) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 50px !important;
        height: 55px !important;
        padding: 0 25px !important;
        color: #fff !important;
        width: 100%;
        transition: all 0.3s ease;
    }

    .newsletter-form input:focus {
        background: rgba(0, 0, 0, 0.4) !important;
        border-color: #0512b2 !important;
        box-shadow: 0 0 0 3px rgba(5, 18, 178, 0.2);
    }

    .newsletter-form input::placeholder {
        color: #aaa !important;
    }

    .newsletter-btn {
        border-radius: 50px !important;
        height: 55px !important;
        padding: 0 30px !important;
        font-weight: 600 !important;
        width: 100%;
        background-color: #0512b2 !important;
        border: 1px solid #0512b2 !important;
        color: white !important;
        transition: all 0.3s ease;
    }

    .newsletter-btn:hover {
        background-color: #030d8a !important;
        border-color: #030d8a !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(5, 18, 178, 0.4);
    }

    /* Widget Styles */
    .widget-area {
        margin-bottom: 40px;
    }

    .widget-title-enhanced {
        color: #ffffff !important;
        font-size: 18px;
        font-weight: 700;
        padding-bottom: 15px;
        margin-bottom: 30px;
        position: relative;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .widget-title-enhanced::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 3px;
        background-color: #0512b2;
    }

    .footer-logo img {
        filter: brightness(0) invert(1);
        opacity: 0.95;
    }

    .footer-desc {
        font-size: 15px;
        line-height: 26px;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 20px;
    }

    /* Social Icons */
    .social-icons.circle-icons li {
        margin-right: 5px;
    }

    .social-icons.circle-icons li a {
        width: 40px;
        height: 40px;
        line-height: 40px;
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff !important;
        display: block;
        text-align: center;
        transition: all 0.3s ease;
    }

    .social-icons.circle-icons li a:hover {
        background-color: #0512b2 !important;
        border-color: #0512b2 !important;
        transform: translateY(-3px);
    }

    /* Footer Links */
    .footer-menu {
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .footer-menu li {
        margin-bottom: 12px;
    }

    .footer-menu li a {
        color: #e0e0e0 !important;
        font-size: 15px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .footer-menu li a i {
        font-size: 12px;
        color: #0512b2;
        margin-right: 10px;
        transition: margin-right 0.3s ease;
    }

    .footer-menu li a:hover {
        color: #fff !important;
        padding-left: 5px;
    }

    .footer-menu li a:hover i {
        margin-right: 15px;
    }

    /* Contact Info */
    .contact-wrapper {
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .contact-item {
        margin-bottom: 20px;
        display: flex;
        align-items: flex-start;
    }

    .contact-icon-box {
        width: 40px;
        height: 40px;
        background: #0512b2;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        flex-shrink: 0;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
    }

    .contact-item:hover .contact-icon-box {
        transform: scale(1.1);
    }

    .contact-icon-box i {
        color: #ffffff !important;
        font-size: 16px;
    }

    .contact-content {
        flex: 1;
        margin-top: 5px;
        color: #e0e0e0;
        font-size: 15px;
        line-height: 1.5;
    }

    .contact-content a {
        color: #e0e0e0;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .contact-content a:hover {
        color: #fff;
    }

    .request-quote-btn {
        display: block;
        padding: 14px 0;
        font-weight: 600;
        letter-spacing: 0.5px;
        border-radius: 4px;
        background-color: #0512b2 !important;
        color: #fff !important;
        text-align: center;
        transition: all 0.3s ease;
        margin-top: 30px;
        text-transform: uppercase;
        font-size: 14px;
    }

    .request-quote-btn:hover {
        background-color: #030d8a !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(5, 18, 178, 0.3);
        text-decoration: none;
        color: #fff !important;
    }

    /* Certifications */
    .cert-section {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 50px;
        margin-top: 20px;
    }

    .cert-title {
        letter-spacing: 1px;
        text-transform: uppercase;
        font-size: 18px;
        color: #ffffff !important;
        font-weight: 700;
        margin-bottom: 30px;
    }

    .cert-logo {
        background: #fff;
        padding: 10px 20px;
        border-radius: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 10px;
    }

    .cert-logo img {
        max-height: 100%;
        max-width: 100%;
        filter: grayscale(100%);
        opacity: 0.8;
        transition: all 0.3s ease;
    }

    .cert-logo:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    .cert-logo:hover img {
        filter: grayscale(0%);
        opacity: 1;
    }

    /* Copyright */
    .bottom-footer-text.copyright {
        background-color: #1e2226;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        padding: 22px 0;
        font-size: 14px;
    }

    .copyright-text {
        color: #a0a0a0;
        letter-spacing: 0.3px;
        font-weight: 400;
    }

    .footer-bottom-links {
        display: inline-flex;
        align-items: center;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 15px;
        color: #a0a0a0;
    }

    .footer-bottom-links a {
        color: #a0a0a0;
        text-decoration: none;
        transition: color 0.3s ease;
        font-size: 14px;
    }

    .footer-bottom-links a:hover {
        color: #fff;
    }

    .footer-bottom-links .sep {
        color: rgba(255, 255, 255, 0.2);
        font-size: 12px;
    }

    .developer-link {
        color: #fff !important;
        font-weight: 600;
        position: relative;
    }

    .developer-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 1px;
        bottom: -2px;
        left: 0;
        background-color: #0512b2;
        transition: width 0.3s ease;
    }

    .developer-link:hover::after {
        width: 100%;
    }

    @media (max-width: 991px) {
        .bottom-footer-text.copyright {
            padding: 25px 0;
        }

        .footer-bottom-links {
            justify-content: center;
            margin-top: 15px;
        }

        .copyright-text {
            display: block;
            text-align: center;
            line-height: 1.6;
        }
    }

    /* Responsive Adjustments */
    @media (max-width: 991px) {
        .widget-area {
            margin-bottom: 40px;
        }

        .newsletter-box {
            padding: 40px 30px;
        }
    }

    @media (max-width: 767px) {
        .newsletter-box {
            padding: 30px 20px;
        }

        .newsletter-title {
            font-size: 24px;
        }

        .footer-logo {
            text-align: left;
        }

        .footer-logo img {
            max-width: 140px;
        }

        .widget-title-enhanced {
            margin-bottom: 20px;
            font-size: 16px;
        }

        .cert-logo {
            height: 60px;
            padding: 8px 15px;
        }

        .copyright-text {
            display: block;
            margin-bottom: 10px;
            text-align: center;
        }

        .developer-info {
            display: block;
            margin-left: 0;
            text-align: center;
        }
    }
</style>

<footer class="footer widget-footer ttm-bgcolor-ash clearfix footer-bg-overlay">
    <div class="first-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="newsletter-box text-center">
                        <h3 class="newsletter-title">Stay Connected</h3>
                        <p class="newsletter-desc">Subscribe to our newsletter for exclusive updates on sustainable
                            fashion.</p>
                        <form id="subscribe-form" class="newsletter-form" method="post" action="#"
                            data-mailchimp="true">
                            <div class="row justify-content-center g-3">
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <input type="text" name="NAME" id="txtname" placeholder="Your Name"
                                        required="" />
                                </div>
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <input type="email" name="EMAIL" id="txtemail" placeholder="Your Email Address"
                                        required="" />
                                </div>
                                <div class="col-md-3">
                                    <button class="submit ttm-btn newsletter-btn" type="submit">
                                        Subscribe <i class="fa fa-paper-plane ml-2" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="subscribe-msg"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="second-footer">
        <div class="container">
            <div class="row">
                <!-- About Widget -->
                <div class="col-lg-3 col-md-6 col-sm-12 widget-area">
                    <div class="widget widget_text clearfix">
                        <div class="footer-logo mb-4">
                            <img id="footer-logo-img" class="img-fluid auto_size" height="46" width="170"
                                src="{{ asset('frontend/assets/images/logo-img.png') }}" alt="Integra Apparels" />
                        </div>
                        <div class="textwidget widget-text">
                            <p class="footer-desc">
                                Integra Apparels is a premier ready-made garments manufacturer, dedicated to delivering
                                high-quality apparel solutions globally. We combine innovation, sustainability, and
                                craftsmanship.
                            </p>
                            <div class="social-icons circle-icons mt-3">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="https://www.facebook.com/prt.333/" target="_blank"
                                            aria-label="facebook">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="https://twitter.com/PreyanTechnosys" target="_blank"
                                            aria-label="twitter">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="https://www.linkedin.com/in/preyan-technosys-pvt-ltd/" target="_blank"
                                            aria-label="linkedin">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Industries Widget -->
                <div class="col-lg-3 col-md-6 col-sm-12 widget-area">
                    <div class="widget widget_nav_menu clearfix">
                        <h3 class="widget-title-enhanced">Our Industries</h3>
                        <ul class="footer-menu">
                            <li><a href="{{ route('industries.apparels') }}"><i class="fa fa-chevron-right"></i>
                                    Apparels</a></li>
                            <li><a href="{{ route('industries.design') }}"><i class="fa fa-chevron-right"></i>
                                    Design</a></li>
                            <li><a href="{{ route('industries.dresses') }}"><i class="fa fa-chevron-right"></i>
                                    Dresses</a></li>
                            <li><a href="{{ route('industries.washingplant') }}"><i class="fa fa-chevron-right"></i>
                                    Washing Plant</a></li>
                            <li><a href="{{ route('industries.togs') }}"><i class="fa fa-chevron-right"></i> Togs
                                    (E-Commerce)</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Quick Links Widget -->
                <div class="col-lg-3 col-md-6 col-sm-12 widget-area">
                    <div class="widget widget_nav_menu clearfix">
                        <h3 class="widget-title-enhanced">Quick Links</h3>
                        <ul class="footer-menu">
                            <li><a href="{{ route('products.mens') }}"><i class="fa fa-chevron-right"></i> Men's
                                    Collection</a></li>
                            <li><a href="{{ route('products.womens') }}"><i class="fa fa-chevron-right"></i> Women's
                                    Collection</a></li>
                            <li><a href="{{ route('products.kids') }}"><i class="fa fa-chevron-right"></i> Kid's
                                    Collection</a></li>
                            <li><a href="{{ route('about.us') }}"><i class="fa fa-chevron-right"></i> About Us</a></li>
                            <li><a href="{{ route('certifications') }}"><i class="fa fa-chevron-right"></i>
                                    Certifications</a></li>
                            <li><a href="{{ route('career') }}"><i class="fa fa-chevron-right"></i> Career</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Contact Widget -->
                <div class="col-lg-3 col-md-6 col-sm-12 widget-area">
                    <div class="widget widget-latest-tweets clearfix">
                        <h3 class="widget-title-enhanced">Get in Touch</h3>
                        <ul class="contact-wrapper">
                            <li class="contact-item">
                                <div class="contact-icon-box">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <span class="contact-content">Plot # XX, Road # XX, Sector # XX, Uttara, Dhaka-1230,
                                    Bangladesh</span>
                            </li>
                            <li class="contact-item">
                                <div class="contact-icon-box">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <span class="contact-content">+880 1234 567890</span>
                            </li>
                            <li class="contact-item">
                                <div class="contact-icon-box">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <span class="contact-content">
                                    <a href="mailto:info@integra-apparels.com">info@integra-apparels.com</a>
                                </span>
                            </li>
                        </ul>
                        <a class="request-quote-btn" href="{{ route('contact.us') }}">Request A Quote</a>
                    </div>
                </div>
            </div>

            <!-- Memberships & Certifications Section -->
            {{-- <div class="row cert-section">
                <div class="col-lg-12 text-center">
                    <h3 class="cert-title">Accreditations & Memberships</h3>
                    <div class="d-flex justify-content-center align-items-center flex-wrap">
                        <div class="cert-logo">
                            <img src="{{ asset('frontend/assets/images/client/client-01.png') }}"
                                alt="Certification 1">
                        </div>
                        <div class="cert-logo">
                            <img src="{{ asset('frontend/assets/images/client/client-02.png') }}"
                                alt="Certification 2">
                        </div>
                        <div class="cert-logo">
                            <img src="{{ asset('frontend/assets/images/client/client-03.png') }}"
                                alt="Certification 3">
                        </div>
                        <div class="cert-logo">
                            <img src="{{ asset('frontend/assets/images/client/client-04.png') }}"
                                alt="Certification 4">
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <div class="bottom-footer-text copyright">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 text-center text-lg-left">
                    <span class="copyright-text">Copyright © {{ date('Y') }} <span
                            style="color: #fff; font-weight: 500;">Integra Apparels (Bangladesh) Ltd.</span> All rights
                        reserved.</span>
                </div>
                <div class="col-lg-6 col-md-12 text-center text-lg-right mt-3 mt-lg-0">
                    <div class="footer-bottom-links">
                        

                            Developed by <a href="https://globalinformatics.com.bd" target="_blank"
                                class="developer-link">Global Informatics Ltd.</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!--back-to-top start-->
<a id="totop" href="#top">
    <i class="fa fa-angle-up"></i>
</a>
<!--back-to-top end-->
