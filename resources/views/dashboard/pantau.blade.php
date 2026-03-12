<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard_layouts.head')
</head>

<body>
    <input type="hidden" id="page" value="pantau">
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
</body>

</html>
