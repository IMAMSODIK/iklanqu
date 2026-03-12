<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard_layouts.head')
</head>

<body>
    <div class="app-container">
        @include('dashboard_layouts.header')

        <div class="content-area" id="content-area">
            <!-- Halaman Daftar Lokasi -->
            <div class="page" id="page-lokasi">
                <div class="page-header">
                    <div class="page-title">Daftar Lokasi</div>
                    <div class="page-subtitle">Kelola lokasi pemasangan iklan</div>
                </div>
                <div class="card">
                    <div class="card-item">
                        <div class="item-icon">🏢</div>
                        <div class="item-info">
                            <h4>Mall Central Park</h4>
                            <p>Jakarta Barat • 5 iklan aktif</p>
                        </div>
                    </div>
                    <div class="card-item">
                        <div class="item-icon">🏬</div>
                        <div class="item-info">
                            <h4>Stasiun MRT Bundaran HI</h4>
                            <p>Jakarta Pusat • 3 iklan aktif</p>
                        </div>
                    </div>
                    <div class="card-item">
                        <div class="item-icon">🏪</div>
                        <div class="item-info">
                            <h4>Terminal Pulo Gebang</h4>
                            <p>Jakarta Timur • 2 iklan aktif</p>
                        </div>
                    </div>
                    <div class="card-item">
                        <div class="item-icon">🛍️</div>
                        <div class="item-info">
                            <h4>Bandara Soekarno-Hatta</h4>
                            <p>Tangerang • 4 iklan aktif</p>
                        </div>
                    </div>
                </div>
                <div style="color: #2563eb; font-weight: 500; padding: 8px 0;">+ Tambah lokasi baru</div>
            </div>
        </div>

        @include('dashboard_layouts.nav')
    </div>

    @include('dashboard_layouts.script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navItems = document.querySelectorAll('.nav-item');
            const pages = document.querySelectorAll('.page');

            // Set default ke halaman buat iklan
            pages.forEach(page => page.classList.remove('active-page'));
            document.getElementById('content-area').classList.add('active-page');

            navItems.forEach(item => item.classList.remove('active'));
            document.querySelector('.nav-item.middle-item').classList.add('active');

            // Fungsi switch halaman
            function switchPage(pageId) {
                pages.forEach(page => page.classList.remove('active-page'));
                const targetPage = document.getElementById('page-' + pageId);
                if (targetPage) targetPage.classList.add('active-page');

                navItems.forEach(item => item.classList.remove('active'));
                const activeNavItem = document.querySelector(`.nav-item[data-page="${pageId}"]`);
                if (activeNavItem) activeNavItem.classList.add('active');
            }

            navItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const pageId = this.getAttribute('data-page');
                    if (pageId) switchPage(pageId);
                });
            });

            // Fix untuk iOS viewport height
            function setAppHeight() {
                const vh = window.innerHeight * 0.01;
                document.documentElement.style.setProperty('--vh', `${vh}px`);

                const appContainer = document.querySelector('.app-container');
                if (appContainer) {
                    if (window.innerWidth < 1024) {
                        appContainer.style.height = `${window.innerHeight}px`;
                    }
                }
            }

            window.addEventListener('resize', setAppHeight);
            window.addEventListener('orientationchange', setAppHeight);
            setAppHeight();
        });
    </script>
</body>

</html>
