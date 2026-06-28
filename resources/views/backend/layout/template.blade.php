<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Admin</title>
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/favicon-integra.png') }}" />
    @include('backend.includes.css')
</head>
<body>
    @include('backend.includes.loader')
    @include('backend.includes.topbar')
    
    <div class="dashboard-wrapper">
        @include('backend.includes.leftsidebar')
        
        <main class="main-content">
            @include('backend.includes.header')
            @yield('body-content')
            @include('backend.includes.footer')
        </main>
    </div>

    @include('backend.includes.scripts')
    @yield('script')
</body>
</html>
