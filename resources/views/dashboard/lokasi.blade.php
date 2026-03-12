<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard_layouts.head')
    <style>
        .badge-iklan {
            display: inline-block;
            margin-left: 6px;
            padding: 2px 8px;
            font-size: 12px;
            font-weight: 500;
            color: #2563eb;
            background: #e0e7ff;
            border-radius: 20px;
        }
    </style>
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
                                @if ($l->gambar)
                                    <img src="{{ asset('storage') . '/' . $l->gambar }}" alt="{{ $l->nama }}"
                                        width="50" height="50" style="border-radius:50%; object-fit:cover;">
                                @else
                                    🏢
                                @endif
                            </div>
                            <div class="item-info">
                                <h4>{{ $l->nama }}</h4>
                                <p>
                                    {{ $l->alamat }} <br>
                                    <span class="badge-iklan">0 iklan aktif</span>
                                </p>
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
