@extends('layouts.app')

@section('title', 'Đăng Nhập - TechZone')

@section('styles')
<style>
    body { overflow: hidden; }

    .auth-wrapper {
        display: flex;
        min-height: 100vh;
    }

    /* LEFT PANEL - Image */
    .auth-left {
        flex: 1;
        position: relative;
        display: none;
        overflow: hidden;
    }

    @media (min-width: 992px) {
        .auth-left { display: flex; align-items: center; justify-content: center; }
    }

    .auth-left-bg {
        position: absolute;
        inset: 0;
        background-image: url('/images/login-bg.png');
        background-size: cover;
        background-position: center;
        filter: brightness(0.6);
    }

    .auth-left-content {
        position: relative;
        z-index: 1;
        text-align: center;
        padding: 2rem;
        color: white;
    }

    .auth-left-content img {
        width: 80px;
        height: 80px;
        object-fit: contain;
        margin-bottom: 1.5rem;
        filter: drop-shadow(0 0 20px rgba(108,99,255,0.8));
    }

    .auth-left-content h1 {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #fff 0%, #a78bfa 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.5rem;
    }

    .hero-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(108,99,255,0.25);
        border: 1px solid rgba(108,99,255,0.4);
        border-radius: 50px;
        padding: 6px 16px;
        font-size: 0.85rem;
        color: #c4b5fd;
        margin-bottom: 1.5rem;
    }

    .feature-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        justify-content: center;
        margin-top: 1.5rem;
    }

    .feature-pill {
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 50px;
        padding: 6px 14px;
        font-size: 0.8rem;
        color: #e2e8f0;
    }

    /* RIGHT PANEL - Form */
    .auth-right {
        width: 100%;
        max-width: 480px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        overflow-y: auto;
        height: 100vh;
    }

    @media (min-width: 992px) {
        .auth-right { flex: 0 0 480px; }
    }

    .auth-card {
        width: 100%;
        background: rgba(255,255,255,0.05);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: 0 25px 50px rgba(0,0,0,0.4);
    }

    .brand-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 2rem;
    }

    .brand-logo img {
        width: 40px;
        height: 40px;
        object-fit: contain;
        filter: drop-shadow(0 0 8px rgba(108,99,255,0.6));
    }

    .brand-logo span {
        font-size: 1.3rem;
        font-weight: 800;
        background: linear-gradient(135deg, #6c63ff, #a78bfa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .auth-card h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.25rem;
    }

    .auth-card .subtitle {
        color: #94a3b8;
        font-size: 0.9rem;
        margin-bottom: 2rem;
    }

    /* Form Controls */
    .form-label {
        color: #cbd5e1;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 0.4rem;
    }

    .input-group-text {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.12);
        border-right: none;
        color: #6c63ff;
    }

    .form-control {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.12);
        border-left: none;
        color: white;
        transition: all 0.3s;
    }

    .form-control:focus {
        background: rgba(108,99,255,0.08);
        border-color: #6c63ff;
        color: white;
        box-shadow: 0 0 0 3px rgba(108,99,255,0.2);
    }

    .form-control::placeholder { color: #64748b; }

    .input-group:focus-within .input-group-text {
        border-color: #6c63ff;
        color: #a78bfa;
    }

    /* Button */
    .btn-login {
        background: linear-gradient(135deg, #6c63ff 0%, #a78bfa 100%);
        border: none;
        border-radius: 12px;
        padding: 13px;
        font-size: 1rem;
        font-weight: 600;
        color: white;
        width: 100%;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }

    .btn-login::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        transition: left 0.5s;
    }

    .btn-login:hover::before { left: 100%; }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(108,99,255,0.5);
    }

    .btn-login:active { transform: translateY(0); }

    /* Divider */
    .divider {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 1.5rem 0;
    }

    .divider::before, .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: rgba(255,255,255,0.1);
    }

    .divider span { color: #64748b; font-size: 0.8rem; }

    /* Social Buttons */
    .btn-social {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 10px;
        padding: 10px;
        color: #cbd5e1;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.3s;
        width: 100%;
        text-align: center;
    }

    .btn-social:hover {
        background: rgba(255,255,255,0.1);
        color: white;
        transform: translateY(-1px);
    }

    /* Alert */
    .alert-custom {
        background: rgba(239,68,68,0.1);
        border: 1px solid rgba(239,68,68,0.3);
        border-radius: 12px;
        color: #fca5a5;
        padding: 12px 16px;
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
    }

    .alert-success-custom {
        background: rgba(56,239,125,0.1);
        border: 1px solid rgba(56,239,125,0.3);
        border-radius: 12px;
        color: #6ee7b7;
        padding: 12px 16px;
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
    }

    /* Remember & Check */
    .form-check-input:checked {
        background-color: #6c63ff;
        border-color: #6c63ff;
    }

    .form-check-label { color: #94a3b8; font-size: 0.875rem; }

    .link-purple {
        color: #a78bfa;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s;
    }

    .link-purple:hover { color: #6c63ff; }

    /* Input toggle password */
    .password-toggle {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.12);
        border-left: none;
        color: #64748b;
        cursor: pointer;
        transition: color 0.2s;
    }

    .password-toggle:hover { color: #a78bfa; }
</style>
@endsection

@section('content')
<div class="auth-wrapper">

    {{-- LEFT: Decorative Panel --}}
    <div class="auth-left">
        <div class="auth-left-bg"></div>
        <div class="auth-left-content">
            <img src="/images/logo.png" alt="TechZone Logo">
            <div class="hero-tag">
                <i class="bi bi-stars"></i> Cửa hàng phụ kiện #1 Việt Nam
            </div>
            <h1>TechZone</h1>
            <p class="text-secondary" style="font-size:1.1rem;">Trải nghiệm mua sắm công nghệ<br>đỉnh cao nhất</p>
            <div class="feature-pills">
                <span class="feature-pill"><i class="bi bi-headphones me-1"></i>Tai nghe</span>
                <span class="feature-pill"><i class="bi bi-mouse me-1"></i>Chuột</span>
                <span class="feature-pill"><i class="bi bi-keyboard me-1"></i>Bàn phím</span>
                <span class="feature-pill"><i class="bi bi-battery-charging me-1"></i>Sạc dự phòng</span>
                <span class="feature-pill"><i class="bi bi-lightning me-1"></i>Flash Sale 24/7</span>
            </div>
        </div>
    </div>

    {{-- RIGHT: Login Form --}}
    <div class="auth-right">
        <div class="auth-card">

            {{-- Brand --}}
            <div class="brand-logo">
                <img src="/images/logo.png" alt="logo">
                <span>TechZone</span>
            </div>

            <h2>Chào mừng trở lại!</h2>
            <p class="subtitle">Đăng nhập để tiếp tục mua sắm</p>

            {{-- Alerts --}}
            @if(session('success'))
                <div class="alert-success-custom">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert-custom">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    @foreach($errors->all() as $err) {{ $err }}<br> @endforeach
                </div>
            @endif

            {{-- Login Form --}}
            <form action="{{ route('login.submit') }}" method="POST" id="loginForm">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Địa chỉ Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="your@email.com"
                               value="{{ old('email') }}"
                               autocomplete="email"
                               required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mật khẩu</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password"
                               id="password"
                               name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="••••••••"
                               autocomplete="current-password"
                               required>
                        <button type="button" class="password-toggle input-group-text" onclick="togglePassword('password', this)">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                    </div>
                </div>

                <button type="submit" class="btn-login mb-3" id="loginBtn">
                    <span id="loginBtnText"><i class="bi bi-box-arrow-in-right me-2"></i>Đăng Nhập</span>
                    <span id="loginBtnLoader" class="d-none">
                        <span class="spinner-border spinner-border-sm me-2"></span>Đang đăng nhập...
                    </span>
                </button>

                <div class="divider"><span>hoặc đăng nhập với</span></div>

                <div class="row g-2 mb-4">
                    <div class="col-6">
                        <button type="button" class="btn-social">
                            <svg width="16" height="16" viewBox="0 0 24 24" class="me-2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                            </svg>
                            Google
                        </button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn-social">
                            <i class="bi bi-facebook me-2 text-primary"></i>Facebook
                        </button>
                    </div>
                </div>

                <p class="text-center mb-0" style="color:#94a3b8;font-size:0.9rem;">
                    Chưa có tài khoản?
                    <a href="{{ route('register') }}" class="link-purple">Đăng ký miễn phí</a>
                </p>
            </form>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function togglePassword(id, btn) {
        const input = document.getElementById(id);
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'bi bi-eye';
        }
    }

    document.getElementById('loginForm').addEventListener('submit', function() {
        document.getElementById('loginBtnText').classList.add('d-none');
        document.getElementById('loginBtnLoader').classList.remove('d-none');
    });
</script>
@endsection
