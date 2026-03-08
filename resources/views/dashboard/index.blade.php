<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Responsive Tabs</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f0f2f5;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .tabs-container {
            max-width: 1100px;
            width: 100%;
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.1), 0 8px 20px -8px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        /* Tab navigation - base (mobile first) */
        .tab-nav {
            display: flex;
            flex-direction: row;
            background: #f8fafd;
            border-bottom: 1px solid #e9edf2;
            overflow-x: auto;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e0 #f1f5f9;
            padding: 8px 12px 0 12px;
            gap: 4px;
        }

        .tab-nav::-webkit-scrollbar {
            height: 5px;
        }

        .tab-nav::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .tab-nav::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 10px;
        }

        .tab-button {
            padding: 14px 24px;
            background: transparent;
            border: none;
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            font-weight: 500;
            color: #5b6879;
            cursor: pointer;
            white-space: nowrap;
            border-radius: 12px 12px 0 0;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
            border-bottom: 3px solid transparent;
            margin-bottom: -1px;
        }

        .tab-button i {
            font-size: 18px;
            color: #7e8b9c;
            transition: color 0.2s;
        }

        .tab-button:hover {
            color: #1e293b;
            background: #eef2f6;
        }

        .tab-button:hover i {
            color: #3b4b5e;
        }

        .tab-button.active {
            color: #0f3b7a;
            background: white;
            border-bottom: 3px solid #0f3b7a;
            font-weight: 600;
        }

        .tab-button.active i {
            color: #0f3b7a;
        }

        /* Content area */
        .tab-content-wrapper {
            display: flex;
            flex-direction: column;
        }

        .tab-panel {
            display: none;
            padding: 32px 36px;
            background: white;
            animation: fadeIn 0.3s ease;
        }

        .tab-panel.active-panel {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0.5; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Styling konten panel */
        .panel-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
        }

        .panel-icon {
            width: 48px;
            height: 48px;
            background: #eef4ff;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0f3b7a;
            font-size: 24px;
            font-weight: 600;
        }

        .panel-title {
            font-size: 24px;
            font-weight: 600;
            color: #0f172a;
            letter-spacing: -0.02em;
        }

        .panel-desc {
            color: #475569;
            line-height: 1.6;
            margin-bottom: 24px;
            font-size: 16px;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
            margin-top: 20px;
        }

        .feature-item {
            background: #f8fafc;
            padding: 12px 16px;
            border-radius: 40px;
            font-size: 14px;
            font-weight: 500;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 8px;
            border: 1px solid #e2e8f0;
        }

        .feature-item i {
            color: #0f3b7a;
        }

        /* Responsive untuk tablet dan desktop */
        @media (min-width: 992px) {
            .tabs-container {
                display: flex;
                flex-direction: row;
                align-items: stretch;
                background: white;
                border-radius: 28px;
            }

            /* Tab navigasi vertikal di samping */
            .tab-nav {
                flex-direction: column;
                background: #f9fbfd;
                border-right: 1px solid #e6ecf3;
                border-bottom: none;
                width: 240px;
                padding: 24px 12px;
                gap: 8px;
                overflow-x: visible;
                overflow-y: auto;
            }

            .tab-button {
                padding: 16px 18px;
                border-radius: 14px;
                border-bottom: none;
                border-left: 4px solid transparent;
                margin-bottom: 0;
                white-space: normal;
                text-align: left;
                width: 100%;
                font-size: 15px;
            }

            .tab-button i {
                font-size: 20px;
                width: 28px;
            }

            .tab-button.active {
                background: white;
                border-left: 4px solid #0f3b7a;
                border-bottom: none;
                box-shadow: 0 8px 16px -8px rgba(0, 40, 100, 0.15);
            }

            .tab-button:hover {
                background: #eef2f6;
            }

            .tab-content-wrapper {
                flex: 1;
                min-width: 0; /* menghindari overflow */
            }

            .tab-panel {
                padding: 36px 42px;
            }
        }

        /* Penyesuaian untuk tablet (antara 768px dan 992px) */
        @media (min-width: 768px) and (max-width: 991px) {
            .tab-nav {
                padding: 8px 16px 0 16px;
            }
            .tab-button {
                padding: 14px 22px;
                font-size: 15px;
            }
            .tab-panel {
                padding: 28px 32px;
            }
            .panel-title {
                font-size: 22px;
            }
        }

        /* Small mobile */
        @media (max-width: 480px) {
            .tab-button {
                padding: 12px 16px;
                font-size: 14px;
            }
            .tab-button i {
                font-size: 16px;
            }
            .tab-panel {
                padding: 24px 20px;
            }
            .panel-title {
                font-size: 20px;
            }
            .panel-icon {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }
            .feature-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Simulasi ikon (fallback jika tidak pakai font icon) */
        .material-icons-sim {
            font-style: normal;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="tabs-container">
        <!-- Navigasi Tabs -->
        <div class="tab-nav">
            <button class="tab-button active" data-tab="tab1">
                <i>📊</i> <span>Dashboard</span>
            </button>
            <button class="tab-button" data-tab="tab2">
                <i>📄</i> <span>Laporan</span>
            </button>
            <button class="tab-button" data-tab="tab3">
                <i>⚙️</i> <span>Pengaturan</span>
            </button>
            <button class="tab-button" data-tab="tab4">
                <i>👥</i> <span>Tim</span>
            </button>
            <button class="tab-button" data-tab="tab5">
                <i>📈</i> <span>Analitik</span>
            </button>
        </div>

        <!-- Konten Panel -->
        <div class="tab-content-wrapper">
            <div class="tab-panel active-panel" id="tab1">
                <div class="panel-header">
                    <div class="panel-icon">📊</div>
                    <div class="panel-title">Dashboard</div>
                </div>
                <div class="panel-desc">
                    Selamat datang di dashboard utama. Lihat ringkasan aktivitas dan metrik penting di sini.
                </div>
                <div class="feature-grid">
                    <span class="feature-item"><i>📌</i> 1,248 pengguna aktif</span>
                    <span class="feature-item"><i>📌</i> Rp 142jt pendapatan</span>
                    <span class="feature-item"><i>📌</i> 89 tugas selesai</span>
                    <span class="feature-item"><i>📌</i> 12 notifikasi</span>
                </div>
            </div>

            <div class="tab-panel" id="tab2">
                <div class="panel-header">
                    <div class="panel-icon">📄</div>
                    <div class="panel-title">Laporan</div>
                </div>
                <div class="panel-desc">
                    Akses laporan keuangan, performa, dan data historis. Ekspor dalam berbagai format.
                </div>
                <div class="feature-grid">
                    <span class="feature-item"><i>📌</i> Laporan bulanan</span>
                    <span class="feature-item"><i>📌</i> Laporan tahunan</span>
                    <span class="feature-item"><i>📌</i> Analisis tren</span>
                    <span class="feature-item"><i>📌</i> Ekspor PDF/Excel</span>
                </div>
            </div>

            <div class="tab-panel" id="tab3">
                <div class="panel-header">
                    <div class="panel-icon">⚙️</div>
                    <div class="panel-title">Pengaturan</div>
                </div>
                <div class="panel-desc">
                    Kelola preferensi akun, notifikasi, keamanan, dan integrasi sistem.
                </div>
                <div class="feature-grid">
                    <span class="feature-item"><i>📌</i> Profil perusahaan</span>
                    <span class="feature-item"><i>📌</i> Manajemen user</span>
                    <span class="feature-item"><i>📌</i> Keamanan 2FA</span>
                    <span class="feature-item"><i>📌</i> Webhook & API</span>
                </div>
            </div>

            <div class="tab-panel" id="tab4">
                <div class="panel-header">
                    <div class="panel-icon">👥</div>
                    <div class="panel-title">Tim</div>
                </div>
                <div class="panel-desc">
                    Kelola anggota tim, peran, dan kolaborasi proyek.
                </div>
                <div class="feature-grid">
                    <span class="feature-item"><i>📌</i> 8 anggota aktif</span>
                    <span class="feature-item"><i>📌</i> 3 tim proyek</span>
                    <span class="feature-item"><i>📌</i> Undang anggota</span>
                    <span class="feature-item"><i>📌</i> Izin akses</span>
                </div>
            </div>

            <div class="tab-panel" id="tab5">
                <div class="panel-header">
                    <div class="panel-icon">📈</div>
                    <div class="panel-title">Analitik</div>
                </div>
                <div class="panel-desc">
                    Visualisasi data, grafik interaktif, dan insight untuk pengambilan keputusan.
                </div>
                <div class="feature-grid">
                    <span class="feature-item"><i>📌</i> Trafik real-time</span>
                    <span class="feature-item"><i>📌</i> Konversi 12.3%</span>
                    <span class="feature-item"><i>📌</i> Sumber trafik</span>
                    <span class="feature-item"><i>📌</i> Perangkat user</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple JavaScript untuk interaktivitas tabs
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabPanels = document.querySelectorAll('.tab-panel');

            function deactivateAll() {
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabPanels.forEach(panel => panel.classList.remove('active-panel'));
            }

            tabButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const tabId = this.getAttribute('data-tab');

                    deactivateAll();
                    this.classList.add('active');

                    const activePanel = document.getElementById(tabId);
                    if (activePanel) {
                        activePanel.classList.add('active-panel');
                    }
                });
            });

            // Opsional: jika ada hash di URL bisa diaktifkan, tetapi untuk demo biar default tab1 aktif.
        });
    </script>
</body>
</html>