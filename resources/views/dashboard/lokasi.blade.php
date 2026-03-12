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
            width: 95%;
            max-width: 650px;
            /* diperlebar */
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .3);
            display: flex;
            flex-direction: column;
            max-height: 90vh;
            /* supaya bisa scroll */
            overflow: hidden;
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
            height: 220px;
            object-fit: cover;
        }

        .modal-body {
            padding: 16px;
            overflow-y: auto;
            /* konten bisa scroll */
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

        .maps-preview {
            margin-top: 10px;
            border-radius: 10px;
            overflow: hidden;
        }

        /* BOARD IMAGE GRID */

        .board-slider {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            margin-top: 10px;
            padding-bottom: 5px;
        }

        .board-slider img {
            height: 120px;
            border-radius: 10px;
            object-fit: cover;
            cursor: pointer;
            transition: .2s;
        }

        .board-slider img:hover {
            transform: scale(1.05);
        }

        .image-preview {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, .8);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            padding: 20px;
        }

        .image-preview.show {
            display: flex;
        }

        .image-preview img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .5);
        }

        .image-preview img {
            transform: scale(.9);
            transition: .25s;
        }

        .image-preview.show img {
            transform: scale(1);
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

        <div class="image-preview" id="imagePreview">
            <img id="previewImage">
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
                <img 
                src="/storage/${photo.file}" 
                class="board-img">
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

            $(document).on("click", ".board-img", function() {

                let src = $(this).attr("src");

                $("#previewImage").attr("src", src);

                $("#imagePreview").addClass("show");

            });

            $("#imagePreview").click(function() {

                $(this).removeClass("show");

            });
        </script>
</body>

</html>
