<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --primary-color: #0d6efd;
        --secondary-color: #6c757d;
        --sidebar-bg: #ffffff;
        --sidebar-width: 260px;
        --body-bg: #f5f7fb;
        --text-color: #2c3e50;
        --active-link-bg: #e7f1ff;
        --active-link-color: #0d6efd;
        --topbar-height: 90px;
    }

    body {
        background-color: var(--body-bg);
        font-family: 'Montserrat', sans-serif;
        color: var(--text-color);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* Layout */
    .dashboard-wrapper {
        display: flex;
        flex: 1;
        overflow: hidden;
    }

    /* Topbar */
    .navbar-custom {
        height: var(--topbar-height);
        background-color: #fff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        z-index: 1000;
        padding: 0 2rem;
        display: flex;
        align-items: center;
    }

    .navbar-custom .search-bar input {
        background-color: #f4f7f6;
        border: none;
        padding: 10px 20px;
        border-radius: 50px;
        width: 300px;
        transition: all 0.3s;
    }

    .navbar-custom .search-bar input:focus {
        background-color: #fff;
        box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.2);
        width: 350px;
    }

    .navbar-custom .icon-item {
        position: relative;
        padding: 0 12px;
        color: #6c757d;
        font-size: 1.2rem;
        transition: color 0.3s;
        cursor: pointer;
    }

    .navbar-custom .icon-item:hover {
        color: var(--primary-color);
    }

    .navbar-custom .icon-item .badge {
        position: absolute;
        top: -5px;
        right: 0;
        padding: 4px 6px;
        border-radius: 50%;
        font-size: 10px;
    }

    /* Sidebar */
    .sidebar {
        width: var(--sidebar-width);
        background-color: var(--sidebar-bg);
        border-right: 1px solid #dee2e6;
        display: flex;
        flex-direction: column;
        height: calc(100vh - var(--topbar-height));
        position: sticky;
        top: var(--topbar-height);
        overflow-y: auto;
    }

    .sidebar .nav-link {
        color: #555;
        font-weight: 500;
        padding: 12px 20px;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        border-radius: 0 25px 25px 0;
        margin-right: 10px;
    }

    .sidebar .nav-link i {
        margin-right: 10px;
        font-size: 1.1rem;
    }

    .sidebar .nav-link:hover {
        color: var(--primary-color);
        background-color: rgba(13, 110, 253, 0.05);
    }

    .sidebar .nav-link.active {
        color: var(--primary-color);
        background-color: var(--active-link-bg);
        font-weight: 600;
    }

    .sidebar-heading {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #adb5bd;
        margin: 20px 20px 10px;
        font-weight: 700;
    }

    /* Main Content */
    .main-content {
        flex: 1;
        padding: 30px;
        overflow-y: auto;
        height: calc(100vh - var(--topbar-height));
    }

    .admin-page-header {
        background-color: #fff;
        border: 1px solid rgba(0, 0, 0, 0.06);
        border-radius: 12px;
        padding: 16px 18px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
    }

    .admin-page-actions:empty {
        display: none;
    }

    /* Cards */
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.03);
        margin-bottom: 20px;
    }

    .card-header {
        background-color: #fff;
        border-bottom: 1px solid #f0f0f0;
        padding: 15px 20px;
        font-weight: 600;
    }

    .navbar-brand {
        font-weight: 700;
        color: var(--primary-color) !important;
        width: var(--sidebar-width);
        text-align: center;
    }

    .backend-page-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background-color: rgba(13, 110, 253, 0.08);
        background-image: url('{{ asset('frontend/assets/images/logo-img.png') }}');
        background-repeat: no-repeat;
        background-position: center;
        background-size: 24px 24px;
        display: inline-block;
        flex: 0 0 auto;
    }
</style>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
