<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.includes.header')
    @include('frontend.includes.css')
    <style>
        #gen-loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #ffffff;
            z-index: 99999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
        }

        #gen-loading img {
            max-width: 200px;
            height: auto;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(0.95);
                opacity: 0.8;
            }

            50% {
                transform: scale(1);
                opacity: 1;
            }

            100% {
                transform: scale(0.95);
                opacity: 0.8;
            }
        }

        .loaded #gen-loading {
            opacity: 0;
            visibility: hidden;
        }
    </style>
</head>

<body>
    <!-- Preloader -->
    <div id="gen-loading">
        <div id="gen-loading-center">
            <img src="{{ asset('frontend/assets/images/logo-img.png') }}" alt="loading">
        </div>
    </div>
    <!-- End Preloader -->

    <!--page start-->
    <div class="page">
        {{-- <div id="preloader" class="blobs-wrapper">
        <div class="ttm-bgcolor-skincolor loader-blob"></div>
      </div> --}}

        <!--header start-->
        @include('frontend.includes.navbar')
        <!--header end-->

        @yield('content')

        <!--footer start-->
        @include('frontend.includes.footer')
        <!--footer end-->
    </div>
    <!-- page end -->

    <!-- Javascript -->
    @include('frontend.includes.script')
    @stack('script')
    <script>
        window.addEventListener('load', function() {
            document.body.classList.add('loaded');
        });
    </script>
    <!-- Javascript end-->
</body>

</html>
