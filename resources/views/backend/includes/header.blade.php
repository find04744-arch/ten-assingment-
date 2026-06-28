@php
    $pageTitle = trim($__env->yieldContent('title'));
    $pageSubtitle = trim($__env->yieldContent('page_subtitle'));
@endphp

@if ($pageTitle !== '')
    <div class="container-fluid">
        <div class="admin-page-header mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div>
                        <h5 class="m-0">{{ $pageTitle }}</h5>
                        @if ($pageSubtitle !== '')
                            <div class="text-muted small">{{ $pageSubtitle }}</div>
                        @endif
                    </div>
                </div>
                <div class="admin-page-actions">
                    @yield('page_actions')
                </div>
            </div>
        </div>
    </div>
@endif
