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

            <!-- Halaman Riwayat Iklan -->
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

            <!-- Halaman Buat Iklan Baru (AKTIF DEFAULT) -->
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

            <!-- Halaman Pantau Iklan -->
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

            <!-- Halaman Akun -->
            <div class="page" id="page-akun">
                <div class="page-header">
                    <div class="page-title">Akun</div>
                    <div class="page-subtitle">Profil dan pengaturan</div>
                </div>
                <div class="card" style="display: flex; align-items: center; gap: 20px; background: #f1f4f9;">
                    <div
                        style="width: 64px; height: 64px; background: #2563eb; border-radius: 32px; display: flex; align-items: center; justify-content: center; color: white; font-size: 28px; flex-shrink: 0;">
                        👤</div>
                    <div style="min-width: 0; flex: 1;">
                        <h3 style="font-size: 18px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            Andi Saputra</h3>
                        <p style="color: #475569; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            andi@example.com</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-item">
                        <div class="item-icon">⚙️</div>
                        <div class="item-info">
                            <h4>Pengaturan Akun</h4>
                        </div>
                    </div>
                    <div class="card-item">
                        <div class="item-icon">🔔</div>
                        <div class="item-info">
                            <h4>Notifikasi</h4>
                        </div>
                    </div>
                    <div class="card-item">
                        <div class="item-icon">💳</div>
                        <div class="item-info">
                            <h4>Metode Pembayaran</h4>
                        </div>
                    </div>
                    <div class="card-item">
                        <div class="item-icon">📞</div>
                        <div class="item-info">
                            <h4>Pusat Bantuan</h4>
                        </div>
                    </div>
                    <div class="card-item logout">
                        <div class="item-icon">🚪</div>
                        <div class="item-info">
                            <h4>Logout</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('dashboard_layouts.nav')
    </div>

    {{-- @include('dashboard_layouts.script') --}}
</body>

</html>
