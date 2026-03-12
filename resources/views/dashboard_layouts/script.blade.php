<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let page = $("#page").val();
        const pages = document.querySelectorAll('.page');

        // Set default ke halaman buat iklan
        pages.forEach(page => page.classList.remove('active-page'));
        document.getElementById(`page-${page}`).classList.add('active-page');

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

    document.querySelector(".logout").addEventListener("click", function() {
        if (confirm("Apakah Anda yakin ingin logout?")) {
            window.location.href = "/logout";
        }
    });
</script>
