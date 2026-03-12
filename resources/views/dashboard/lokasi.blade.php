<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard_layouts.head')
</head>

<body>
    <input type="hidden" id="page" value="lokasi">
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
                    @foreach ($lokasi as $l)
                        <div class="card-item">
                        <div class="item-icon">
                            <img src="{{asset('storage') . '/' $l->gambar}}" alt="">
                        </div>
                        <div class="item-info">
                            <h4>{{ $l->nama }}</h4>
                            <p>{{ $l->alamat }} • 0 iklan aktif</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        @include('dashboard_layouts.nav')
    </div>

    @include('dashboard_layouts.script')
</body>

</html>
