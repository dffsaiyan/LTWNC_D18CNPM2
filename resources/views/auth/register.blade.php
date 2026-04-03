@extends('layouts.app')

@section('title', 'Đăng Ký - TechZone')

@section('styles')
<style>
    body { overflow-x: hidden; }

    .register-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
    }

    .register-card {
        background: rgba(255,255,255,0.05);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 24px;
        padding: 2.5rem;
        width: 100%;
        max-width: 520px;
        box-shadow: 0 25px 60px rgba(0,0,0,0.4);
        animation: slideUp 0.5s ease-out;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .brand-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 0.5rem;
    }

    .brand-logo img {
        width: 38px;
        height: 38px;
        object-fit: contain;
        filter: drop-shadow(0 0 8px rgba(56,239,125,0.6));
    }

    .brand-logo span {
        font-size: 1.25rem;
        font-weight: 800;
        background: linear-gradient(135deg, #38ef7d, #11998e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .register-card h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.25rem;
    }

    .register-card .subtitle {
        color: #94a3b8;
        font-size: 0.9rem;
        margin-bottom: 1.75rem;
    }

    /* Progress Steps */
    .step-indicator {
        display: flex;
        align-items: center;
        gap: 0;
        margin-bottom: 2rem;
    }

    .step {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        font-size: 0.8rem;
        font-weight: 700;
        background: rgba(255,255,255,0.08);
        border: 2px solid rgba(255,255,255,0.15);
        color: #64748b;
        transition: all 0.3s;
    }

    .step.active {
        background: linear-gradient(135deg, #38ef7d, #11998e);
        border-color: transparent;
        color: #0f2417;
        box-shadow: 0 0 15px rgba(56,239,125,0.4);
    }

    .step-line {
        flex: 1;
        height: 2px;
        background: rgba(255,255,255,0.1);
    }

    /* Form */
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
        color: #38ef7d;
    }

    .form-control {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.12);
        border-left: none;
        color: white;
        transition: all 0.3s;
    }

    .form-control:focus {
        background: rgba(56,239,125,0.06);
        border-color: #38ef7d;
        color: white;
        box-shadow: 0 0 0 3px rgba(56,239,125,0.15);
    }

    .form-control::placeholder { color: #64748b; }

    .input-group:focus-within .input-group-text {
        border-color: #38ef7d;
    }

    .form-control.is-invalid {
        border-color: rgba(239,68,68,0.6) !important;
    }

    .form-control.is-valid {
        border-color: rgba(56,239,125,0.6) !important;
    }

    /* Password strength */
    .password-strength {
        margin-top: 8px;
    }

    .strength-bar {
        height: 4px;
        border-radius: 2px;
        background: rgba(255,255,255,0.1);
        overflow: hidden;
    }

    .strength-fill {
        height: 100%;
        border-radius: 2px;
        transition: all 0.3s;
        width: 0%;
    }

    .strength-text {
        font-size: 0.75rem;
        margin-top: 4px;
        font-weight: 500;
    }

    /* Button */
    .btn-register {
        background: linear-gradient(135deg, #38ef7d 0%, #11998e 100%);
        border: none;
        border-radius: 12px;
        padding: 13px;
        font-size: 1rem;
        font-weight: 700;
        color: #0f2417;
        width: 100%;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }

    .btn-register::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .btn-register:hover::before { left: 100%; }
    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(56,239,125,0.4);
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

    .link-green {
        color: #6ee7b7;
        text-decoration: none;
        font-weight: 600;
    }

    .link-green:hover { color: #38ef7d; }

    .terms-text {
        color: #64748b;
        font-size: 0.8rem;
        text-align: center;
        margin-top: 1rem;
    }

    .terms-text a { color: #94a3b8; }

    .password-toggle {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.12);
        border-left: none;
        color: #64748b;
        cursor: pointer;
        transition: color 0.2s;
    }

    .password-toggle:hover { color: #38ef7d; }

    /* Benefits Banner */
    .benefits {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 1.75rem;
    }

    .benefit-item {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(56,239,125,0.06);
        border: 1px solid rgba(56,239,125,0.15);
        border-radius: 10px;
        padding: 10px 12px;
        font-size: 0.8rem;
        color: #a7f3d0;
    }

    .benefit-item i { color: #38ef7d; font-size: 1rem; }
</style>
@endsection

@section('content')
<div class="register-page">
    <div class="register-card">

        {{-- Brand --}}
        <div class="brand-logo">
            <img src="/images/logo.png" alt="TechZone">
            <span>TechZone</span>
        </div>

        <h2>Tạo tài khoản</h2>
        <p class="subtitle">Tham gia cộng đồng công nghệ của chúng tôi</p>

        {{-- Benefits --}}
        <div class="benefits">
            <div class="benefit-item">
                <i class="bi bi-lightning-charge-fill"></i>
                <span>Flash Sale độc quyền</span>
            </div>
            <div class="benefit-item">
                <i class="bi bi-truck"></i>
                <span>Giao hàng miễn phí</span>
            </div>
            <div class="benefit-item">
                <i class="bi bi-shield-check"></i>
                <span>Bảo hành chính hãng</span>
            </div>
            <div class="benefit-item">
                <i class="bi bi-gift"></i>
                <span>Ưu đãi thành viên</span>
            </div>
        </div>

        {{-- Errors --}}
        @if($errors->any())
            <div class="alert-custom">
                <i class="bi bi-exclamation-triangle me-2"></i>
                @foreach($errors->all() as $err)
                    {{ $err }}<br>
                @endforeach
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('register.submit') }}" method="POST" id="registerForm">
            @csrf

            <div class="mb-3">
                <label class="form-label">Họ và Tên</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    <input type="text"
                           id="name"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Nguyễn Văn A"
                           value="{{ old('name') }}"
                           oninput="validateName(this)"
                           required>
                </div>
            </div>

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
                           oninput="validateEmail(this)"
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
                           placeholder="Tối thiểu 6 ký tự"
                           oninput="checkStrength(this.value)"
                           required>
                    <button type="button" class="password-toggle input-group-text" onclick="togglePass('password', this)">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                <div class="password-strength">
                    <div class="strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
                    <p class="strength-text" id="strengthText" style="color:#64748b;">Nhập mật khẩu để kiểm tra độ mạnh</p>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Xác nhận mật khẩu</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
                    <input type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="Nhập lại mật khẩu"
                           oninput="checkMatch(this)"
                           required>
                    <button type="button" class="password-toggle input-group-text" onclick="togglePass('password_confirmation', this)">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-register mb-3" id="regBtn">
                <span id="regBtnText"><i class="bi bi-person-check-fill me-2"></i>Tạo Tài Khoản Ngay</span>
                <span id="regBtnLoader" class="d-none">
                    <span class="spinner-border spinner-border-sm me-2"></span>Đang tạo...
                </span>
            </button>

            <div class="terms-text">
                Bằng cách đăng ký, bạn đồng ý với
                <a href="#">Điều khoản dịch vụ</a> và
                <a href="#">Chính sách bảo mật</a>
            </div>

            <hr style="border-color:rgba(255,255,255,0.08);margin:1.5rem 0;">

            <p class="text-center mb-0" style="color:#94a3b8;font-size:0.9rem;">
                Đã có tài khoản?
                <a href="{{ route('login') }}" class="link-green">Đăng nhập ngay</a>
            </p>
        </form>

    </div>
</div>
@endsection

@section('scripts')
<script>
    function togglePass(id, btn) {
        const input = document.getElementById(id);
        const icon = btn.querySelector('i');
        input.type = input.type === 'password' ? 'text' : 'password';
        icon.className = input.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
    }

    function checkStrength(val) {
        const fill = document.getElementById('strengthFill');
        const text = document.getElementById('strengthText');
        let score = 0;
        if (val.length >= 6) score++;
        if (val.length >= 10) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        const levels = [
            { w: '0%',   c: '#ef4444', t: 'Nhập mật khẩu để kiểm tra độ mạnh' },
            { w: '25%',  c: '#ef4444', t: '❌ Yếu - Quá ngắn' },
            { w: '50%',  c: '#f59e0b', t: '⚠️ Trung bình - Nên thêm chữ hoa & số' },
            { w: '75%',  c: '#3b82f6', t: '✅ Khá mạnh' },
            { w: '90%',  c: '#10b981', t: '💪 Mạnh' },
            { w: '100%', c: '#38ef7d', t: '🔥 Rất mạnh!' },
        ];

        const l = val.length === 0 ? levels[0] : levels[Math.min(score, 5)];
        fill.style.width = l.w;
        fill.style.background = l.c;
        text.textContent = l.t;
        text.style.color = l.c;
    }

    function checkMatch(input) {
        const pw = document.getElementById('password').value;
        if (input.value === pw && pw.length > 0) {
            input.classList.add('is-valid');
            input.classList.remove('is-invalid');
        } else if (input.value.length > 0) {
            input.classList.add('is-invalid');
            input.classList.remove('is-valid');
        }
    }

    function validateName(input) {
        input.classList.toggle('is-valid', input.value.trim().length >= 2);
    }

    function validateEmail(input) {
        const valid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value);
        input.classList.toggle('is-valid', valid);
        input.classList.toggle('is-invalid', !valid && input.value.length > 0);
    }

    document.getElementById('registerForm').addEventListener('submit', function() {
        document.getElementById('regBtnText').classList.add('d-none');
        document.getElementById('regBtnLoader').classList.remove('d-none');
    });
</script>
@endsection
