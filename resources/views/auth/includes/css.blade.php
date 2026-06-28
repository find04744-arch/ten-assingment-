<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
    *, *::before, *::after { box-sizing: border-box; }

    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        padding: 20px;
    }

    .login-card {
        width: 100%;
        max-width: 440px;
        padding: 44px 40px;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
    }

    .login-header {
        text-align: center;
        margin-bottom: 32px;
    }

    .login-header .brand-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 64px;
        height: 64px;
        border-radius: 16px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        margin-bottom: 12px;
    }

    .login-header .brand-icon i {
        color: #fff !important;
        font-size: 1.75rem !important;
    }

    .login-header h4 {
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 6px;
        font-size: 1.65rem;
    }

    .login-header h6 {
        color: #6b7280;
        font-weight: 400;
        font-size: 0.93rem;
        margin: 0;
    }

    .form-label {
        color: #374151;
        font-size: 0.875rem;
        margin-bottom: 6px;
    }

    .form-control {
        padding: 11px 14px;
        border-radius: 0 10px 10px 0;
        border: 1.5px solid #e5e7eb;
        background-color: #fafafa;
        font-size: 0.93rem;
        color: #111827;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.18);
        border-color: #667eea;
        background-color: #fff;
        outline: none;
    }

    .form-control[readonly] {
        background-color: #f3f4f6;
        color: #6b7280;
    }

    .input-group-text {
        background-color: #fafafa;
        border: 1.5px solid #e5e7eb;
        border-right: none;
        border-radius: 10px 0 0 10px;
        color: #9ca3af;
        padding: 11px 13px;
        transition: border-color 0.2s;
    }

    .input-group:focus-within .input-group-text {
        border-color: #667eea;
        color: #667eea;
    }

    .input-group-text.border-start-0 {
        border: 1.5px solid #e5e7eb;
        border-left: none;
        border-radius: 0 10px 10px 0;
        cursor: pointer;
        background-color: #fafafa;
    }

    .input-group:focus-within .input-group-text.border-start-0 {
        border-color: #667eea;
    }

    .input-group .form-control {
        border-left: none;
        border-radius: 0;
    }

    .input-group .form-control:only-child {
        border-radius: 10px;
        border-left: 1.5px solid #e5e7eb;
    }

    .btn-primary {
        padding: 12px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.95rem;
        letter-spacing: 0.3px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        transition: all 0.2s;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.5);
        background: linear-gradient(135deg, #5a6fd6 0%, #6a3d96 100%);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    .btn-primary:focus {
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3);
    }

    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }

    .form-check-input:focus {
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.18);
        border-color: #667eea;
    }

    .alert {
        border-radius: 10px;
        font-size: 0.88rem;
        border: none;
    }

    .alert-success {
        background: #d1fae5;
        color: #065f46;
    }

    .alert-danger {
        background: #fee2e2;
        color: #991b1b;
    }

    a {
        text-decoration: none;
        transition: color 0.2s;
    }

    a.text-primary {
        color: #667eea !important;
    }

    a.text-primary:hover {
        color: #4f5ec8 !important;
    }

    .is-invalid {
        border-color: #ef4444 !important;
    }

    .is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15) !important;
    }

    @media (max-width: 480px) {
        .login-card {
            padding: 32px 24px;
            border-radius: 16px;
        }
    }
</style>
