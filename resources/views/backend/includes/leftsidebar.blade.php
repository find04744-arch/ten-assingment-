<aside class="sidebar">
    <div class="sidebar-heading">General</div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.contact-info.*') ? 'active' : '' }}"
                href="{{ route('admin.contact-info.edit') }}">
                <i class="bi bi-envelope"></i> Contact Info
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.about-us.*') ? 'active' : '' }}"
                href="{{ route('admin.about-us.edit') }}">
                <i class="bi bi-info-circle"></i> About Us
            </a>
        </li>
    </ul>

    <div class="sidebar-heading">Content</div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}"
                href="{{ route('admin.clients.index') }}">
                <i class="bi bi-people"></i> Clients
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.certifications.*') ? 'active' : '' }}"
                href="{{ route('admin.certifications.index') }}">
                <i class="bi bi-award"></i> Certifications
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.careers.*') ? 'active' : '' }}"
                href="{{ route('admin.careers.index') }}">
                <i class="bi bi-briefcase"></i> Careers
            </a>
        </li>
    </ul>

    <div class="sidebar-heading">Sections</div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.industry-items.*') ? 'active' : '' }}"
                href="{{ route('admin.industry-items.index') }}">
                <i class="bi bi-buildings"></i> Industries
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.product-items.*') ? 'active' : '' }}"
                href="{{ route('admin.product-items.index') }}">
                <i class="bi bi-box-seam"></i> Products
            </a>
        </li>
    </ul>
</aside>
