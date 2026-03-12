<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navItems = document.querySelectorAll('.nav-item');
        const pages = document.querySelectorAll('.page');

        // Set default ke halaman buat iklan
        pages.forEach(page => page.classList.remove('active-page'));
        document.getElementById('page-buat').classList.add('active-page');

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

    document.querySelector(".logout").addEventListener("click", function() {

        if (confirm("Apakah Anda yakin ingin logout?")) {

            window.location.href = "/logout";

        }

    });
</script>
