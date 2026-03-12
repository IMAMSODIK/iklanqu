<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard_layouts.head')
    <style>
        .lokasi-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, .45);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 20px;
        }

        .lokasi-modal.show {
            display: flex;
        }

        .modal-box {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .3);
            animation: modalFade .25s ease;
        }

        @keyframes modalFade {
            from {
                transform: scale(.9);
                opacity: 0
            }

            to {
                transform: scale(1);
                opacity: 1
            }
        }

        .modal-image img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .modal-body {
            padding: 16px;
        }

        .modal-footer {
            padding: 12px 16px;
            border-top: 1px solid #eee;
            text-align: right;
        }

        .btn-close-modal {
            background: #ef4444;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
        }

        .board-slider {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            margin-top: 10px;
        }

        .board-slider img {
            height: 110px;
            border-radius: 10px;
            object-fit: cover;
        }

        .maps-preview {
            margin-top: 10px;
            border-radius: 10px;
            overflow: hidden;
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

        <div class="lokasi-modal" id="lokasiModal">

            <div class="modal-box">

                <div class="modal-image">
                    <img id="modalImage">
                </div>

                <div class="modal-body">

                    <h3 id="modalNama"></h3>
                    <p id="modalAlamat"></p>

                    <div class="maps-preview">
                        <iframe id="modalMaps" width="100%" height="200" style="border:0" loading="lazy">
                        </iframe>
                    </div>

                    <h4 style="margin-top:15px">Board di lokasi ini</h4>

                    <div class="board-slider" id="boardSlider"></div>

                </div>

                <div class="modal-footer">
                    <button class="btn-close-modal">Tutup</button>
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

                $("#modalNama").text(nama);
                $("#modalAlamat").text(alamat);
                $("#modalImage").attr("src", gambar);
                $("#modalMaps").attr("src", maps);

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

                $("#lokasiModal").addClass("show");

            });

            $(".btn-close-modal").click(function() {
                $("#lokasiModal").removeClass("show");
            });

            $("#lokasiModal").click(function(e) {
                if (e.target === this) {
                    $(this).removeClass("show");
                }
            });
        </script>
</body>

</html>
