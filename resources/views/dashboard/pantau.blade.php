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
            <div class="page" id="page-pantau">
                <div class="page-header">
                    <div class="page-title">Pantau Iklan</div>
                    <div class="page-subtitle">Kinerja iklan real-time</div>
                </div>
                <div class="card">
                    <div class="card-item">
                        <div class="item-icon">📊</div>
                        <div class="item-info">
                            <h4>Kampanye Ramadhan</h4>
                            <p>Impresi: 45.200 • Klik: 2.340</p>
                        </div>
                        <span style="color: #2563eb; font-weight: 600;">5.2%</span>
                    </div>
                    <div class="card-item">
                        <div class="item-icon">📈</div>
                        <div class="item-info">
                            <h4>Promo Akhir Pekan</h4>
                            <p>Impresi: 28.900 • Klik: 1.456</p>
                        </div>
                        <span style="color: #2563eb; font-weight: 600;">5.0%</span>
                    </div>
                    <div class="card-item">
                        <div class="item-icon">🔥</div>
                        <div class="item-info">
                            <h4>Produk Terbaru</h4>
                            <p>Impresi: 67.800 • Klik: 4.120</p>
                        </div>
                        <span style="color: #10b981; font-weight: 600;">6.1%</span>
                    </div>
                </div>
                <div class="card" style="background: white;">
                    <p style="font-weight: 600;">Total pengeluaran bulan ini: Rp 2.450.000</p>
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
            document.getElementById('page-pantau').classList.add('active-page');

            // navItems.forEach(item => item.classList.remove('active'));
            document.querySelector('.nav-item.middle-item').classList.add('active');

            // Fungsi switch halaman
            function switchPage(pageId) {
                pages.forEach(page => page.classList.remove('active-page'));
                const targetPage = document.getElementById('page-' + pageId);
                if (targetPage) targetPage.classList.add('active-page');
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
