<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .mobile-bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 70px;
            background: #ffffff;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-around;
            align-items: center;
            z-index: 9999;
        }

        .mobile-bottom-nav a {
            text-decoration: none;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 11px;
            color: #777;
            transition: 0.3s;
        }

        .nav-item i {
            font-size: 20px;
            margin-bottom: 3px;
        }

        .nav-item.active {
            color: #ff6a00;
        }

        .nav-item:hover {
            color: #ff6a00;
        }

        /* tombol tengah */

        .nav-center {
            position: relative;
            top: -28px;
            width: 65px;
            height: 65px;
            background: #ff6a00;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white !important;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            transition: 0.3s;
        }

        .nav-center i {
            font-size: 26px;
        }

        .nav-center:hover {
            transform: scale(1.05);
        }

        /* padding agar konten tidak tertutup navbar */

        body {
            padding-bottom: 80px;
        }

        /* sembunyikan di desktop */

        @media (min-width: 768px) {
            .mobile-bottom-nav {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="mobile-bottom-nav">

        <a href="{{ url('/lokasi') }}" class="nav-item {{ request()->is('lokasi') ? 'active' : '' }}">
            <i class="fa fa-map-marker"></i>
            <span>Lokasi</span>
        </a>

        <a href="{{ url('/riwayat-iklan') }}" class="nav-item {{ request()->is('riwayat-iklan') ? 'active' : '' }}">
            <i class="fa fa-history"></i>
            <span>Riwayat</span>
        </a>

        <a href="{{ url('/buat-iklan') }}" class="nav-center {{ request()->is('buat-iklan') ? 'active' : '' }}">
            <i class="fa fa-plus"></i>
        </a>

        <a href="{{ url('/pantau-iklan') }}" class="nav-item {{ request()->is('pantau-iklan') ? 'active' : '' }}">
            <i class="fa fa-line-chart"></i>
            <span>Pantau</span>
        </a>

        <a href="{{ url('/akun') }}" class="nav-item {{ request()->is('akun') ? 'active' : '' }}">
            <i class="fa fa-user"></i>
            <span>Akun</span>
        </a>

    </div>
</body>

</html>
