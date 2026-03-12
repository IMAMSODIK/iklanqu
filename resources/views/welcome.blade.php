<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IklanQu - Iklan provider modern</title>
    <link rel="shortcut icon" href="{{ asset('landing_assets/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('landing_assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing_assets/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('landing_assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing_assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing_assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('landing_assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('landing_assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('landing_assets/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .blog__content ul li a {
            text-align: center;
        }

        .blog__content ul li a i {
            color: var(--primary-color);
        }

        .blog__image {
            width: 100%;
            height: 300px;
            /* samakan tinggi gambar */
            overflow: hidden;
        }

        .blog__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* menjaga rasio gambar */
        }

        .counter__wrp {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            padding: 40px 20px;
        }

        .counter__item {
            flex: 1;
            min-width: 200px;
            text-align: center;
            padding: 30px 20px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(5px);
            transition: 0.3s;
        }

        .counter__item:hover {
            transform: translateY(-6px);
            background: rgba(255, 255, 255, 0.15);
        }

        .counter-icon {
            font-size: 40px;
            color: #fff;
            margin-bottom: 15px;
        }

        .counter__item h3 {
            font-size: 32px;
            font-weight: 700;
            color: #fff;
        }

        .counter__item p {
            margin-top: 5px;
            font-size: 14px;
        }

        .case-btn {
            margin-top: 15px;
        }

        .btn-iklanqu {
            display: inline-block;
            padding: 8px 18px;
            background: #ff6b00;
            color: #fff;
            font-size: 13px;
            border-radius: 5px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-iklanqu:hover {
            background: #ff8533;
        }

        .case__image {
            width: 100%;
            height: 300px;
            /* samakan tinggi gambar */
            overflow: hidden;
        }

        .case__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* agar gambar tidak gepeng */
            display: block;
        }

        .offer__icon i {
            font-size: 36px;
            color: #3C72FC;
        }

        .brand__image {
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand__image img {
            max-height: 60px;
            width: auto;
            max-width: 100%;
            object-fit: contain;
        }

        .price {
            font-size: 17px;
            font-weight: 400;
            color: #F6711F;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="loading">
        <span class="text-capitalize">I</span>
        <span>k</span>
        <span>l</span>
        <span>a</span>
        <span>n</span>
        <span>Q</span>
        <span>u</span>
    </div>
    <div id="preloader"></div>

    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>

    <div class="header-top d-none d-lg-block">
        <div class="container header__container">
            <div class="header-top-wrp">
                <ul class="info">
                    <li><svg width="15" height="12" viewBox="0 0 15 12" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M13.8748 8.50453C13.8748 9.85566 12.7757 10.953 11.4263 10.953H3.39325C2.04384 10.953 0.94475 9.85563 0.94475 8.50453V3.39322C0.944449 2.95776 1.06111 2.53021 1.28253 2.15525L5.20216 6.07488C5.78856 6.663 6.57384 6.98706 7.41059 6.98706C8.24563 6.98706 9.03091 6.663 9.61731 6.07488L13.5369 2.15525C13.7584 2.5302 13.875 2.95776 13.8747 3.39322V8.50453H13.8748ZM11.4263 0.94475H3.39325C2.836 0.94475 2.32159 1.13334 1.91009 1.44712L5.86916 5.40791C6.27897 5.81597 6.82591 6.04231 7.41059 6.04231C7.99356 6.04231 8.54053 5.81597 8.95031 5.40791L12.9094 1.44712C12.4979 1.13334 11.9835 0.94475 11.4263 0.94475ZM11.4263 0H3.39325C1.52259 0 0 1.52259 0 3.39325V8.50456C0 10.3769 1.52259 11.8978 3.39325 11.8978H11.4263C13.2969 11.8978 14.8195 10.3769 14.8195 8.50456V3.39322C14.8195 1.52256 13.2969 0 11.4263 0Z"
                                fill="black" />
                        </svg>

                        <a href="mailto:support@iklanqu.com" class="ms-1">support@iklanqu.com</a>
                    </li>
                    <li class="ms-4"><svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_529_224)">
                                <path
                                    d="M14.8984 10.5909C14.8735 10.5703 12.0629 8.57063 11.304 8.69297C10.9379 8.75766 10.7288 9.0075 10.3093 9.50719C10.1933 9.6463 10.0747 9.7832 9.95352 9.91781C9.68836 9.83143 9.42973 9.72616 9.17961 9.60281C7.88845 8.97422 6.84524 7.93101 6.21665 6.63984C6.0933 6.38973 5.98803 6.1311 5.90165 5.86594C6.03946 5.73984 6.23258 5.57719 6.31508 5.50781C6.81243 5.09062 7.0618 4.88109 7.12649 4.51453C7.25915 3.75562 5.24915 0.945937 5.22852 0.920625C5.13698 0.790808 5.01777 0.682933 4.87948 0.604789C4.74118 0.526645 4.58726 0.480181 4.42883 0.46875C3.61415 0.46875 1.28821 3.48563 1.28821 3.99422C1.28821 4.02375 1.33086 7.02562 5.03258 10.7911C8.79383 14.4886 11.7957 14.5312 11.8252 14.5312C12.3334 14.5312 15.3507 12.2053 15.3507 11.3906C15.3392 11.2322 15.2926 11.0783 15.2144 10.94C15.1362 10.8017 15.0282 10.6825 14.8984 10.5909ZM11.7732 13.5909C11.3663 13.5562 8.84446 13.2239 5.69446 10.1297C2.58524 6.96422 2.26133 4.43813 2.22899 4.04672C2.84342 3.08233 3.58545 2.20548 4.43493 1.44C4.45368 1.45875 4.47852 1.48688 4.5104 1.52344C5.16188 2.41276 5.72309 3.36481 6.18571 4.36547C6.03527 4.51682 5.87626 4.65939 5.70946 4.7925C5.4508 4.98959 5.21328 5.21297 5.00071 5.45906C4.96474 5.50953 4.93914 5.56663 4.92538 5.62705C4.91162 5.68748 4.90998 5.75003 4.92055 5.81109C5.01975 6.24081 5.17169 6.65662 5.3729 7.04906C6.09378 8.52939 7.28997 9.72541 8.7704 10.4461C9.16276 10.6476 9.57859 10.7997 10.0084 10.8989C10.0694 10.9097 10.132 10.9082 10.1925 10.8944C10.2529 10.8807 10.31 10.8549 10.3604 10.8188C10.6074 10.6053 10.8315 10.3669 11.0293 10.1072C11.1765 9.93188 11.3729 9.69797 11.4474 9.63188C12.4506 10.094 13.4048 10.6559 14.2956 11.3091C14.3345 11.3419 14.3621 11.3672 14.3804 11.3836C13.6149 12.2333 12.7379 12.9755 11.7732 13.59V13.5909ZM11.6007 7.03125H12.5382C12.5371 6.03703 12.1416 5.08385 11.4386 4.38083C10.7356 3.67781 9.78243 3.28237 8.78821 3.28125V4.21875C9.5339 4.21949 10.2488 4.51605 10.7761 5.04333C11.3034 5.57062 11.6 6.28556 11.6007 7.03125Z"
                                    fill="black" />
                                <path
                                    d="M13.9445 7.03125H14.882C14.8801 5.41566 14.2375 3.86677 13.0951 2.72437C11.9527 1.58198 10.4038 0.939361 8.78821 0.9375V1.875C10.1552 1.87661 11.4658 2.42038 12.4324 3.38701C13.3991 4.35365 13.9428 5.66422 13.9445 7.03125Z"
                                    fill="black" />
                            </g>
                            <defs>
                                <clipPath>
                                    <rect width="15" height="15" fill="black"
                                        transform="translate(0.819458)" />
                                </clipPath>
                            </defs>
                        </svg>

                        <a href="https://wa.me/628116584545?text=Halo%20saya%20ingin%20bertanya%20tentang%20sewa%20papan%20iklan"
                            class="ms-1">+62 811-6584-545</a>
                    </li>
                </ul>
                <ul class="link-info">
                    <li><a href="instagram.com"><i class="fa-brands fa-instagram text-dark"></i></a></li>
                    <li><a href="tiktok.com"><i class="fa-brands fa-tiktok text-dark"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Top header area end here -->

    <!-- Header area start here -->
    <header class="header-area">
        <div class="container header__container">
            <div class="header__main">
                <a href="/" class="logo">
                    <img src="{{ asset('landing_assets/images/logo/logo-light.png') }}" alt="logo">
                </a>
                <div class="main-menu">
                    <nav>
                        <ul>
                            <li class="has-megamenu"><a href="#home">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li>
                                <a href="#service">Services</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="service-solutions.html">IT Solutions</a>
                                    </li>
                                    <li>
                                        <a href="service.html">IT Services</a>
                                    </li>
                                    <li>
                                        <a href="service-details.html">Service Details</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#location">Location</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li class="ml-20 d-none d-lg-block"><a class="search-trigger" href="#0"><svg
                                        width="17" height="16" viewBox="0 0 17 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_307_344)">
                                            <path
                                                d="M16.0375 14.9381L12.0784 11.0334C13.0625 9.86621 13.6554 8.36744 13.6554 6.73438C13.6554 3.02103 10.5925 0 6.82774 0C3.0629 0 0 3.02103 0 6.73438C0 10.4475 3.0629 13.4683 6.82774 13.4683C8.4834 13.4683 10.0031 12.8836 11.1865 11.913L15.1456 15.8178C15.2687 15.9393 15.4301 16 15.5915 16C15.7529 16 15.9143 15.9393 16.0375 15.8178C16.2839 15.5748 16.2839 15.181 16.0375 14.9381ZM1.26142 6.73438C1.26142 3.70705 3.75845 1.24414 6.82774 1.24414C9.89695 1.24414 12.3939 3.70705 12.3939 6.73438C12.3939 9.76146 9.89695 12.2241 6.82774 12.2241C3.75845 12.2241 1.26142 9.76146 1.26142 6.73438Z"
                                                fill="#0F0D1D" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_307_344">
                                                <rect width="16.2222" height="16" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a></li>
                        </ul>
                    </nav>
                </div>
                <div class="d-none d-lg-inline-block">
                    <a href="/login" class="btn-one">Mulai Sekarang! <i class="fa-regular fa-arrow-right-long"></i></a>
                </div>
                <div class="bars d-block d-lg-none">
                    <i id="openButton" class="fa-solid fa-bars"></i>
                </div>
            </div>
        </div>
    </header>
    <!-- Header area end here -->

    <!-- Sidebar area start here -->
    <div id="targetElement" class="sidebar-area sidebar__hide">
        <div class="sidebar__overlay"></div>
        <a href="/" class="logo mb-40">
            <img src="{{ asset('landing_assets/images/logo/logo.png') }}" alt="logo">
        </a>
        <div class="sidebar__search mb-30">
            <input type="text" placeholder="Search...">
            <i class="fa-regular fa-magnifying-glass"></i>
        </div>
        <div class="mobile-menu overflow-hidden"></div>
        <ul class="info pt-40">
            <li><i class="fa-solid primary-color fa-location-dot"></i> <a href="#0">support@iklanku.com</a>
            </li>
            <li class="py-2"><i class="fa-solid primary-color fa-phone-volume"></i> <a
                    href="tel:+208-6666-0112">+208-6666-0112</a>
            </li>
            <li><i class="fa-solid primary-color fa-paper-plane"></i> <a
                    href="mailto:info@iklanku.com">info@iklanku.com</a></li>
        </ul>
        <div class="social-icon mt-20">
            <a href="#0"><i class="fa-brands fa-instagram"></i></a>
            <a href="#0"><i class="fa-brands fa-tiktok"></i></a>
        </div>
        <button id="closeButton" class="text-white"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <!-- Sidebar area end here -->

    <!-- Fullscreen search area start here -->
    <div class="search-wrap">
        <div class="search-inner">
            <i class="fas fa-times search-close" id="search-close"></i>
            <div class="search-cell">
                <form method="get">
                    <div class="search-field-holder">
                        <input type="search" class="main-search-input" placeholder="Search...">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Fullscreen search area end here -->

    <main>
        <!-- Banner area start here -->
        <section class="banner-area" id="home">
            <div class="swiper banner__slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="banner__shape-left3 wow slideInLeft">
                            <img class="sway__animation"
                                src="{{ asset('landing_assets/images/banner/banner-shape-left.png') }}"
                                alt="shape">
                        </div>
                        <div class="banner__right-line1" data-animation="slideInRight" data-duration="2s"
                            data-delay=".9s">
                            <img src="{{ asset('landing_assets/images/banner/banner-right-line1.png') }}"
                                alt="shape">
                        </div>
                        <div class="banner__right-line2" data-animation="slideInRight" data-duration="2s"
                            data-delay=".7s">
                            <img src="{{ asset('landing_assets/images/banner/banner-right-line2.png') }}"
                                alt="shape">
                        </div>
                        <div class="banner__right-line3" data-animation="slideInRight" data-duration="2s"
                            data-delay=".5s">
                            <img src="{{ asset('landing_assets/images/banner/banner-right-line3.png') }}"
                                alt="shape">
                        </div>
                        <div class="banner__right-line4" data-animation="slideInRight" data-duration="2s"
                            data-delay=".3s">
                            <img src="{{ asset('landing_assets/images/banner/banner-right-line4.png') }}"
                                alt="shape">
                        </div>
                        <div class="slide-bg"
                            data-background="{{ asset('landing_assets/images/banner/banner-image.png') }}"></div>
                        <div class="container">
                            <div class="banner__content">
                                <h4 data-animation="slideInRight" data-duration="2s" data-delay=".3s"
                                    class="text-white mb-20">
                                    <svg class="me-1" width="40" height="16" viewBox="0 0 40 16"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="0.5" y="0.500183" width="25.6667" height="15" rx="7.5"
                                            stroke="white" />
                                        <rect x="13.3334" y="0.000183105" width="26.6667" height="16"
                                            rx="8" fill="white" />
                                    </svg>
                                    Solusi pemasaran bisnis anda!
                                </h4>
                                <h1 data-animation="slideInRight" data-duration="2s" data-delay=".5s"
                                    class="text-white">
                                    Murah, Cepat dan Tepat
                                </h1>
                                <p data-animation="slideInRight" data-duration="2s" data-delay=".7s" class="mt-20">
                                    Pasarkan Produk dan Jasa Anda Bersama Kami.
                                    Dengan iklanqu.id Biaya Murah, Iklan Cepat dan Hasil Tepat
                                    <br>
                                    iklanqu.id The Best Partner of Your Bussines
                                </p>
                                <a data-animation="slideInRight" data-duration="2s" data-delay=".9s" href="/login"
                                    class="btn-one mt-60">Mulai Beriklan! <i
                                        class="fa-regular fa-arrow-right-long"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner__dot-wrp">
                <div class="dot-light banner__dot"></div>
            </div>
        </section>
        <!-- Banner area end here -->

        <!-- About area start here -->
        <section class="about-area sub-bg pt-120" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 wow fadeInRight" data-wow-delay="200ms" data-wow-duration="1500ms">
                        <div class="about__left-item">
                            <div class="image big-image">
                                <img src="{{ asset('landing_assets/images/about/about-image1.jpg') }}"
                                    alt="image">
                            </div>
                            <div class="image sm-image">
                                <div class="video__btn-wrp">
                                    <div class="video-btn video-pulse">
                                        <a class="video-popup" href="https://www.youtube.com/watch?v=iVqz_4M5mA0"><i
                                                class="fa-solid fa-play"></i></a>
                                    </div>
                                </div>
                                <img src="https://www.dekartpro.com/image/cache/catalog/catalog/d/ditotem/ditotem-50001-bk/ditotem-50001-bk-01-550x550.webp"
                                    alt="image">
                            </div>
                            <div class="circle-shape">
                                <img src="{{ asset('landing_assets/images/shape/about-circle.png') }}"
                                    alt="shape">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="section-header mb-40">
                            <h5 class="wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                                <img class="me-1" src="{{ asset('landing_assets/images/logo/logo.png') }}"
                                    width="150px" alt="icon">
                            </h5>
                            <h3 class="wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">Partner
                                Advertising Screen Anda</h3>
                            <p class="wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                                <b>Iklanqu.id</b>
                                adalah platform periklanan digital yang menyediakan layanan Outdoor Advertising Screen
                                untuk membantu bisnis menampilkan iklan mereka di layar digital strategis dengan cara
                                yang lebih mudah, cepat, dan efisien.
                            </p>
                            <p class="wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">Melalui
                                teknologi
                                berbasis cloud, pengiklan dapat mengunggah, mengatur, dan mengelola konten iklan
                                langsung dari smartphone atau perangkat mereka, tanpa proses yang rumit. Sistem kami
                                dirancang agar siapa pun dapat menjalankan kampanye iklan outdoor hanya dalam beberapa
                                langkah sederhana.</p>
                        </div>
                        <div class="about__info mt-50 wow fadeInDown" data-wow-delay="400ms"
                            data-wow-duration="1500ms">
                            <a href="/login" class="btn-one">Lebih Lanjut <i
                                    class="fa-regular fa-arrow-right-long"></i></a>
                            <div class="d-flex gap-2 align-items-center">
                                <img src="{{ asset('landing_assets/images/about/about-info.jpg') }}"
                                    style="border-radius: 50%" width="50px" alt="image">
                                <div class="info">
                                    <h5>Dwi Sandhi Romadhon</h5>
                                    <span class="sm-font">Co, Founder</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About area end here -->

        <!-- Service area start here -->
        <section class="service-area pt-120 pb-120" id="service">
            <div class="service__shape wow slideInRight">
                <img class="sway_Y__animation" src="{{ asset('landing_assets/images/shape/service-bg-shape.png') }}"
                    alt="shape">
            </div>
            <div class="container">
                <div class="d-flex flex-wrap gap-4 align-items-center justify-content-between mb-60">
                    <div class="section-header">
                        <h5 class="wow fadeInLeft" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <img class="me-1" src="{{ asset('landing_assets/images/icon/section-title.png') }}"
                                alt="icon">
                            Layanan Kami
                        </h5>
                        <h2 class="wow fadeInLeft" data-wow-delay="200ms" data-wow-duration="1500ms">Excellent It
                            Services</h2>
                    </div>
                    <a href="/login" class="btn-one wow fadeInUp" data-wow-delay="200ms"
                        data-wow-duration="1500ms">Semua Layanan<i class="fa-regular fa-arrow-right-long"></i></a>
                </div>
                <div class="row g-4">
                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="00ms"
                        data-wow-duration="1500ms">
                        <div class="blog__item">
                            <a href="/login" class="blog__image d-block image">
                                <img src="https://www.hd-focus.com/Content/uploads/2019571566/201912231612029743107.jpg"
                                    alt="image">
                            </a>
                            <div class="blog__content">
                                <ul class="blog-info pb-20 bor-bottom mb-20">
                                    <li>
                                        <a href="#0">
                                            <i class="fa fa-tv"></i> <br> 55 Inch LED Display
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#0">
                                            <i class="fa fa-desktop"></i> <br> Full HD (1920 × 1080)
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#0">
                                            <i class="fa fa-clock"></i> <br> Operasional: 24 Jam
                                        </a>
                                    </li>
                                </ul>
                                <h3><a href="/login" class="primary-hover">Beriklan diPapan Iklan 55 Inci</a>
                                </h3>
                                <div class="price">Rp 20.000 / Hari / Lokasi</div>
                                <a class="mt-25 read-more-btn" href="/login">Pesan Sekarang <i
                                        class="fa-regular fa-arrow-right-long"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms"
                        data-wow-duration="1500ms">
                        <div class="blog__item">
                            <a href="/login" class="blog__image image d-block">
                                <img src="https://www.jnsnext.com/wp-content/uploads/2019/03/image1.png"
                                    alt="image">
                            </a>
                            <div class="blog__content">
                                <ul class="blog-info pb-20 bor-bottom mb-20">
                                    <li>
                                        <a href="#0">
                                            <i class="fa fa-paint-brush"></i> <br> Desain Profesional
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#0">
                                            <i class="fa fa-video-camera"></i> <br> Gambar & Video Menarik
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#0">
                                            <i class="fa fa-rocket"></i> <br> Tayang di Layar Digital
                                        </a>
                                    </li>
                                </ul>
                                <h3><a href="/login" class="primary-hover">Pembuatan Konten Iklan Digital</a>
                                </h3>
                                <div class="price">Mulai dari Rp 500.000</div>
                                <a class="mt-25 read-more-btn" href="/login">Pesan Sekarang <i
                                        class="fa-regular fa-arrow-right-long"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms"
                        data-wow-duration="1500ms">
                        <div class="blog__item">
                            <a href="/login" class="blog__image image d-block">
                                <img src="https://www.hd-focus.com/Content/uploads/2019571566/201912231612029743107.jpg"
                                    alt="image">
                            </a>
                            <div class="blog__content">
                                <ul class="blog-info pb-20 bor-bottom mb-20">
                                    <li>
                                        <a href="#0">
                                            <i class="fa fa-film"></i><br> Format JPG, PNG, MP4
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#0">
                                            <i class="fa fa-clock"></i><br> 5 – 10 detik per slot
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#0">
                                            <i class="fa fa-cloud"></i><br> Cloud Management
                                        </a>
                                    </li>

                                </ul>
                                <h3><a href="/login" class="primary-hover">Sewa Papan Iklan 55 Inci</a>
                                </h3>
                                <div class="price">Rp 750.000 / Hari</div>
                                <a class="mt-25 read-more-btn" href="/login">Pesan Sekarang <i
                                        class="fa-regular fa-arrow-right-long"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Service area end here -->

        <!-- Counter area start here -->
        <section class="counter-area">
            <div class="container">
                <div class="counter__wrp gradient-bg">

                    <div class="counter__item">
                        <div class="counter-icon">
                            <i class="fa fa-desktop"></i>
                        </div>
                        <div class="content">
                            <h3><span class="counter" data-target="120">0</span>+</h3>
                            <p class="text-white">Layar Iklan Aktif</p>
                        </div>
                    </div>

                    <div class="counter__item">
                        <div class="counter-icon">
                            <i class="fa fa-bullhorn"></i>
                        </div>
                        <div class="content">
                            <h3><span class="counter" data-target="350">0</span>+</h3>
                            <p class="text-white">Brand Beriklan</p>
                        </div>
                    </div>

                    <div class="counter__item">
                        <div class="counter-icon">
                            <i class="fa fa-line-chart"></i>
                        </div>
                        <div class="content">
                            <h3><span class="counter" data-target="1200">0</span>+</h3>
                            <p class="text-white">Kampanye Iklan</p>
                        </div>
                    </div>

                    <div class="counter__item">
                        <div class="counter-icon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <div class="content">
                            <h3><span class="counter" data-target="24">0</span></h3>
                            <p class="text-white">Jam Operasional</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- Counter area end here -->

        <!-- Cause area start here -->
        <section class="case-area pt-120 pb-120" id="location">
            <div class="container">
                <div class="d-flex flex-wrap gap-4 align-items-center justify-content-between mb-60">
                    <div class="section-header">
                        <h2 class="wow fadeInLeft" data-wow-delay="200ms" data-wow-duration="1500ms">Lokasi Board
                            Iklan
                            Kami</h2>
                    </div>
                    <!-- <a href="case.html" class="btn-one wow fadeInUp" data-wow-delay="200ms"
                        data-wow-duration="1500ms">Lihat Semua Lokasi<i class="fa-regular fa-arrow-right-long"></i></a> -->
                </div>
            </div>
            <div class="swiper case__slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="case__item">
                            <div class="image case__image">
                                <img src="https://d2kihw5e8drjh5.cloudfront.net/eyJidWNrZXQiOiJ1dGEtaW1hZ2VzIiwia2V5IjoicGxhY2VfaW1nL1h3Z25xOWZ0UnZ1NFFUOXp4VHAwdEEiLCJlZGl0cyI6eyJyZXNpemUiOnsid2lkdGgiOjY0MCwiaGVpZ2h0Ijo2NDAsImZpdCI6Imluc2lkZSJ9LCJyb3RhdGUiOm51bGwsInRvRm9ybWF0IjogIndlYnAifX0="
                                    alt="image">
                            </div>
                            <div class="case__content">
                                <h3>
                                    <a href="case-details.html" class="text-white primary-hover">
                                        King Kuphi Ule Kareng Ring Road
                                    </a>
                                </h3>

                                <span class="primary-color sm-font">
                                    Jl. Gagak Hitam No.9, Sei Sikambing B <br> Kec. Medan Sunggal Kota Medan
                                </span>

                                <div class="case-btn">
                                    <a href="https://maps.app.goo.gl/DwDKKdWh86SC72ZD7" class="btn-iklanqu">Lihat
                                        Lokasi</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="case__item">
                            <div class="image case__image">
                                <img src="https://akcdn.detik.net.id/visual/2026/02/15/kilat-kuphi-ekspansi-ke-transmart-medan-fair-1771154612676_169.jpeg?w=400&q=90"
                                    alt="image">
                            </div>
                            <div class="case__content">
                                <h3>
                                    <a href="case-details.html" class="text-white primary-hover">
                                        Kilat Kuphi
                                    </a>
                                </h3>

                                <span class="primary-color sm-font">
                                    Jl. Garuda No.79, Sei Sikambing B <br> Kec. Medan Sunggal, Kota Medan
                                </span>

                                <div class="case-btn">
                                    <a href="https://maps.app.goo.gl/jhK2ECd2So3DFaDu8" class="btn-iklanqu">Lihat
                                        Lokasi</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="case__item">
                            <div class="image case__image">
                                <img src="https://kfmap.asia/storage/thumbs/storage/photos/ID.MDN.RT.MCP/ID.MDN.RT.MCP_3.jpg"
                                    alt="image">
                            </div>
                            <div class="case__content">
                                <h3>
                                    <a href="case-details.html" class="text-white primary-hover">
                                        Center Point Medan
                                    </a>
                                </h3>

                                <span class="primary-color sm-font">
                                    Jl. Jawa No.8, Gg. Buntu<br> Kec. Medan Timur, Kota Medan
                                </span>

                                <div class="case-btn">
                                    <a href="https://maps.app.goo.gl/s7tCMRMiajx7WZMQ6" class="btn-iklanqu">Lihat
                                        Lokasi</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="case__item">
                            <div class="image case__image">
                                <img src="https://analisadaily.com/imagesfile/202410/20241023-181841_lakukan-pengembangan-sun-plaza-siap-hadapi-persaingan-dan-tingkatkan-pengalaman-masyarakat.jpeg"
                                    alt="image">
                            </div>
                            <div class="case__content">
                                <h3>
                                    <a href="case-details.html" class="text-white primary-hover">
                                        Sun Plaza Mall
                                    </a>
                                </h3>

                                <span class="primary-color sm-font">
                                    Jl. KH. Zainul Arifin No.7, Madras Hulu<br> Kec. Medan Polonia, Kota Medan
                                </span>

                                <div class="case-btn">
                                    <a href="https://maps.app.goo.gl/qvFmeVJkqyqi9Rkb6" class="btn-iklanqu">Lihat
                                        Lokasi</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-60 text-center wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                <div class="dot case__dot"></div>
            </div>
        </section>
        <!-- Cause area end here -->

        <!-- Offer area start here -->
        <section class="offer-area secondary-bg pt-120 pb-200">
            <div class="offer__shadow wow fadeIn" data-wow-delay="200ms" data-wow-duration="1500ms">
                <img src="{{ asset('landing_assets/images/shape/offer-shadow-shape.png') }}" alt="shadow">
            </div>
            <div class="offer__shape-left">
                <img class="wow fadeInUpBig" data-wow-delay="400ms" data-wow-duration="1500ms"
                    src="{{ asset('landing_assets/images/shape/offer-bg-shape-left.png') }}" alt="shape">
            </div>
            <div class="offer__shape-right">
                <img class="wow fadeInDownBig" data-wow-delay="400ms" data-wow-duration="1500ms"
                    src="{{ asset('landing_assets/images/shape/offer-bg-shape-right.png') }}" alt="shape">
            </div>
            <div class="container">
                <div class="d-flex gap-4 flex-wrap align-items-center justify-content-between mb-95">
                    <div class="section-header">
                        <h5 class="wow fadeInLeft" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <img class="me-1" src="{{ asset('landing_assets/images/icon/section-title.png') }}"
                                alt="icon">
                            Kenapa Memilih Kami
                        </h5>
                        <h2 class="text-white wow fadeInLeft" data-wow-delay="200ms" data-wow-duration="1500ms">
                            Solusi Digital Modern <br> Untuk Mengembangkan Bisnis Anda
                        </h2>
                    </div>
                    <a href="pricing.html" class="btn-one wow fadeInUp" data-wow-delay="200ms"
                        data-wow-duration="1500ms">Pesan Sekarang<i class="fa-regular fa-arrow-right-long"></i></a>
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-2 col-md-4 col-sm-6 wow bounceInUp" data-wow-delay="00ms"
                        data-wow-duration="1500ms">
                        <div class="offer__item">
                            <div class="shape-top">
                                <img src="{{ asset('landing_assets/images/shape/offter-item-shape-top.png') }}"
                                    alt="shape">
                            </div>
                            <div class="shape-bottom">
                                <img src="{{ asset('landing_assets/images/shape/offter-item-shape-bottom.png') }}"
                                    alt="shape">
                            </div>
                            <div class="offer__icon">
                                <i class="fa-solid fa-database"></i>
                            </div>
                            <h4 class="text-white mt-20">Safe Storage</h4>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-6 wow bounceInUp" data-wow-delay="100ms"
                        data-wow-duration="1500ms">
                        <div class="offer__item">
                            <div class="shape-top">
                                <img src="{{ asset('landing_assets/images/shape/offter-item-shape-top.png') }}"
                                    alt="shape">
                            </div>
                            <div class="shape-bottom">
                                <img src="{{ asset('landing_assets/images/shape/offter-item-shape-bottom.png') }}"
                                    alt="shape">
                            </div>
                            <div class="offer__icon">
                                <i class="fa-solid fa-shield"></i>
                            </div>
                            <h4 class="text-white mt-20">Secure</h4>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-6 wow bounceInUp" data-wow-delay="200ms"
                        data-wow-duration="1500ms">
                        <div class="offer__item">
                            <div class="shape-top">
                                <img src="{{ asset('landing_assets/images/shape/offter-item-shape-top.png') }}"
                                    alt="shape">
                            </div>
                            <div class="shape-bottom">
                                <img src="{{ asset('landing_assets/images/shape/offter-item-shape-bottom.png') }}"
                                    alt="shape">
                            </div>
                            <div class="offer__icon">
                                <i class="fa-solid fa-bullhorn"></i>
                            </div>
                            <h4 class="text-white mt-20">Live Iklan</h4>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-6 wow bounceInUp" data-wow-delay="300ms"
                        data-wow-duration="1500ms">
                        <div class="offer__item">
                            <div class="shape-top">
                                <img src="{{ asset('landing_assets/images/shape/offter-item-shape-top.png') }}"
                                    alt="shape">
                            </div>
                            <div class="shape-bottom">
                                <img src="{{ asset('landing_assets/images/shape/offter-item-shape-bottom.png') }}"
                                    alt="shape">
                            </div>
                            <div class="offer__icon">
                                <i class="fa-solid fa-eye"></i>
                            </div>
                            <h4 class="text-white mt-20">10.000 Views</h4>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-6 wow bounceInUp" data-wow-delay="400ms"
                        data-wow-duration="1500ms">
                        <div class="offer__item">
                            <div class="shape-top">
                                <img src="{{ asset('landing_assets/images/shape/offter-item-shape-top.png') }}"
                                    alt="shape">
                            </div>
                            <div class="shape-bottom">
                                <img src="{{ asset('landing_assets/images/shape/offter-item-shape-bottom.png') }}"
                                    alt="shape">
                            </div>
                            <div class="offer__icon">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <h4 class="text-white mt-20">Family Plans</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Offer area end here -->

        <!-- Brand area start here -->
        <div class="brand-area">
            <div class="container">
                <div class="brand__wrp">
                    <div class="brand__shape">
                        <img src="{{ asset('landing_assets/images/shape/brand-shape.png') }}" alt="">
                    </div>
                    <div class="swiper brand__slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="brand__image image">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSXYTir5UTk_xLXtBr9sKDeuaeA-GGspetvmw&s"
                                        alt="image">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand__image image">
                                    <img src="https://cdn.lynkid.my.id/profile/16-05-2024/1715832992597_2967425"
                                        alt="image">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand__image image">
                                    <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiq_wiPMNf0zuOuXWgqQEjqooRVYgaeBLlLLPp1cqPsF72jU_i0uUCZO__Al_uaQpoAxrJyP7QMnqIqW7VCVZX55RCaqDT2DeHAAQJksMqT83AomyA3KKsQcEEyi_gwbFHrZdk-kjeHa8jz/s320/images.png"
                                        alt="image">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand__image image">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/24/Sun_Plaza.svg"
                                        alt="image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Brand area end here -->

        <!-- Testimonial area start here -->
        <section class="testimonial-area bg-image pt-120 pb-120" id="testimonial"
            data-background="{{ asset('landing_assets/images/bg/testimonial-bg.png') }}">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-6 wow fadeInLeft" data-wow-delay="200ms" data-wow-duration="1500ms">
                        <div class="talk-us__item">
                            <div class="section-header mb-30">
                                <h5 class="text-white">
                                    <svg width="28" height="12" viewBox="0 0 28 12" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="0.75" y="0.75" width="18.5" height="10.5" rx="5.25"
                                            stroke="white" stroke-width="1.5" />
                                        <rect x="8" width="20" height="12" rx="6" fill="white" />
                                    </svg>
                                    Hubungi Kami
                                </h5>
                                <h2 class="text-white">Jelaskan Kebutuhan Anda Disini</h2>
                            </div>
                            <form id="contact-form">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label for="name">Nama*</label>
                                        <input type="text" id="name" class="form-control"
                                            placeholder="Masukkan Nama">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="number">Nomor Whatsapp*</label>
                                        <input type="text" id="number" class="form-control"
                                            placeholder="+62812xxxx">
                                    </div>

                                    <div class="col-12">
                                        <label for="message">Pesan*</label>
                                        <textarea id="message" class="form-control" placeholder="Pesan"></textarea>
                                    </div>
                                </div>

                                <button type="button" id="send-message">Kirim Pesan</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 ps-2 ps-lg-5">
                        <div class="section-header mb-40">
                            <h5 class="wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                                <img class="me-1" src="{{ asset('landing_assets/images/icon/section-title.png') }}"
                                    alt="icon">
                                TESTIMONI KLIEN
                            </h5>
                            <h2 class="wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">Apa Kata
                                Pengiklan Kami</h2>
                            <p class="wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">Kami membantu
                                bisnis Anda menjangkau lebih banyak pelanggan melalui
                                papan iklan digital dengan tampilan yang menarik dan lokasi strategis.
                                Banyak klien kami merasakan peningkatan visibilitas brand setelah
                                menggunakan layanan iklan kami.</p>
                        </div>
                        <div class="swiper testimonial__slider wow fadeInDown" data-wow-delay="00ms"
                            data-wow-duration="1500ms">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="testimonial__item">
                                        <svg class="coma" width="50" height="37" viewBox="0 0 50 37"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 0V37L18.75 18.5V0H0ZM31.25 0V37L50 18.5V0H31.25Z"
                                                fill="#3C72FC" />
                                        </svg>
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ asset('landing_assets/images/testimonial/testimonial-image1.png') }}"
                                                alt="image">
                                            <div class="testi-info">
                                                <h4>Andi Saputra</h4>
                                                <p>Pemilik Cafe</p>
                                                <div class="star mt-1">
                                                    <i class="fa-sharp fa-solid fa-star"></i>
                                                    <i class="fa-sharp fa-solid fa-star"></i>
                                                    <i class="fa-sharp fa-solid fa-star"></i>
                                                    <i class="fa-sharp fa-solid fa-star"></i>
                                                    <i class="fa-sharp fa-solid fa-star disable"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mt-30">
                                            “Sejak memasang iklan di papan digital ini, jumlah pengunjung cafe kami
                                            meningkat cukup signifikan.
                                            Lokasinya strategis dan tampilannya sangat menarik sehingga mudah dilihat
                                            banyak orang.”
                                        </p>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testimonial__item">
                                        <svg class="coma" width="50" height="37" viewBox="0 0 50 37"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 0V37L18.75 18.5V0H0ZM31.25 0V37L50 18.5V0H31.25Z"
                                                fill="#3C72FC" />
                                        </svg>
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ asset('landing_assets/images/testimonial/testimonial-image2.png') }}"
                                                alt="image">
                                            <div class="testi-info">
                                                <h4>Siti Rahma</h4>
                                                <p>Pemilik Toko Fashion</p>
                                                <div class="star mt-1">
                                                    <i class="fa-sharp fa-solid fa-star"></i>
                                                    <i class="fa-sharp fa-solid fa-star"></i>
                                                    <i class="fa-sharp fa-solid fa-star"></i>
                                                    <i class="fa-sharp fa-solid fa-star"></i>
                                                    <i class="fa-sharp fa-solid fa-star disable"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mt-30">
                                            “Proses pemasangan iklan sangat mudah dan cepat. Timnya juga membantu dalam
                                            pembuatan desain
                                            sehingga iklan kami terlihat profesional dan menarik perhatian pelanggan.”
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial__arry-btn mt-40 wow fadeInDown" data-wow-delay="200ms"
                            data-wow-duration="1500ms">
                            <button class="arry-prev testimonial__arry-prev"><i
                                    class="fa-light fa-chevron-left"></i></button>
                            <button class="arry-next testimonial__arry-next active"><i
                                    class="fa-light fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Testimonial area end here -->
    </main>

    <!-- Footer area start here -->
    <footer class="footer-area secondary-bg" id="contact">
        <div class="footer__shape-regular-left wow slideInLeft" data-wow-delay="00ms" data-wow-duration="1500ms">
            <img src="{{ asset('landing_assets/images/shape/footer-regular-left.png') }}" alt="shape">
        </div>
        <div class="footer__shape-solid-left wow slideInLeft" data-wow-delay="200ms" data-wow-duration="1500ms">
            <img class="sway_Y__animation" src="{{ asset('landing_assets/images/shape/footer-solid-left.png') }}"
                alt="shape">
        </div>
        <div class="footer__shape-solid-right wow slideInRight" data-wow-delay="00ms" data-wow-duration="1500ms">
            <img class="sway_Y__animation" src="{{ asset('landing_assets/images/shape/footer-regular-right.png') }}"
                alt="shape">
        </div>
        <div class="footer__shape-regular-right wow slideInRight" data-wow-delay="200ms" data-wow-duration="1500ms">
            <img src="{{ asset('landing_assets/images/shape/footer-solid-right.png') }}" alt="shape">
        </div>
        <div class="footer__shadow-shape">
            <img src="{{ asset('landing_assets/images/shape/footer-shadow-shape.png') }}" alt="shodow">
        </div>
        <div class="container">
            <div class="footer__wrp pt-100 pb-100">
                <div class="footer__item item-big wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <a href="/" class="logo mb-30">
                        <img src="{{ asset('landing_assets/images/logo/logo.png') }}" alt="image">
                    </a>
                    <p>iklanqu.id The Best Partner of Your Bussines</p>
                    <div class="social-icon">
                        <a href="instagram.com"><i class="fa-brands fa-instagram"></i></a>
                        <a href="mailto:support@iklanqu.com"><i class="fa fa-envelope"></i></a>
                        <a href="tiktok.com"><i class="fa-brands fa-tiktok"></i></a>
                    </div>
                </div>
                <div class="footer__item item-sm wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                    <h3 class="footer-title">Advertisment Solution</h3>
                    <ul>
                        <li><a href="service-details.html"><i class="fa-regular fa-angles-right me-1"></i> Beriklan di
                                Board Digital Kami</a></li>
                        <li><a href="service-details.html"><i class="fa-regular fa-angles-right me-1"></i> Buat Konten
                                Iklan</a>
                        </li>
                        <li><a href="service-details.html"><i class="fa-regular fa-angles-right me-1"></i> Sewa Board
                                Digital Kami</a></li>
                    </ul>
                </div>
                <div class="footer__item item-sm wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                    <h3 class="footer-title">Pintasan</h3>
                    <ul>
                        <li><a href="#about"><i class="fa-regular fa-angles-right me-1"></i> Home</a></li>
                        <li><a href="#about"><i class="fa-regular fa-angles-right me-1"></i> About</a></li>
                        <li><a href="#service"><i class="fa-regular fa-angles-right me-1"></i> Service</a></li>
                        <li><a href="#location"><i class="fa-regular fa-angles-right me-1"></i> Location</a></li>
                        <li><a href="#testimonial"><i class="fa-regular fa-angles-right me-1"></i> Testimonial</a>
                        </li>
                    </ul>
                </div>
                <div class="footer__item item-big wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                    <h3 class="footer-title">Hubungi Kami</h3>
                    <p class="mb-20">Jl. Cycas Raya Jl. Taman Setia Budi Indah Blok VV No.172 Kompleks, Asam Kumbang,
                        Kec. Medan Selayang, Kota Medan, Sumatera Utara</p>
                    <ul class="footer-contact">
                        <li>
                            <i class="fa-regular fa-clock"></i>
                            <div class="info">
                                <h5>
                                    Jam Operasional:
                                </h5>
                                <p>Senin - Jum'at: 10.00 AM - 4.00 PM</p>
                            </div>
                        </li>
                        <li>
                            <i class="fa-duotone fa-phone"></i>
                            <div class="info">
                                <h5>
                                    Nomor Telephone:
                                </h5>

                                <p><a
                                        href="https://wa.me/628116584545?text=Halo%20saya%20ingin%20bertanya%20tentang%20sewa%20papan%20iklan">+62-811-6584-545</a>
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer__copyright">
            <div class="container">
                <div
                    class="d-flex gap-1 flex-wrap align-items-center justify-content-md-between justify-content-center">
                    <p class="wow fadeInDown" data-wow-delay="00ms" data-wow-duration="1500ms">&copy; All Copyright
                        2024
                        by <a href="#0">IklanQu.id</a></p>
                    <ul class="d-flex align-items-center gap-4 wow fadeInDown" data-wow-delay="200ms"
                        data-wow-duration="1500ms">
                        <li><a href="#0">Terms & Condition</a></li>
                        <li><a href="#0">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer area end here -->

    <!-- Back to top area start here -->
    <div class="scroll-up">
        <svg class="scroll-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- Back to top area end here -->

    <script src="{{ asset('landing_assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('landing_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('landing_assets/js/meanmenu.js') }}"></script>
    <script src="{{ asset('landing_assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('landing_assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('landing_assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('landing_assets/js/pace.min.js') }}"></script>
    <script src="{{ asset('landing_assets/js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('landing_assets/js/nice-select.min.js') }}"></script>
    <script src="{{ asset('landing_assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('landing_assets/js/jquery.waypoints.js') }}"></script>
    <script src="{{ asset('landing_assets/js/script.js') }}"></script>
    <script>
        const counters = document.querySelectorAll('.counter');

        counters.forEach(counter => {

            const updateCounter = () => {

                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;

                const speed = target / 100;

                if (count < target) {
                    counter.innerText = Math.ceil(count + speed);
                    setTimeout(updateCounter, 20);
                } else {
                    counter.innerText = target;
                }

            };

            updateCounter();

        });

        $("#send-message").on("click", function() {

            let button = $(this);

            let data = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                nama: $("#name").val(),
                no_wa: $("#number").val(),
                pesan: $("#message").val()
            };

            $('body').css('cursor', 'wait');
            button.prop('disabled', true);

            $.ajax({
                url: "/get-in-touch/store",
                method: "POST",
                data: data,

                success: function(response) {

                    $('body').css('cursor', 'default');
                    button.prop('disabled', false);

                    if (response.status) {

                        alert("Pesan berhasil dikirim");

                        $("#name").val('');
                        $("#number").val('');
                        $("#message").val('');

                    } else {
                        alert(response.message);
                    }

                },

                error: function() {

                    $('body').css('cursor', 'default');
                    button.prop('disabled', false);

                    alert("Terjadi kesalahan");
                }

            });

        });
    </script>
</body>

</html>
