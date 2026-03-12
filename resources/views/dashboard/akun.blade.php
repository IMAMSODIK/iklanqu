<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard_layouts.head')
</head>

<body>
    <input type="hidden" id="page" value="akun">
    <div class="app-container">
        @include('dashboard_layouts.header')

        <div class="content-area" id="content-area">
            <!-- Halaman Daftar Lokasi -->
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

    @include('dashboard_layouts.script')
</body>

</html>
