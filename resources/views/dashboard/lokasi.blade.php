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
            background: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .popup-content {
            background: #fff;
            width: 90%;
            max-width: 500px;
            border-radius: 24px;
            max-height: 85vh;
            overflow: hidden;
            animation: fadeIn 0.3s ease;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .popup-header {
            width: 100%;
            height: 220px;
            overflow: hidden;
            background: #f5f5f5;
        }

        .popup-header img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .popup-body {
            padding: 24px;
            overflow-y: auto;
            max-height: calc(85vh - 220px);
        }

        .popup-body h3 {
            font-size: 24px;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 8px 0;
            line-height: 1.3;
        }

        .popup-body p {
            font-size: 15px;
            color: #475569;
            margin: 0 0 16px 0;
            line-height: 1.5;
        }

        .maps-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #2563eb;
            color: white;
            text-align: center;
            padding: 14px 20px;
            border-radius: 12px;
            margin: 8px 0 16px 0;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            width: 100%;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
        }

        .maps-btn:hover {
            background: #1d4ed8;
        }

        .board-slider {
            display: flex;
            gap: 12px;
            overflow-x: auto;
            padding: 8px 0 12px 0;
            margin-top: 8px;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 #f1f5f9;
        }

        .board-slider::-webkit-scrollbar {
            height: 6px;
        }

        .board-slider::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .board-slider::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .board-slider::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .board-slider img {
            height: 100px;
            width: auto;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            cursor: pointer;
        }

        .board-slider img:hover {
            transform: scale(1.02);
        }

        /* Responsive untuk layar kecil */
        @media (max-width: 480px) {
            .popup-content {
                width: 95%;
                border-radius: 20px;
            }

            .popup-header {
                height: 180px;
            }

            .popup-body {
                padding: 20px;
                max-height: calc(85vh - 180px);
            }

            .popup-body h3 {
                font-size: 20px;
            }

            .maps-btn {
                padding: 12px 16px;
            }

            .board-slider img {
                height: 80px;
            }
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
