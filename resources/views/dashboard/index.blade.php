<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard_layouts.head')
</head>

<body>
    <div class="app-container">
        @include('dashboard_layouts.header')

        <div class="content-area" id="content-area">
            <div class="page active-page" id="page-buat">
                <div class="page-header">
                    <div class="page-title">Buat Iklan Baru</div>
                    <div class="page-subtitle">Mulai kampanye iklan Anda</div>
                </div>

                <div class="create-ad-card">
                    <h3>Iklan Cepat, Hasil Tepat dan Biaya Murah</h3>
                    <p><b>iklanqu.id</b> <i>The Best Partner For Your Bussines</i></p>
                    <button class="create-ad-button" onclick="alert('Mulai membuat iklan')">
                        <span>+</span> Buat Iklan Sekarang
                    </button>
                </div>

                <div style="margin: 20px 0 12px; font-weight: 600; color: #1e293b;">Pilih format iklan:</div>
                <div class="format-options">
                    <div class="format-card">
                        <div class="emoji">🖼️</div>
                        <h4>Iklan Gambar</h4>
                    </div>
                    <div class="format-card">
                        <div class="emoji">🎥</div>
                        <h4>Iklan Video</h4>
                    </div>
                    <div class="format-card">
                        <div class="emoji">📝</div>
                        <h4>Iklan Teks</h4>
                    </div>
                    <div class="format-card">
                        <div class="emoji">🔄</div>
                        <h4>Karusel</h4>
                    </div>
                </div>

                <div style="background: #eef2ff; border-radius: 20px; padding: 16px; margin: 20px 0;">
                    <p style="color: #1e40af; font-weight: 500;">💡 Tips: Iklan video memiliki engagement 40% lebih
                        tinggi</p>
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
            document.getElementById('page-buat').classList.add('active-page');

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
