@extends('backend.layout.template')
@section('title')
    Dashboard
@endsection
@section('page_subtitle')
    Overview of system statistics and metrics
@endsection
@section('body-content')
    <div class="container-fluid">
        <!-- Welcome Banner -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-primary text-white">
                    <div class="card-body p-4">
                        <h4 class="mb-2">Welcome back, Admin!</h4>
                        <p class="mb-0">Here's what's happening with your website today.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="row">
            <!-- Clients -->
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0 shadow-sm">
                    <div class="card-body">
                        <div class="media static-top-widget d-flex align-items-center">
                            <div class="align-self-center text-center bg-light-primary p-3 rounded-circle me-3">
                                <i data-feather="users" class="text-primary" style="width: 24px; height: 24px;"></i>
                            </div>
                            <div class="media-body">
                                <span class="m-0 text-muted">Total Clients</span>
                                <h4 class="mb-0 counter fw-bold text-primary">{{ $totalClients }}</h4>
                            </div>
                        </div>
                        <a href="{{ route('admin.clients.index') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>

            <!-- Products -->
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0 shadow-sm">
                    <div class="card-body">
                        <div class="media static-top-widget d-flex align-items-center">
                            <div class="align-self-center text-center bg-light-info p-3 rounded-circle me-3">
                                <i data-feather="box" class="text-info" style="width: 24px; height: 24px;"></i>
                            </div>
                            <div class="media-body">
                                <span class="m-0 text-muted">Products</span>
                                <h4 class="mb-0 counter fw-bold text-info">{{ $totalProducts }}</h4>
                            </div>
                        </div>
                        <a href="{{ route('admin.product-items.index') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>

            <!-- Industries -->
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0 shadow-sm">
                    <div class="card-body">
                        <div class="media static-top-widget d-flex align-items-center">
                            <div class="align-self-center text-center bg-light-success p-3 rounded-circle me-3">
                                <i data-feather="layers" class="text-success" style="width: 24px; height: 24px;"></i>
                            </div>
                            <div class="media-body">
                                <span class="m-0 text-muted">Industries</span>
                                <h4 class="mb-0 counter fw-bold text-success">{{ $totalIndustries }}</h4>
                            </div>
                        </div>
                        <a href="{{ route('admin.industry-items.index') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>

            <!-- Certifications -->
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0 shadow-sm">
                    <div class="card-body">
                        <div class="media static-top-widget d-flex align-items-center">
                            <div class="align-self-center text-center bg-light-warning p-3 rounded-circle me-3">
                                <i data-feather="award" class="text-warning" style="width: 24px; height: 24px;"></i>
                            </div>
                            <div class="media-body">
                                <span class="m-0 text-muted">Certifications</span>
                                <h4 class="mb-0 counter fw-bold text-warning">{{ $totalCertifications }}</h4>
                            </div>
                        </div>
                        <a href="{{ route('admin.certifications.index') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>

            <!-- Careers -->
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0 shadow-sm">
                    <div class="card-body">
                        <div class="media static-top-widget d-flex align-items-center">
                            <div class="align-self-center text-center bg-light-danger p-3 rounded-circle me-3">
                                <i data-feather="briefcase" class="text-danger" style="width: 24px; height: 24px;"></i>
                            </div>
                            <div class="media-body">
                                <span class="m-0 text-muted">Career Posts</span>
                                <h4 class="mb-0 counter fw-bold text-danger">{{ $totalCareers }}</h4>
                            </div>
                        </div>
                        {{-- <a href="{{ route('admin.careers.index') }}" class="stretched-link"></a> --}}
                    </div>
                </div>
            </div>

            <!-- About Us -->
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0 shadow-sm">
                    <div class="card-body">
                        <div class="media static-top-widget d-flex align-items-center">
                            <div class="align-self-center text-center bg-light-secondary p-3 rounded-circle me-3">
                                <i data-feather="info" class="text-secondary" style="width: 24px; height: 24px;"></i>
                            </div>
                            <div class="media-body">
                                <span class="m-0 text-muted">About Us</span>
                                <h4 class="mb-0 fw-bold text-secondary" style="font-size: 1.2rem;">
                                    {{ $aboutUs ? 'Manage' : 'Setup' }}
                                </h4>
                            </div>
                        </div>
                        <a href="{{ route('admin.about-us.edit') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-light-primary {
            background-color: rgba(36, 105, 92, 0.1) !important;
        }

        .bg-light-secondary {
            background-color: rgba(108, 117, 125, 0.1) !important;
        }

        .bg-light-info {
            background-color: rgba(68, 102, 242, 0.1) !important;
        }

        .bg-light-success {
            background-color: rgba(30, 201, 12, 0.1) !important;
        }

        .bg-light-warning {
            background-color: rgba(255, 159, 64, 0.1) !important;
        }

        .bg-light-danger {
            background-color: rgba(255, 99, 132, 0.1) !important;
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
        }
    </style>
@endsection
