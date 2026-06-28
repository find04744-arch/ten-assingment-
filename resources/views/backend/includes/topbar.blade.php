<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <img id="logo-img" class="img-fluid logo-img" style="height: 60px; width: 199px; margin-left: -62px;"
                src="{{ asset('frontend/assets/images/logo-img.png') }}" alt="Integra Apparels" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminTopbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminTopbar">

            <!-- Search Bar -->
            {{-- <div class="search-bar mx-auto d-none d-lg-block">
                <form class="d-flex position-relative">
                    <input class="form-control" type="search" placeholder="Search here..." aria-label="Search">
                    <i class="bi bi-search position-absolute text-muted" style="right: 15px; top: 12px;"></i>
                </form>
            </div> --}}

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">

                <!-- View Website Button -->
                <li class="nav-item me-3 d-none d-md-block">
                    <a class="btn btn-outline-primary rounded-pill px-4 btn-sm d-flex align-items-center gap-2"
                        href="{{ route('home') }}" target="_blank">
                        <i class="bi bi-globe"></i> <span>View Website</span>
                    </a>
                </li>

                <!-- Notifications -->
                {{-- <li class="nav-item dropdown me-3 d-none d-md-block">
                    <a class="icon-item" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-danger">3</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-0" style="width: 300px;">
                        <div class="p-3 border-bottom bg-light rounded-top">
                            <h6 class="mb-0">Notifications</h6>
                        </div>
                        <div class="p-2">
                            <a href="#" class="dropdown-item p-2 rounded">
                                <small class="text-muted d-block">Just now</small>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-info-circle text-primary me-2"></i> New order received
                                </div>
                            </a>
                            <a href="#" class="dropdown-item p-2 rounded">
                                <small class="text-muted d-block">1 hour ago</small>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person-plus text-success me-2"></i> New user registered
                                </div>
                            </a>
                        </div>
                    </ul>
                </li> --}}

                {{-- <li class="nav-item dropdown me-3 d-none d-md-block">
                    <a class="icon-item" href="#">
                        <i class="bi bi-chat-square-text"></i>
                        <span class="badge bg-primary">5</span>
                    </a>
                </li> --}}

                <li class="nav-item border-start ps-3 ms-2"></li>

                <!-- User Profile -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 text-dark" href="#"
                        id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle text-primary"
                            style="width: 45px; height: 45px;">
                            <i class="bi bi-person-fill fs-5"></i>
                        </div>
                        <div class="d-none d-md-block text-start">
                            <span class="fw-bold d-block lh-1">{{ Auth::user()->name ?? 'Administrator' }}</span>
                            <small class="text-muted" style="font-size: 0.75rem;">Admin</small>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2 rounded-3"
                        aria-labelledby="navbarDropdown" style="min-width: 220px;">
                        <li>
                            <div class="px-3 py-2 border-bottom mb-2">
                                <h6 class="mb-0 text-dark">{{ Auth::user()->name ?? 'Administrator' }}</h6>
                                <small class="text-muted">Admin Account</small>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-item rounded-2 py-2 d-flex align-items-center gap-2" href="#">
                                <i class="bi bi-person"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item rounded-2 py-2 d-flex align-items-center gap-2" href="#">
                                <i class="bi bi-gear"></i> Settings
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item text-danger rounded-2 py-2 d-flex align-items-center gap-2" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
