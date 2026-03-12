<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div class="logo-wrapper">
        <a href="index.html">
            <img class="img-fluid" style="width: 150px; margin-top: 10px" src="{{ asset('own_assets/logo/logo.png') }}"
                alt="">
        </a>
        <div class="back-btn"><i class="fa fa-angle-left"> </i></div>
        <div class="toggle-sidebar">
            <i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i>
        </div>
    </div>

    <div class="logo-icon-wrapper">
        <a href="index.html">
            <img class="img-fluid" src="{{ asset('own_assets/logo/logo.png') }}" alt="">
        </a>
    </div>
    <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
            <ul class="sidebar-links" id="simple-bar">
                <li class="back-btn"><a href="index.html"><img class="img-fluid"
                            src="{{ asset('own_assets/logo/logo.png') }}" alt=""></a>
                    <div class="mobile-back text-end"> <span>Back </span><i class="fa fa-angle-right ps-2"
                            aria-hidden="true"></i></div>
                </li>
                <li class="pin-title sidebar-main-title">
                    <div>
                        <h6>Pinned</h6>
                    </div>
                </li>
                <li class="sidebar-main-title">
                    <div>
                        <h6 class="lan-1">General</h6>
                    </div>
                </li>

                <li class="sidebar-list"><i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title"
                        href="/dashboard">
                        <svg class="stroke-icon">
                            <use href="{{ asset('dashboard_assets/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                        </svg>
                        <svg class="fill-icon">
                            <use href="{{ asset('dashboard_assets/assets/svg/icon-sprite.svg#fill-home') }}"></use>
                        </svg><span class="lan-3">Dashboard </span></a>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6 class="">Master</h6>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/lokasi">
                        <i class="fa fa-map-marker text-white"></i>
                        <span>Daftar Lokasi</span>
                        <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/board">
                        <i class="fa fa-desktop text-white"></i>
                        <span>Daftar Board</span>
                        <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                    </a>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6 class="">Data</h6>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/client">
                        <i class="fa fa-users text-white"></i>
                        <span>Daftar Client</span>
                        <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/user">
                        <i class="fa fa-user-secret text-white"></i>
                        <span>Daftar User</span>
                        <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                    </a>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6 class="">Landing Page</h6>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/profile">
                        <i class="fa fa-cog text-white"></i>
                        <span>Profile Web</span>
                        <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/get-in-touch">
                        <i class="fa fa-comments text-white"></i>
                        <span>Get in Touch</span>
                        <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                    </a>
                </li>

            </ul>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</div>
