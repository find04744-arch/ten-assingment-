<header id="masthead" class="header ttm-header-style-02 clearfix">
    <div class="widget_header_wrapper ttm-bgcolor-darkgrey clearfix">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3">
                    <!-- site-branding -->
                    <div class="site-branding">
                        <a class="home-link" href="{{ route('home') }}" title="Integra" rel="home">
                            <img id="logo-img" height="78" width="232" class="img-fluid auto_size logo-img"
                                src="{{ asset('frontend/assets/images/logo-img.png') }}" alt="logo-img" />
                        </a>
                    </div>
                    <!-- site-branding end -->
                </div>
                <div class="col-xl-9">
                    <!-- ttm-widget-header -->
                    <div class="ttm-widget_header d-flex flex-row align-items-center justify-content-end">
                        <!-- widget-info -->
                        <div class="widget_info d-flex flex-row align-items-center justify-content-end">
                            <div class="widget_icon ttm-textcolor-skincolor">
                                <i class="flaticon flaticon-email-2"></i>
                            </div>
                            <div class="widget_content">
                                <p>Send Email</p>
                                <h3>info@example.com</h3>
                            </div>
                        </div>
                        <!-- widget-info end -->
                        <!-- widget-info -->
                        <div class="widget_info d-flex flex-row align-items-center justify-content-end">
                            <div class="widget_icon ttm-textcolor-skincolor">
                                <i class="flaticon flaticon-clock"></i>
                            </div>
                            <div class="widget_content">
                                <p>Working Hours</p>
                                <h3>Mon-Sat 09:00 am to 07:00 pm</h3>
                            </div>
                        </div>
                        <!-- widget-info end -->
                        <!-- widget-info -->
                        <div class="widget_info d-flex flex-row align-items-center justify-content-end">
                            <div class="widget_icon ttm-textcolor-skincolor">
                                <i class="flaticon flaticon-phone-call"></i>
                            </div>
                            <div class="widget_content">
                                <p>Have any Questions?</p>
                                <h3>+123 795 9841</h3>
                            </div>
                        </div>
                        <!-- widget-info end -->
                    </div>
                    <!-- ttm-widget-header end -->
                </div>
            </div>
        </div>
    </div>
    <div id="site-header-menu" class="site-header-menu ttm-bgcolor-white ttm-textcolor-darkgrey">
        <div class="site-header-menu-inner ttm-stickable-header">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <!--site-navigation -->
                        <div id="site-navigation" class="site-navigation">
                            <div class="site-navigation-content d-flex flex-row">
                                <div class="btn-show-menu-mobile menubar menubar--squeeze">
                                    <span class="menubar-box">
                                        <span class="menubar-inner"></span>
                                    </span>
                                </div>
                                <nav class="main-menu menu-mobile" id="menu">
                                    <ul class="menu">
                                        <li class="mega-menu-item active">
                                            <a href="{{ route('home') }}" class="mega-menu-link">Home</a>
                                            <!-- <ul class="mega-submenu">
                              <li><a href="index.html">Homepage 1</a></li>
                              <li class="active">
                                <a href="home-2.html">Homepage 2</a>
                              </li>
                              <li><a href="home-3.html">Homepage 3</a></li>
                            </ul> -->
                                        </li>
                                        <li class="mega-menu-item">
                                            <a href="{{ route('about.us') }}" class="mega-menu-link">About Us</a>
                                        </li>
                                        <li class="mega-menu-item">
                                            <a href="#" class="mega-menu-link">Our Industries</a>
                                            <ul class="mega-submenu">
                                                <li>
                                                    <a href="{{ route('industries.apparels') }}">Apparels</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('industries.design') }}">Design</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('industries.dresses') }}">Dresses</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('industries.washingplant') }}">Washing Plant</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('industries.togs') }}">Togs(E-Commerce)</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="mega-menu-item">
                                            <a href="#" class="mega-menu-link">Products</a>
                                            <ul class="mega-submenu">
                                                <li>
                                                    <a href="{{ route('products.mens') }}">Men</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('products.womens') }}">Women</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('products.kids') }}">Kids</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="mega-menu-item">
                                            <a href="{{ route('our.clients') }}" class="mega-menu-link">Our Clients</a>
                                        </li>
                                        <li class="mega-menu-item">
                                            <a href="{{ route('certifications') }}">Certifications</a>
                                        </li>
                                        <li class="mega-menu-item">
                                            <a href="{{ route('career') }}">Career</a>
                                        </li>
                                        <li class="mega-menu-item">
                                            <a href="{{ route('contact.us') }}">Contact us</a>
                                        </li>
                                    </ul>
                                </nav>
                                <div class="header_extra d-flex flex-row align-items-center ms-auto">
                                    <!-- <a
                          href="contact-us.html"
                          class="ttm-btn ttm-btn-size-sm ttm-btn-style-fill ttm-btn-shape-square ttm-btn-color-dark"
                          >Get Quote</a
                        > -->
                                    <!-- header_social -->
                                    <div class="header_social">
                                        <div class="social-icons">
                                            <ul class="social-icons list-inline ttm-textcolor-skincolor">
                                                <li>
                                                    <a class="tooltip-top" href="https://www.facebook.com/prt.333/"
                                                        rel="noopener" aria-label="facebook" data-tooltip="Facebook"
                                                        target="_blank"><i class="fa fa-facebook"></i></a>
                                                </li>
                                                <li>
                                                    <a class="tooltip-top"
                                                        href="https://www.linkedin.com/in/preyan-technosys-pvt-ltd/"
                                                        rel="noopener" aria-label="linkedin" data-tooltip="Linkedin"
                                                        target="_blank"><i class="fa fa-linkedin"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- header_social end-->
                                </div>
                            </div>
                        </div>
                        <!-- site-navigation end-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
