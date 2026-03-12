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
            <div class="page" id="page-riwayat">
                <div class="page-header">
                    <div class="page-title">Riwayat Iklan</div>
                    <div class="page-subtitle">Iklan yang sudah tayang</div>
                </div>
                <div class="card">
                    <div class="card-item">
                        <div class="item-icon">📺</div>
                        <div class="item-info">
                            <h4>Promo Produk Susu</h4>
                            <p>12-18 Mar 2025 • 12.500 tayangan</p>
                        </div>
                        <span class="badge">Selesai</span>
                    </div>
                    <div class="card-item">
                        <div class="item-icon">📱</div>
                        <div class="item-info">
                            <h4>Aplikasi Fintech</h4>
                            <p>1-7 Mar 2025 • 8.230 tayangan</p>
                        </div>
                        <span class="badge">Selesai</span>
                    </div>
                    <div class="card-item">
                        <div class="item-icon">🎮</div>
                        <div class="item-info">
                            <h4>Game Online</h4>
                            <p>20-28 Feb 2025 • 15.100 tayangan</p>
                        </div>
                        <span class="badge">Selesai</span>
                    </div>
                </div>
            </div>
        </div>

        @include('dashboard_layouts.nav')
    </div>

    @include('dashboard_layouts.script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pages = document.querySelectorAll('.page');

            // Set default ke halaman buat iklan
            pages.forEach(page => page.classList.remove('active-page'));
            document.getElementById('page-riwayat').classList.add('active-page');

            document.querySelector('.nav-item.middle-item').classList.add('active');

            // Fungsi switch halaman
            function switchPage(pageId) {
                pages.forEach(page => page.classList.remove('active-page'));
                const targetPage = document.getElementById('page-' + pageId);
                if (targetPage) targetPage.classList.add('active-page');

                const activeNavItem = document.querySelector(`.nav-item[data-page="${pageId}"]`);
                if (activeNavItem) activeNavItem.classList.add('active');
            }

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
