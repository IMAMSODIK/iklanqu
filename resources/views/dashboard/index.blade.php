<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard_layouts.head')
    <style>
        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 8px;
            font-size: 0.9rem;
            letter-spacing: -0.2px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 16px;
            border-radius: 20px;
            border: 1.5px solid #e2e8f0;
            background: #ffffff;
            font-size: 0.95rem;
            transition: 0.2s;
            outline: none;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        textarea {
            resize: vertical;
            min-height: 90px;
        }

        /* file upload styling */
        .file-zone {
            border: 2px dashed #cbd5e1;
            border-radius: 24px;
            padding: 28px 20px;
            text-align: center;
            background: #fefce8;
            transition: 0.2s;
            cursor: pointer;
        }

        .file-zone:hover {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .file-preview {
            margin-top: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            background: #f1f5f9;
            border-radius: 40px;
            padding: 8px 16px;
            width: fit-content;
        }

        .file-preview span {
            font-size: 0.85rem;
            font-weight: 500;
            color: #1e293b;
        }

        .remove-file {
            background: #ef4444;
            border: none;
            color: white;
            border-radius: 40px;
            padding: 4px 10px;
            font-size: 12px;
            cursor: pointer;
        }

        /* campaign footer */
        .action-buttons {
            text-align: center;
            margin-top: 32px;
        }

        .btn-submit {
            background: #2563eb;
            color: white;
            border: none;
            padding: 12px 32px;
            border-radius: 40px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.2s;
            box-shadow: 0 4px 8px rgba(37, 99, 235, 0.2);
        }

        .btn-submit:hover {
            background: #1d4ed8;
            transform: scale(0.98);
        }

        .btn-secondary {
            background: #f1f5f9;
            border: 1px solid #cbd5e1;
            padding: 12px 28px;
            border-radius: 40px;
            font-weight: 500;
            cursor: pointer;
        }

        /* responsiveness */
        @media (max-width: 700px) {
            .campaign-card {
                padding: 16px;
            }

            .date-input-group input {
                width: 110px;
            }

            .location-table th,
            .location-table td {
                padding: 8px 6px;
            }
        }

        .info-badge {
            background: #dbeafe;
            border-radius: 40px;
            padding: 10px 16px;
            font-size: 0.8rem;
            color: #1e40af;
            margin-bottom: 20px;
        }

        hr {
            margin: 20px 0;
            border-color: #eef2ff;
        }

        .required-star {
            color: #ef4444;
            margin-left: 2px;
        }
    </style>


    {{-- lokasi style --}}
    <style>
        .locations-section {
            margin-top: 24px;
            background: #f8fafc;
            border-radius: 24px;
            padding: 18px;
            border: 1px solid #e2e8f0;
        }

        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
            flex-wrap: wrap;
            font-weight: 700;
            color: #0f172a;
        }

        .section-title span {
            background: #e2e8f0;
            padding: 5px 12px;
            border-radius: 999px;
            font-size: 11px;
            color: #475569;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .location-table {
            width: 100%;
            min-width: 720px;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .location-table th {
            background: #f1f5f9;
            padding: 14px;
            text-align: left;
            font-size: 0.82rem;
            color: #475569;
        }

        .location-table td {
            background: white;
            padding: 14px;
            border-top: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }

        .location-table td:first-child {
            border-left: 1px solid #e2e8f0;
            border-top-left-radius: 16px;
            border-bottom-left-radius: 16px;
        }

        .location-table td:last-child {
            border-right: 1px solid #e2e8f0;
            border-top-right-radius: 16px;
            border-bottom-right-radius: 16px;
        }

        .location-table tbody tr {
            cursor: pointer;
            transition: 0.2s;
        }

        .location-table tbody tr:hover td {
            background: #f8fafc;
        }

        .board-name {
            font-weight: 700;
            color: #0f172a;
        }

        .board-code {
            font-size: 12px;
            color: #64748b;
            margin-top: 3px;
        }

        .btn-edit {
            border: none;
            background: #eff6ff;
            color: #2563eb;
            padding: 10px 14px;
            border-radius: 12px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 16px;
            z-index: 999;
        }

        .modal-content {
            width: 100%;
            max-width: 420px;
            background: white;
            border-radius: 24px;
            padding: 20px;
            box-sizing: border-box;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 18px;
        }

        .modal-header h3 {
            margin: 0;
            color: #0f172a;
        }

        .modal-header p {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .close-modal {
            width: 36px;
            height: 36px;
            border: none;
            border-radius: 12px;
            background: #f1f5f9;
            cursor: pointer;
        }

        .price-info {
            background: #eff6ff;
            color: #1d4ed8;
            padding: 14px;
            border-radius: 14px;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
        }

        .form-group input {
            width: 100%;
            max-width: 100%;
            height: 46px;
            border-radius: 14px;
            border: 1px solid #cbd5e1;
            padding: 0 14px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .summary-box {
            background: #f8fafc;
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .summary-item:last-child {
            margin-bottom: 0;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
        }

        .btn-clear {
            flex: 1;
            height: 48px;
            border: none;
            border-radius: 14px;
            background: #fee2e2;
            color: #dc2626;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-save {
            flex: 1;
            height: 48px;
            border: none;
            border-radius: 14px;
            background: #0f172a;
            color: white;
            font-weight: 700;
            cursor: pointer;
        }

        @media (max-width: 768px) {

            .locations-section {
                padding: 14px;
            }

            .location-table {
                min-width: 680px;
            }

            .location-table th,
            .location-table td {
                padding: 12px;
                font-size: 12px;
            }

            .modal-content {
                max-width: 100%;
                border-radius: 20px;
                padding: 18px;
            }

            .form-group input {
                font-size: 13px;
            }

        }
    </style>
</head>

<body>
    <input type="hidden" id="page" value="buat">
    <div class="app-container">
        @include('dashboard_layouts.header')

        <div class="content-area" id="content-area">
            <div class="page active-page" id="page-buat">
                <div class="page-header">
                    <div class="page-title">Buat Iklan Baru</div>
                    <div class="page-subtitle">Mulai kampanye iklan Anda</div>
                </div>

                <div class="campaign-card">
                    <form id="campaignForm">
                        <div class="form-group">
                            <label>Nama Campaign <span class="required-star">*</span></label>
                            <input type="text" id="campaign_name"
                                placeholder="Contoh: Promo Ramadhan 2025 - Brand Boost" required>
                        </div>

                        <!-- DESKRIPSI IKLAN -->
                        <div class="form-group">
                            <label>Deskripsi Iklan</label>
                            <textarea id="ad_description" placeholder="Tentukan pesan utama, target audiens, atau value proposition..."></textarea>
                        </div>

                        <!-- FILE (VIDEO/GAMBAR) -->
                        <div class="form-group">
                            <label>File Media (Gambar / Video) <span class="required-star">*</span></label>
                            <div class="file-zone" id="fileDropZone">
                                📤 Klik atau seret file ke sini<br>
                                <small style="color:#64748b">Maks 20MB, format JPG, PNG, MP4, MOV</small>
                            </div>
                            <input type="file" id="media_file" style="display: none;" accept="image/*,video/*">
                            <div id="filePreviewArea" style="margin-top: 12px;"></div>
                        </div>

                        <!-- TABLE LOKASI DENGAN TANGGAL MULAI & TANGGAL SELESAI -->
                        <div class="locations-section">

                            <div class="section-title">

                                <div>
                                    📍 Daftar Board
                                </div>

                                <span>
                                    Klik row untuk mengatur jadwal
                                </span>

                            </div>

                            <div class="table-wrapper">

                                <table class="location-table">

                                    <thead>

                                        <tr>
                                            <th>Board</th>
                                            <th>Lokasi</th>
                                            <th>Jadwal</th>
                                            <th>Durasi</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach ($boards as $board)
                                            <tr class="table-row" data-id="{{ $board->id }}"
                                                data-name="{{ $board->name }}" data-lokasi="{{ $board->lokasi->nama }}"
                                                data-harga="{{ $board->harga }}">

                                                <td>

                                                    <div class="board-name">
                                                        {{ $board->name }}
                                                    </div>

                                                    <div class="board-code">
                                                        {{ $board->kode }}
                                                    </div>

                                                </td>

                                                <td>
                                                    {{ $board->lokasi->nama }}
                                                </td>

                                                <td class="jadwal-text">
                                                    Belum dipilih
                                                </td>

                                                <td class="durasi-text">
                                                    -
                                                </td>

                                                <td class="harga-text">
                                                    -
                                                </td>

                                                <td>

                                                    <button type="button" class="btn-edit">
                                                        Edit
                                                    </button>

                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                        </div>

                        <div class="action-buttons">
                            <button type="submit" class="btn-submit">Simpan Campaign</button>
                        </div>
                    </form>
                </div>

                <hr>

                <div class="create-ad-card">
                    <h3>Iklan Cepat, Hasil Tepat dan Biaya Murah</h3>
                    <p><b>iklanqu.id</b> <i>The Best Partner For Your Bussines</i></p>
                    <button class="create-ad-button" onclick="alert('Mulai membuat iklan')">
                        <span>+</span> Buat Iklan Sekarang
                    </button>
                </div>
            </div>
        </div>

        @include('dashboard_layouts.nav')
    </div>

    <div class="locations-section">

        <div class="section-title">

            <div>
                📍 Daftar Board
            </div>

            <span>
                Klik row untuk mengatur jadwal
            </span>

        </div>

        <div class="table-wrapper">

            <table class="location-table">

                <thead>

                    <tr>
                        <th>Board</th>
                        <th>Lokasi</th>
                        <th>Jadwal</th>
                        <th>Durasi</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach ($boards as $board)
                        <tr class="table-row" data-id="{{ $board->id }}" data-name="{{ $board->name }}"
                            data-lokasi="{{ $board->lokasi->nama }}" data-harga="{{ $board->harga }}">

                            <td>

                                <div class="board-name">
                                    {{ $board->name }}
                                </div>

                                <div class="board-code">
                                    {{ $board->kode }}
                                </div>

                            </td>

                            <td>
                                {{ $board->lokasi->nama }}
                            </td>

                            <td class="jadwal-text">
                                Belum dipilih
                            </td>

                            <td class="durasi-text">
                                -
                            </td>

                            <td class="harga-text">
                                -
                            </td>

                            <td>

                                <button type="button" class="btn-edit">
                                    Edit
                                </button>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

    @include('dashboard_layouts.script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        // ---------- FILE UPLOAD HANDLER dengan preview ----------
        let selectedFile = null;
        const fileInput = document.getElementById('media_file');
        const dropZone = document.getElementById('fileDropZone');
        const previewArea = document.getElementById('filePreviewArea');

        dropZone.addEventListener('click', () => {
            fileInput.click();
        });
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.style.background = '#e0f2fe';
            dropZone.style.borderColor = '#3b82f6';
        });
        dropZone.addEventListener('dragleave', () => {
            dropZone.style.background = '#fefce8';
            dropZone.style.borderColor = '#cbd5e1';
        });
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.style.background = '#fefce8';
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleFile(files[0]);
            }
        });
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length) handleFile(e.target.files[0]);
        });

        function handleFile(file) {
            const allowedTypes = ['image/jpeg', 'image/png', 'video/mp4', 'video/quicktime', 'video/x-msvideo'];
            if (!allowedTypes.includes(file.type)) {
                alert("Format tidak didukung. Gunakan JPG, PNG, MP4, atau MOV");
                return;
            }
            if (file.size > 20 * 1024 * 1024) {
                alert("Ukuran file maksimal 20MB");
                return;
            }
            selectedFile = file;
            // preview
            let previewHtml = `<div class="file-preview">
                            <span>📎 ${file.name} (${(file.size/1024).toFixed(1)} KB)</span>
                            <button type="button" class="remove-file" id="removeFileBtn">Hapus</button>
                        </div>`;
            previewArea.innerHTML = previewHtml;
            const removeBtn = document.getElementById('removeFileBtn');
            if (removeBtn) removeBtn.onclick = () => {
                selectedFile = null;
                previewArea.innerHTML = '';
                fileInput.value = '';
            };
        }
    </script>

    <script>
        $('#campaignForm').on('submit', function(e) {
            e.preventDefault();

            let locations = [];

            $('#locationTableBody tr').each(function() {
                let row = $(this);

                let id = row.data('id');
                let start = row.find('.tanggal-mulai').val();
                let end = row.find('.tanggal-selesai').val();

                if (start && end) {
                    locations.push({
                        location_id: id,
                        tanggal_mulai: start,
                        tanggal_selesai: end
                    });
                }
            });

            let formData = new FormData();
            formData.append('name', $('#campaign_name').val());
            formData.append('description', $('#ad_description').val());
            formData.append('media', selectedFile);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('locations', JSON.stringify(locations));

            $.ajax({
                url: '/campaigns',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {

                    if (res.snap_token) {
                        snap.pay(res.snap_token, {
                            onSuccess: function() {
                                alert('Pembayaran berhasil!');
                                location.reload();
                            },
                            onPending: function() {
                                alert('Menunggu pembayaran...');
                            },
                            onError: function() {
                                alert('Pembayaran gagal');
                            }
                        });
                    }

                },
                error: function(err) {
                    console.log(err);
                    alert('Gagal menyimpan campaign');
                }
            });
        });
    </script>

    <script>
        const modal = document.getElementById('scheduleModal');

        const closeModal = document.getElementById('closeModal');

        const tanggalMulai = document.getElementById('tanggalMulai');

        const tanggalSelesai = document.getElementById('tanggalSelesai');

        const totalHariText = document.getElementById('totalHari');

        const totalHargaText = document.getElementById('totalHarga');

        const modalBoardName = document.getElementById('modalBoardName');

        const modalLokasi = document.getElementById('modalLokasi');

        const modalHarga = document.getElementById('modalHarga');

        let currentRow = null;

        let hargaPerHari = 0;



        document.querySelectorAll('.openModal').forEach(button => {

            button.addEventListener('click', function() {

                currentRow = this.closest('tr');

                const boardName = currentRow.dataset.name;

                const lokasi = currentRow.dataset.lokasi;

                hargaPerHari = parseInt(currentRow.dataset.harga);

                modalBoardName.innerText = boardName;

                modalLokasi.innerText = lokasi;

                modalHarga.innerText =
                    'Rp ' + hargaPerHari.toLocaleString('id-ID');

                modal.style.display = 'flex';

            });

        });



        closeModal.addEventListener('click', () => {

            modal.style.display = 'none';

        });



        function calculateTotal() {

            if (!tanggalMulai.value || !tanggalSelesai.value) return;

            const start = new Date(tanggalMulai.value);

            const end = new Date(tanggalSelesai.value);

            const diff = end - start;

            const totalHari = Math.floor(
                diff / (1000 * 60 * 60 * 24)
            ) + 1;

            if (totalHari <= 0) return;

            const totalHarga = totalHari * hargaPerHari;

            totalHariText.innerText =
                totalHari + ' Hari';

            totalHargaText.innerText =
                'Rp ' + totalHarga.toLocaleString('id-ID');

        }



        tanggalMulai.addEventListener('change', calculateTotal);

        tanggalSelesai.addEventListener('change', calculateTotal);



        document.getElementById('saveSchedule')
            .addEventListener('click', function() {

                if (!currentRow) return;

                const start = tanggalMulai.value;

                const end = tanggalSelesai.value;

                const durasi = totalHariText.innerText;

                const total = totalHargaText.innerText;

                currentRow.querySelector('.jadwal-text').innerText =
                    start + ' s/d ' + end;

                currentRow.querySelector('.durasi-text').innerText =
                    durasi;

                currentRow.querySelector('.harga-text').innerText =
                    total;

                modal.style.display = 'none';

            });
    </script>
</body>

</html>
