<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TechZone - Phụ Kiện Công Nghệ')</title>
    <meta name="description" content="TechZone - Cửa hàng phụ kiện công nghệ hàng đầu Việt Nam">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Inter', sans-serif; }

        :root {
            --primary:   #6c63ff;
            --secondary: #a78bfa;
            --accent:    #38ef7d;
            --dark:      #0f0e17;
            --dark2:     #1a1a2e;
            --dark3:     #16213e;
            --glass:     rgba(255,255,255,0.06);
            --glass-border: rgba(255,255,255,0.12);
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--dark2); }
        ::-webkit-scrollbar-thumb { background: var(--primary); border-radius: 3px; }

        /* Animated Background Particles */
        .animated-bg {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: 0;
            background: linear-gradient(135deg, #0f0e17 0%, #1a1a2e 40%, #16213e 70%, #0f3460 100%);
            overflow: hidden;
        }

        .animated-bg::before {
            content: '';
            position: absolute;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(108,99,255,0.15) 0%, transparent 70%);
            top: -200px; right: -200px;
            animation: float1 8s ease-in-out infinite;
        }

        .animated-bg::after {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(56,239,125,0.1) 0%, transparent 70%);
            bottom: -100px; left: -100px;
            animation: float2 10s ease-in-out infinite;
        }

        @keyframes float1 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-30px, 40px) scale(1.1); }
        }

        @keyframes float2 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(40px, -30px) scale(1.15); }
        }

        /* Dots */
        .dot {
            position: absolute;
            border-radius: 50%;
            background: rgba(108,99,255,0.3);
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.3; }
            50% { transform: scale(1.5); opacity: 0.6; }
        }

        .page-wrapper {
            position: relative;
            z-index: 1;
            min-height: 100vh;
        }

    </style>

    @yield('styles')
</head>
<body>

<div class="animated-bg">
    <div class="dot" style="width:8px;height:8px;top:20%;left:15%;animation-delay:0s;"></div>
    <div class="dot" style="width:5px;height:5px;top:60%;left:80%;animation-delay:1s;"></div>
    <div class="dot" style="width:10px;height:10px;top:80%;left:30%;animation-delay:2s;"></div>
    <div class="dot" style="width:6px;height:6px;top:10%;left:70%;animation-delay:3s;"></div>
    <div class="dot" style="width:4px;height:4px;top:45%;left:50%;animation-delay:1.5s;"></div>
</div>

<div class="page-wrapper">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
