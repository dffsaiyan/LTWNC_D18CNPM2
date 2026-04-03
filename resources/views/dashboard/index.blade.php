@extends('layouts.app')

@section('title', 'Dashboard - TechZone Admin')

@section('styles')
<style>
    body { overflow-x: hidden; min-height: 100vh; }

    /* Sidebar */
    .sidebar {
        position: fixed;
        left: 0; top: 0; bottom: 0;
        width: 260px;
        background: rgba(15,14,23,0.95);
        backdrop-filter: blur(20px);
        border-right: 1px solid rgba(255,255,255,0.08);
        padding: 0;
        z-index: 100;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s;
    }

    .sidebar-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 1.5rem 1.5rem;
        border-bottom: 1px solid rgba(255,255,255,0.07);
    }

    .sidebar-brand img {
        width: 38px;
        height: 38px;
        object-fit: contain;
        filter: drop-shadow(0 0 8px rgba(108,99,255,0.7));
    }

    .sidebar-brand-text {
        font-size: 1.1rem;
        font-weight: 800;
        background: linear-gradient(135deg, #6c63ff, #a78bfa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1;
    }

    .sidebar-brand-sub {
        font-size: 0.7rem;
        color: #475569;
        font-weight: 400;
        margin-top: 2px;
    }

    .sidebar-section {
        padding: 1rem 1rem 0.5rem;
    }

    .sidebar-label {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: #475569;
        padding: 0 0.5rem;
        margin-bottom: 0.5rem;
    }

    .sidebar-nav a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 12px;
        border-radius: 10px;
        color: #94a3b8;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s;
        margin-bottom: 2px;
    }

    .sidebar-nav a:hover {
        background: rgba(108,99,255,0.12);
        color: #a78bfa;
    }

    .sidebar-nav a.active {
        background: linear-gradient(135deg, rgba(108,99,255,0.2), rgba(167,139,250,0.1));
        color: #a78bfa;
        border: 1px solid rgba(108,99,255,0.2);
    }

    .sidebar-nav a i { width: 20px; text-align: center; font-size: 1rem; }

    /* Badge in sidebar */
    .nav-badge {
        margin-left: auto;
        background: rgba(108,99,255,0.3);
        color: #c4b5fd;
        font-size: 0.7rem;
        padding: 2px 8px;
        border-radius: 50px;
        font-weight: 600;
    }

    .sidebar-footer {
        margin-top: auto;
        padding: 1rem 1.5rem;
        border-top: 1px solid rgba(255,255,255,0.07);
    }

    .user-mini {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6c63ff, #a78bfa);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: white;
        font-size: 0.9rem;
        flex-shrink: 0;
    }

    .user-mini-info { flex: 1; min-width: 0; }
    .user-mini-name { color: white; font-size: 0.875rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .user-mini-email { color: #64748b; font-size: 0.75rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

    /* Main Content */
    .main-content {
        margin-left: 260px;
        min-height: 100vh;
        padding: 0;
    }

    /* Top Bar */
    .topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 2rem;
        background: rgba(15,14,23,0.7);
        backdrop-filter: blur(16px);
        border-bottom: 1px solid rgba(255,255,255,0.07);
        position: sticky;
        top: 0;
        z-index: 50;
    }

    .topbar-title h5 {
        color: white;
        font-weight: 700;
        margin: 0;
        font-size: 1.1rem;
    }

    .topbar-title p {
        color: #64748b;
        margin: 0;
        font-size: 0.8rem;
    }

    .topbar-actions {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .btn-logout {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(239,68,68,0.1);
        border: 1px solid rgba(239,68,68,0.2);
        border-radius: 10px;
        padding: 8px 14px;
        color: #f87171;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
        cursor: pointer;
    }

    .btn-logout:hover {
        background: rgba(239,68,68,0.2);
        color: #fca5a5;
    }

    /* Content Area */
    .content-area {
        padding: 2rem;
    }

    /* Alert */
    .alert-success-dash {
        background: rgba(56,239,125,0.08);
        border: 1px solid rgba(56,239,125,0.2);
        border-radius: 14px;
        color: #6ee7b7;
        padding: 14px 18px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: slideIn 0.4s ease-out;
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateX(-20px); }
        to   { opacity: 1; transform: translateX(0); }
    }

    /* Greeting */
    .greeting {
        margin-bottom: 2rem;
    }

    .greeting h4 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.25rem;
    }

    .greeting p { color: #64748b; font-size: 0.9rem; margin: 0; }

    .greeting .time-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(108,99,255,0.15);
        border: 1px solid rgba(108,99,255,0.25);
        border-radius: 50px;
        padding: 4px 12px;
        font-size: 0.8rem;
        color: #a78bfa;
        margin-top: 8px;
    }

    /* Stat Cards */
    .stat-card {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 18px;
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
        transition: all 0.3s;
        height: 100%;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .stat-card:hover {
        border-color: rgba(108,99,255,0.25);
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.3);
    }

    .stat-card:hover::before { opacity: 1; }

    .stat-card.green::before { background: radial-gradient(circle, rgba(56,239,125,0.05) 0%, transparent 70%); }
    .stat-card.purple::before { background: radial-gradient(circle, rgba(108,99,255,0.08) 0%, transparent 70%); }
    .stat-card.blue::before { background: radial-gradient(circle, rgba(59,130,246,0.08) 0%, transparent 70%); }
    .stat-card.orange::before { background: radial-gradient(circle, rgba(249,115,22,0.08) 0%, transparent 70%); }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 1rem;
    }

    .stat-icon.green { background: rgba(56,239,125,0.12); color: #38ef7d; }
    .stat-icon.purple { background: rgba(108,99,255,0.15); color: #a78bfa; }
    .stat-icon.blue { background: rgba(59,130,246,0.15); color: #60a5fa; }
    .stat-icon.orange { background: rgba(249,115,22,0.15); color: #fb923c; }

    .stat-label {
        color: #64748b;
        font-size: 0.8rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        color: white;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-sub {
        font-size: 0.8rem;
        color: #475569;
    }

    .stat-sub .up { color: #38ef7d; }
    .stat-sub .neutral { color: #94a3b8; }

    /* DB Status Card */
    .db-card {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 18px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .db-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .db-status-badge.connected {
        background: rgba(56,239,125,0.12);
        border: 1px solid rgba(56,239,125,0.25);
        color: #38ef7d;
    }

    .db-status-badge.error {
        background: rgba(239,68,68,0.12);
        border: 1px solid rgba(239,68,68,0.25);
        color: #f87171;
    }

    .db-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        animation: blink 1.5s ease-in-out infinite;
    }

    .db-dot.on { background: #38ef7d; }
    .db-dot.off { background: #ef4444; animation: none; }

    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.3; }
    }

    /* Users Table */
    .table-card {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 18px;
        overflow: hidden;
    }

    .table-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid rgba(255,255,255,0.07);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .table-header h6 {
        color: white;
        font-weight: 700;
        margin: 0;
        font-size: 1rem;
    }

    .table-header span {
        color: #64748b;
        font-size: 0.8rem;
    }

    .table { margin: 0; }
    .table thead th {
        background: rgba(255,255,255,0.03);
        color: #64748b;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 0.75rem 1.5rem;
        border-color: rgba(255,255,255,0.05);
    }

    .table tbody td {
        padding: 0.9rem 1.5rem;
        border-color: rgba(255,255,255,0.05);
        color: #cbd5e1;
        font-size: 0.875rem;
        vertical-align: middle;
    }

    .table tbody tr:hover td {
        background: rgba(108,99,255,0.05);
    }

    .user-row-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6c63ff, #a78bfa);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: white;
        font-size: 0.85rem;
        flex-shrink: 0;
    }

    .badge-you {
        background: rgba(108,99,255,0.2);
        color: #a78bfa;
        font-size: 0.7rem;
        padding: 2px 8px;
        border-radius: 50px;
        border: 1px solid rgba(108,99,255,0.3);
    }

    .badge-active {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: rgba(56,239,125,0.1);
        color: #6ee7b7;
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 50px;
        font-weight: 500;
    }

    /* Mobile responsive */
    @media (max-width: 992px) {
        .sidebar { transform: translateX(-100%); }
        .main-content { margin-left: 0; }
    }
</style>
@endsection

@section('content')

{{-- Sidebar --}}
<div class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <img src="/images/logo.png" alt="TechZone">
        <div>
            <div class="sidebar-brand-text">TechZone</div>
            <div class="sidebar-brand-sub">Admin Panel</div>
        </div>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Tổng quan</div>
        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="active">
                <i class="bi bi-grid-fill"></i>
                Dashboard
            </a>
        </nav>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Quản lý</div>
        <nav class="sidebar-nav">
            <a href="#">
                <i class="bi bi-people-fill"></i>
                Người dùng
                <span class="nav-badge">{{ $totalUsers }}</span>
            </a>
            <a href="#"><i class="bi bi-box-seam"></i>Sản phẩm</a>
            <a href="#"><i class="bi bi-receipt"></i>Đơn hàng</a>
            <a href="#"><i class="bi bi-tag"></i>Danh mục</a>
        </nav>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Nâng cao</div>
        <nav class="sidebar-nav">
            <a href="#"><i class="bi bi-lightning-charge"></i>Flash Sale</a>
            <a href="#"><i class="bi bi-ticket-perforated"></i>Voucher</a>
            <a href="#"><i class="bi bi-chat-dots"></i>Chat</a>
            <a href="#"><i class="bi bi-bar-chart-line"></i>Thống kê</a>
        </nav>
    </div>

    <div class="sidebar-footer">
        <div class="user-mini">
            <div class="user-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
            <div class="user-mini-info">
                <div class="user-mini-name">{{ $user->name }}</div>
                <div class="user-mini-email">{{ $user->email }}</div>
            </div>
        </div>
    </div>
</div>

{{-- Main --}}
<div class="main-content">

    {{-- Topbar --}}
    <div class="topbar">
        <div class="topbar-title">
            <h5><i class="bi bi-grid-fill me-2" style="color:#6c63ff;"></i>Dashboard</h5>
            <p>Tổng quan hệ thống & kết nối database</p>
        </div>
        <div class="topbar-actions">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i>
                    Đăng xuất
                </button>
            </form>
        </div>
    </div>

    <div class="content-area">

        {{-- Alert --}}
        @if(session('success'))
            <div class="alert-success-dash">
                <i class="bi bi-check-circle-fill fs-5"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- Greeting --}}
        <div class="greeting">
            <h4>Xin chào, {{ $user->name }}! 👋</h4>
            <p>Đây là tổng quan hệ thống của bạn hôm nay</p>
            <div class="time-badge">
                <i class="bi bi-clock"></i>
                {{ now()->format('H:i') }} — {{ now()->locale('vi')->isoFormat('dddd, D MMMM YYYY') }}
            </div>
        </div>

        {{-- DB Status Row --}}
        <div class="db-card mb-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon purple" style="margin-bottom:0;">
                        <i class="bi bi-database-fill"></i>
                    </div>
                    <div>
                        <div style="color:white;font-weight:700;font-size:1rem;">Kết nối MySQL / phpMyAdmin</div>
                        <div style="color:#64748b;font-size:0.8rem;">Database: <strong style="color:#94a3b8;">{{ $dbName }}</strong> · Host: 127.0.0.1:3306</div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="db-status-badge {{ $dbStatus ? 'connected' : 'error' }}">
                        <div class="db-dot {{ $dbStatus ? 'on' : 'off' }}"></div>
                        {{ $dbStatus ? '✓ Kết nối thành công' : '✗ Lỗi kết nối' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Stats Grid --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-lg-3">
                <div class="stat-card purple">
                    <div class="stat-icon purple"><i class="bi bi-people-fill"></i></div>
                    <div class="stat-label">Tổng người dùng</div>
                    <div class="stat-value">{{ $totalUsers }}</div>
                    <div class="stat-sub"><span class="neutral">Đã đăng ký trong hệ thống</span></div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card green">
                    <div class="stat-icon green"><i class="bi bi-person-plus-fill"></i></div>
                    <div class="stat-label">Đăng ký hôm nay</div>
                    <div class="stat-value">{{ $newToday }}</div>
                    <div class="stat-sub"><span class="up">↑ Hôm nay</span></div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card blue">
                    <div class="stat-icon blue"><i class="bi bi-calendar-week-fill"></i></div>
                    <div class="stat-label">Tuần này</div>
                    <div class="stat-value">{{ $newThisWeek }}</div>
                    <div class="stat-sub"><span class="neutral">Người đăng ký mới</span></div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card orange">
                    <div class="stat-icon orange"><i class="bi bi-person-badge-fill"></i></div>
                    <div class="stat-label">Tài khoản của bạn</div>
                    <div class="stat-value" style="font-size:1.1rem;padding-top:4px;">{{ $user->created_at->format('d/m/Y') }}</div>
                    <div class="stat-sub"><span class="neutral">Ngày tạo tài khoản</span></div>
                </div>
            </div>
        </div>

        {{-- Users Table --}}
        <div class="table-card">
            <div class="table-header">
                <h6><i class="bi bi-table me-2" style="color:#6c63ff;"></i>Danh sách người dùng — MySQL</h6>
                <span>{{ $allUsers->count() }} bản ghi</span>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Người dùng</th>
                            <th>Email</th>
                            <th>Ngày đăng ký</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allUsers as $i => $u)
                        <tr>
                            <td style="color:#475569;">{{ $i + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="user-row-avatar">
                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="color:white;font-weight:600;">{{ $u->name }}</div>
                                        @if($u->id === Auth::id())
                                            <span class="badge-you">Bạn</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="color:#94a3b8;">{{ $u->email }}</td>
                            <td style="color:#64748b;">{{ $u->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge-active">
                                    <span style="width:5px;height:5px;border-radius:50%;background:#38ef7d;"></span>
                                    Hoạt động
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5" style="color:#475569;">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Chưa có người dùng nào
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')
<script>
    // Auto-dismiss alert
    setTimeout(() => {
        const alert = document.querySelector('.alert-success-dash');
        if (alert) {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }
    }, 4000);
</script>
@endsection
