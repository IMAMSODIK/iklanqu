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
        </div>

        @include('dashboard_layouts.nav')
    </div>

    {{-- @include('dashboard_layouts.script') --}}
</body>

</html>
