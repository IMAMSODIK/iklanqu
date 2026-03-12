<meta charset="UTF-8">
<meta name="viewport"
    content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
<title>Aplikasi Iklan - Full Screen Mobile</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        background: #000;
        /* Hitam untuk safe area */
        min-height: 100vh;
        min-height: -webkit-fill-available;
        /* Untuk iOS */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Container utama yang full screen di semua device */
    .app-container {
        width: 100%;
        width: 100vw;
        height: 100vh;
        height: -webkit-fill-available;
        /* Khusus iOS */
        background: white;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    /* Status bar - dengan safe area padding */
    .status-bar {
        justify-content: center;
        /* tengah horizontal */
        align-items: center;
        /* tengah vertikal */
        text-align: center;
        background: white;
        padding: env(safe-area-inset-top, 16px) 24px 8px 24px;
        padding: max(env(safe-area-inset-top, 16px), 16px) 24px 8px 24px;
        justify-content: space-between;
        font-size: 15px;
        font-weight: 600;
        color: #1e293b;
        border-bottom: 1px solid #eef2f6;
    }

    /* Area konten utama - scrollable, full sisa height */
    .content-area {
        flex: 1;
        overflow-y: auto;
        overflow-x: hidden;
        padding: 24px;
        padding: max(16px, env(safe-area-inset-left)) max(24px, env(safe-area-inset-right));
        background: #ffffff;
        scrollbar-width: thin;
        -webkit-overflow-scrolling: touch;
        /* Smooth scrolling di iOS */
    }

    /* Custom scrollbar */
    .content-area::-webkit-scrollbar {
        width: 6px;
    }

    .content-area::-webkit-scrollbar-track {
        background: #f1f5f9;
    }

    .content-area::-webkit-scrollbar-thumb {
        background: #94a3b8;
        border-radius: 10px;
    }

    /* Styling halaman */
    .page {
        display: none;
        animation: fadeIn 0.3s ease;
        max-width: 800px;
        margin: 0 auto;
        width: 100%;
    }

    .page.active-page {
        display: block;
    }

    @keyframes fadeIn {
        from {
            opacity: 0.5;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .page-header {
        margin-bottom: 28px;
    }

    .page-title {
        font-size: clamp(24px, 7vw, 32px);
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 8px;
        line-height: 1.2;
    }

    .page-subtitle {
        color: #475569;
        font-size: clamp(14px, 4vw, 16px);
    }

    /* Card styles */
    .card {
        background: #f8fafc;
        border-radius: 24px;
        padding: 20px;
        margin-bottom: 20px;
        border: 1px solid #e9edf2;
        transition: transform 0.2s;
    }

    .card-item {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 16px 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .card-item:last-child {
        border-bottom: none;
    }

    .item-icon {
        width: 52px;
        height: 52px;
        background: white;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.02);
        flex-shrink: 0;
    }

    .item-info {
        flex: 1;
        min-width: 0;
        /* Untuk mencegah overflow */
    }

    .item-info h4 {
        font-size: 16px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .item-info p {
        font-size: 14px;
        color: #64748b;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .badge {
        background: #e6f7e6;
        padding: 4px 12px;
        border-radius: 40px;
        color: #0e7b0e;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
        flex-shrink: 0;
    }

    /* Khusus halaman buat iklan */
    .create-ad-card {
        background: linear-gradient(135deg, #2563eb, #1e40af);
        color: white;
        border-radius: 28px;
        padding: clamp(24px, 6vw, 32px);
        text-align: center;
        margin: 20px 0 30px;
    }

    .create-ad-card h3 {
        font-size: clamp(20px, 6vw, 28px);
        font-weight: 700;
        margin-bottom: 12px;
    }

    .create-ad-card p {
        font-size: clamp(14px, 4vw, 16px);
        opacity: 0.9;
        margin-bottom: 24px;
    }

    .create-ad-button {
        background: white;
        color: #1e40af;
        border: none;
        padding: 14px 28px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 16px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.2);
        transition: transform 0.2s;
        -webkit-tap-highlight-color: transparent;
    }

    .create-ad-button:active {
        transform: scale(0.98);
    }

    .format-options {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin: 20px 0;
    }

    .format-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 16px 12px;
        text-align: center;
        transition: all 0.2s;
    }

    .format-card:active {
        background: #f8fafc;
        transform: scale(0.98);
    }

    .format-card .emoji {
        font-size: 28px;
        margin-bottom: 8px;
    }

    .format-card h4 {
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
    }

    /* Bottom Navigation - dengan safe area */
    .bottom-nav {
        background: white;
        border-top: 1px solid #eef2f6;
        display: flex;
        justify-content: space-around;
        align-items: center;
        padding: 8px 16px;
        padding-bottom: max(8px, env(safe-area-inset-bottom, 8px));
        box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.03);
    }

    .nav-item {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 8px 0;
        background: transparent;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
        color: #64748b;
        gap: 4px;
        max-width: 70px;
        -webkit-tap-highlight-color: transparent;
    }

    .nav-item span {
        font-size: 22px;
        font-weight: 500;
        white-space: nowrap;
    }

    .nav-icon {
        font-size: 44px;
        transition: transform 0.2s;
    }

    .nav-item:active .nav-icon {
        transform: scale(0.9);
    }

    .nav-item.middle-item .nav-icon {
        font-size: 42px;
        font-weight: 600;
        line-height: 1;
        display: block;
        color: white;
    }

    .nav-item.middle-item .nav-text {
        display: none;
        /* Sembunyikan teks "Buat" di tombol tengah */
    }


    .nav-item.middle-item .nav-icon {
        color: white !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    .nav-item.middle-item {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: white;
        transform: translateY(-16px);
        height: 60px;
        width: 60px;
        border-radius: 30px;
        box-shadow: 0 10px 20px rgba(37, 99, 235, 0.35);
        border: 4px solid white;
        flex: 0 0 auto;
        margin: 0 5px;
        max-width: 60px;
    }

    .nav-item.middle-item:active {
        transform: translateY(-14px) scale(0.95);
    }

    .nav-item.active {
        color: #2563eb;
    }

    .nav-item.active .nav-icon {
        color: #2563eb;
    }

    .nav-item.middle-item.active {
        background: linear-gradient(135deg, #1d4ed8, #1e3a8a);
    }

    /* Home indicator */
    .home-bar {
        width: 130px;
        height: 5px;
        background: #cbd5e0;
        border-radius: 100px;
        margin: 8px auto;
        margin-bottom: max(8px, env(safe-area-inset-bottom, 8px));
    }

    /* ========== RESPONSIVE BREAKPOINTS ========== */

    /* Mobile first - semua ukuran */
    @media (max-width: 767px) {
        .status-bar {
            padding-left: max(16px, env(safe-area-inset-left));
            padding-right: max(16px, env(safe-area-inset-right));
            padding-top: max(env(safe-area-inset-top, 12px), 12px);
            padding-bottom: 8px;
        }

        .content-area {
            padding: 16px;
            padding-left: max(16px, env(safe-area-inset-left));
            padding-right: max(16px, env(safe-area-inset-right));
        }

        .card {
            padding: 16px;
            border-radius: 20px;
        }

        .card-item {
            padding: 14px 0;
            gap: 14px;
        }

        .item-icon {
            width: 48px;
            height: 48px;
            font-size: 22px;
            border-radius: 16px;
        }

        .item-info h4 {
            font-size: 15px;
        }

        .item-info p {
            font-size: 13px;
        }

        .badge {
            padding: 4px 10px;
            font-size: 11px;
        }

        .format-options {
            gap: 10px;
        }

        .format-card {
            padding: 14px 8px;
        }

        .format-card .emoji {
            font-size: 26px;
        }

        .nav-item {
            max-width: 60px;
        }

        .nav-item span {
            font-size: 15px;
        }

        .nav-item.middle-item {
            height: 56px;
            width: 56px;
        }
    }

    /* Landscape mode */
    @media (max-height: 600px) and (orientation: landscape) {
        .nav-item span {
            font-size: 20px;
        }

        .status-bar {
            padding-top: env(safe-area-inset-top, 8px);
            padding-bottom: 4px;
        }

        .bottom-nav {
            padding: 4px 16px;
            padding-bottom: max(4px, env(safe-area-inset-bottom, 4px));
        }

        .nav-item.middle-item {
            transform: translateY(-10px);
            height: 48px;
            width: 48px;
        }

        .nav-item.middle-item .nav-icon {
            font-size: 48px;
        }

        .home-bar {
            display: none;
        }

        .content-area {
            padding: 12px 16px;
        }
    }

    /* Tablet */
    @media (min-width: 768px) and (max-width: 1023px) {
        .app-container {
            max-width: 100%;
        }

        .content-area {
            padding: 28px;
            padding-left: max(28px, env(safe-area-inset-left));
            padding-right: max(28px, env(safe-area-inset-right));
        }

        .page {
            max-width: 700px;
        }

        .format-options {
            grid-template-columns: repeat(4, 1fr);
        }

        .nav-item {
            max-width: 80px;
        }

        .nav-item span {
            font-size: 20px;
        }
    }

    /* Desktop */
    @media (min-width: 1024px) {
        .app-container {
            max-width: 1200px;
            height: 90vh;
            border-radius: 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            position: relative;
            margin: 20px auto;
        }

        body {
            background: #f0f2f5;
            align-items: center;
            padding: 20px;
        }

        .content-area {
            padding: 32px 40px;
        }

        .page {
            max-width: 900px;
        }

        .nav-item {
            max-width: 90px;
        }

        .nav-item:hover:not(.middle-item) {
            background: #f1f5f9;
            color: #2563eb;
        }
    }

    /* Large Desktop */
    @media (min-width: 1400px) {
        .app-container {
            max-width: 1400px;
        }

        .page {
            max-width: 1000px;
        }
    }

    /* Untuk device dengan notch */
    @supports (padding: max(0px)) {

        .status-bar,
        .content-area,
        .bottom-nav {
            padding-left: max(16px, env(safe-area-inset-left));
            padding-right: max(16px, env(safe-area-inset-right));
        }
    }
</style>
