<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard_layouts.head')
    <style>
        .badge-iklan {
            display: inline-block;
            margin-top: 5px;
            padding: 2px 8px;
            font-size: 12px;
            font-weight: 500;
            color: #2563eb;
            background: #e0e7ff;
            border-radius: 20px;
        }

        .lokasi-popup {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            top: 0;
            background: rgba(0, 0, 0, .4);
            display: none;
            align-items: flex-end;
            z-index: 9999;
        }

        .popup-content {
            background: #fff;
            width: 100%;
            border-radius: 20px 20px 0 0;
            max-height: 90vh;
            overflow: auto;
            animation: slideUp .3s ease;
        }

        @keyframes slideUp {
            from {
                transform: translateY(100%)
            }

            to {
                transform: translateY(0)
            }
        }

        .popup-header img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .popup-body {
            padding: 16px;
        }

        .maps-btn {
            display: block;
            background: #2563eb;
            color: #fff;
            text-align: center;
            padding: 10px;
            border-radius: 10px;
            margin: 10px 0;
            text-decoration: none;
        }

        .board-slider {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding: 10px 0;
        }

        .board-slider img {
            height: 120px;
            border-radius: 10px;
            object-fit: cover;
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
                    <div class="page-title">Pilih Lokasi Iklan</div>
                    <div class="page-subtitle">Pasang iklan bisnis Anda di lokasi strategis dan jangkau lebih banyak
                        pelanggan</div>
                </div>
                <div class="card">
                    @foreach ($lokasi as $l)
                        <div class="card-item lokasi-card" data-nama="{{ $l->nama }}"
                            data-alamat="{{ $l->alamat }}"
                            data-gambar="{{ $l->gambar ? asset('storage/' . $l->gambar) : '' }}"
                            data-maps="{{ $l->link_maps }}" data-boards='@json($l->board)'>

                            <div class="item-icon">
                                @if ($l->gambar)
                                    <img src="{{ asset('storage') . '/' . $l->gambar }}" width="50" height="50"
                                        style="border-radius:50%;object-fit:cover;">
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

    <div class="lokasi-popup" id="lokasiPopup">
        <div class="popup-content">

            <div class="popup-header">
                <img id="popupImage">
            </div>

            <div class="popup-body">
                <h3 id="popupNama"></h3>
                <p id="popupAlamat"></p>

                <a id="popupMaps" target="_blank" class="maps-btn">
                    📍 Buka di Google Maps
                </a>

                <div class="board-slider" id="boardSlider"></div>
            </div>

        </div>
    </div>

    @include('dashboard_layouts.script')
    <script>
        $(".lokasi-card").click(function() {

            let nama = $(this).data("nama");
            let alamat = $(this).data("alamat");
            let gambar = $(this).data("gambar");
            let maps = $(this).data("maps");
            let boards = $(this).data("boards");

            $("#popupNama").text(nama);
            $("#popupAlamat").text(alamat);
            $("#popupMaps").attr("href", maps);
            $("#popupImage").attr("src", gambar);

            let slider = $("#boardSlider");
            slider.html("");

            boards.forEach(board => {
                if (board.photos) {
                    board.photos.forEach(photo => {
                        slider.append(`
                    <img src="/storage/${photo.file}">
                `);
                    });
                }
            });

            $("#lokasiPopup").fadeIn();
        });


        $("#lokasiPopup").click(function(e) {
            if (e.target === this) {
                $(this).fadeOut();
            }
        });
    </script>
</body>

</html>
