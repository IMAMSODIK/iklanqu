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
            position: relative;
            overflow: hidden;
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
            padding: 16px;
            border: 1px solid #e2e8f0;
        }

        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 16px;
            font-weight: 700;
            color: #0f172a;
        }

        .section-title span {
            background: #e2e8f0;
            color: #475569;
            padding: 5px 12px;
            border-radius: 999px;
            font-size: 11px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .location-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
            min-width: 680px;
        }

        .location-table th {
            background: #f1f5f9;
            padding: 12px;
            text-align: left;
            font-size: 12px;
            color: #64748b;
        }

        .location-table td {
            background: white;
            padding: 12px;
            font-size: 12px;
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

        .table-row {
            cursor: pointer;
            transition: 0.2s;
        }

        .table-row:hover td {
            background: #f8fafc;
        }

        .board-name {
            font-weight: 700;
            color: #0f172a;
        }

        .board-code {
            margin-top: 3px;
            font-size: 11px;
            color: #64748b;
        }

        .btn-edit {
            border: none;
            background: #eff6ff;
            color: #2563eb;
            padding: 8px 12px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 16px;
            z-index: 9999;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            width: 100%;
            max-width: 420px;
            background: white;
            border-radius: 24px;
            padding: 18px;
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
            font-size: 18px;
            color: #0f172a;
        }

        .modal-header p {
            margin: 4px 0 0;
            font-size: 12px;
            color: #64748b;
        }

        .close-modal {
            width: 36px;
            height: 36px;
            border: none;
            background: #f1f5f9;
            border-radius: 12px;
            cursor: pointer;
        }

        .price-info {
            background: #eff6ff;
            color: #1d4ed8;
            padding: 14px;
            border-radius: 14px;
            font-size: 13px;
            margin-bottom: 16px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 12px;
            font-weight: 600;
            color: #334155;
        }

        .form-group input {
            width: 100%;
            height: 46px;
            border: 1px solid #cbd5e1;
            border-radius: 14px;
            padding: 0 14px;
            box-sizing: border-box;
            font-size: 13px;
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
            font-size: 13px;
        }

        .summary-item:last-child {
            margin-bottom: 0;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
        }

        .btn-clear,
        .btn-save {
            flex: 1;
            height: 46px;
            border: none;
            border-radius: 14px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-clear {
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-save {
            background: #0f172a;
            color: white;
        }
    </style>

    <style>
        .spinner {
            width: 14px;
            height: 14px;
            border: 2px solid white;
            border-top: 2px solid transparent;
            border-radius: 50%;
            display: inline-block;
            animation: spin 0.8s linear infinite;
            margin-right: 6px;
            vertical-align: middle;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <style>
        .schedule-badge {
            min-width: 24px;
            height: 24px;
            border-radius: 999px;
            background: #ef4444;
            color: white;
            font-size: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            transition: transform 0.25s ease;
        }

        .schedule-badge.bump {
            animation: badgeBounce 0.5s ease;
        }

        .btn-submit.success-animate {
            animation: buttonPulse 0.5s ease;
        }

        @keyframes badgeBounce {
            0% {
                transform: scale(1);
            }

            30% {
                transform: scale(1.35);
            }

            60% {
                transform: scale(0.9);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes buttonPulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.03);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
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
                    <form id="campaignForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nama Campaign <span class="required-star">*</span></label>
                            <input type="text" id="campaign_name"
                                placeholder="Contoh: Promo Ramadhan 2025 - Brand Boost" required name="name">
                        </div>

                        <!-- DESKRIPSI IKLAN -->
                        <div class="form-group">
                            <label>Deskripsi Iklan</label>
                            <textarea name="description" id="ad_description"
                                placeholder="Tentukan pesan utama, target audiens, atau value proposition..."></textarea>
                        </div>

                        <!-- FILE (VIDEO/GAMBAR) -->
                        <div class="form-group">
                            <label>File Media (Gambar / Video) <span class="required-star">*</span></label>
                            <div class="file-zone" id="fileDropZone">
                                📤 Klik atau seret file ke sini<br>
                                <small style="color:#64748b">Maks 20MB, format JPG, PNG, MP4, MOV</small>
                            </div>
                            <input type="file" name="media" id="media_file" style="display: none;"
                                accept="image/*,video/*">
                            <div id="filePreviewArea" style="margin-top: 12px;"></div>
                        </div>

                        <!-- TABLE LOKASI DENGAN TANGGAL MULAI & TANGGAL SELESAI -->
                        <div class="locations-section">

                            <div class="section-title">
                                <div>📍 Daftar Board</div>

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
                                                data-harga="{{ $board->price }}">

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

                        <input type="hidden" name="boards" id="boardsInput">
                        <div class="action-buttons">
                            <button type="submit" class="btn-submit" id="btnSubmitCampaign">
                                <span class="btn-text">
                                    Simpan Campaign
                                    <span class="schedule-badge" id="scheduleBadge">
                                        0
                                    </span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>

                <hr>

                <div class="create-ad-card">
                    <h3>Iklan Cepat, Hasil Tepat dan Biaya Murah</h3>
                    <p><b>iklanqu.id</b> <i>The Best Partner For Your Bussines</i></p>
                    <button class="create-ad-button"
                        onclick="window.location.href='https://wa.me/6282145397049?text=Halo%20saya%20ingin%20membuat%20iklan'">
                        <span>+</span> Buat Iklan Sekarang
                    </button>
                </div>
            </div>
        </div>

        @include('dashboard_layouts.nav')
    </div>

    <div class="modal-overlay" id="scheduleModal">

        <div class="modal-content">

            <div class="modal-header">

                <div>

                    <h3 id="modalBoardName">
                        Board
                    </h3>

                    <p id="modalLokasi">
                        Lokasi
                    </p>

                </div>

                <button type="button" class="close-modal" id="closeModal">
                    ✕
                </button>

            </div>


            <div class="price-info">

                Harga :
                <strong id="modalHarga">
                    Rp 0
                </strong>
                / hari

            </div>


            <div class="form-group">

                <label>
                    Tanggal Mulai
                </label>

                <input type="date" id="tanggalMulai">

            </div>


            <div class="form-group">

                <label>
                    Tanggal Selesai
                </label>

                <input type="date" id="tanggalSelesai">

            </div>


            <div class="summary-box">

                <div class="summary-item">

                    <span>
                        Total Hari
                    </span>

                    <strong id="totalHari">
                        0 Hari
                    </strong>

                </div>

                <div class="summary-item">

                    <span>
                        Total Harga
                    </span>

                    <strong id="totalHarga">
                        Rp 0
                    </strong>

                </div>

            </div>


            <div class="modal-actions">

                <button type="button" class="btn-clear" id="clearSchedule">
                    Clear
                </button>

                <button type="button" class="btn-save" id="saveSchedule">
                    Simpan
                </button>

            </div>

        </div>

    </div>

    <div class="modal-overlay" id="orderModal">

        <div class="modal-content">

            <div class="modal-header">

                <div>

                    <h3>
                        Detail Order
                    </h3>

                    <p>
                        Pastikan data campaign sudah benar
                    </p>

                </div>

                <button type="button" class="close-modal" id="closeOrderModal">
                    ✕
                </button>

            </div>


            <div class="summary-box">

                <div class="summary-item">
                    <span>Invoice</span>
                    <strong id="detailInvoice">
                        -
                    </strong>
                </div>

                <div class="summary-item">
                    <span>Total</span>
                    <strong id="detailTotal">
                        Rp 0
                    </strong>
                </div>

                <div class="summary-item">
                    <span>Status</span>
                    <strong>
                        Pending
                    </strong>
                </div>

            </div>


            <div class="modal-actions">

                <button type="button" class="btn-clear" id="btnEditCampaign">
                    Edit
                </button>

                <button type="button" class="btn-save" id="btnCheckout">
                    Checkout
                </button>

            </div>

        </div>

    </div>

    @include('dashboard_layouts.script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

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

    {{-- <script>
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
    </script> --}}

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

        function openModal(row) {
            currentRow = row;
            modalBoardName.innerText = row.dataset.name;
            modalLokasi.innerText = row.dataset.lokasi;
            hargaPerHari = parseInt(row.dataset.harga);
            modalHarga.innerText = 'Rp ' + hargaPerHari.toLocaleString('id-ID');

            modal.classList.add('active');
        }

        document.querySelectorAll('.table-row').forEach(row => {
            row.addEventListener('click', function() {
                openModal(this);
            });
        });

        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                const row = this.closest('.table-row');
                openModal(row);
            });
        });

        closeModal.addEventListener('click', function() {
            modal.classList.remove('active');
        });

        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.remove('active');
            }
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

        function updateScheduleBadge() {
            let total = 0;

            document.querySelectorAll('.table-row').forEach(row => {
                const jadwal = row.querySelector('.jadwal-text').innerText;

                if (jadwal !== 'Belum dipilih') {
                    total++;
                }
            });

            const badge = document.getElementById('scheduleBadge');

            badge.innerText = total;

            badge.classList.remove('bump');

            void badge.offsetWidth;

            badge.classList.add('bump');
        }

        tanggalMulai.addEventListener('change', calculateTotal);
        tanggalSelesai.addEventListener('change', calculateTotal);

        document.getElementById('saveSchedule').addEventListener('click', function() {
            if (!currentRow) return;

            const start = tanggalMulai.value;
            const end = tanggalSelesai.value;

            currentRow.dataset.tanggal_mulai = start;
            currentRow.dataset.tanggal_selesai = end;
            currentRow.dataset.total = totalHargaText.innerText.replace(/\D/g, '');

            currentRow.querySelector('.jadwal-text').innerText =
                start + ' s/d ' + end;

            currentRow.querySelector('.durasi-text').innerText =
                totalHariText.innerText;

            currentRow.querySelector('.harga-text').innerText =
                totalHargaText.innerText;

            modal.classList.remove('active');

            // animasi tombol
            const submitBtn = document.getElementById('btnSubmitCampaign');

            submitBtn.classList.remove('success-animate');

            void submitBtn.offsetWidth;

            submitBtn.classList.add('success-animate');

            // update badge
            updateScheduleBadge();
        });

        document.getElementById('clearSchedule').addEventListener('click', function() {

            if (!currentRow) return;
            currentRow.querySelector('.jadwal-text').innerText = 'Belum dipilih';
            currentRow.querySelector('.durasi-text').innerText = '-';
            currentRow.querySelector('.harga-text').innerText = '-';

            tanggalMulai.value = '';
            tanggalSelesai.value = '';
            totalHariText.innerText = '0 Hari';
            totalHargaText.innerText = 'Rp 0';
        });
    </script>

    <script>
        const form = document.getElementById('campaignForm');
        const orderModal = document.getElementById('orderModal');
        const closeOrderModal = document.getElementById('closeOrderModal');
        const submitButton = form.querySelector('button[type="submit"]');

        let currentSnapToken = null;

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            // simpan teks asli tombol
            const originalButtonText = submitButton.innerHTML;

            // aktifkan loading
            submitButton.disabled = true;
            submitButton.innerHTML = `
            <span class="spinner"></span>
            Loading...
        `;

            const boards = [];

            document.querySelectorAll('.table-row').forEach(row => {
                const jadwal = row.querySelector('.jadwal-text').innerText;

                if (jadwal === 'Belum dipilih') return;

                boards.push({
                    board_id: row.dataset.id,
                    tanggal_mulai: row.dataset.tanggal_mulai,
                    tanggal_selesai: row.dataset.tanggal_selesai,
                    total: row.dataset.total
                });
            });

            document.getElementById('boardsInput').value = JSON.stringify(boards);

            const formData = new FormData(form);

            try {
                const response = await fetch(
                    "{{ route('campaign.store') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    }
                );

                const result = await response.json();

                if (!result.success) {
                    alert(result.message);

                    // kembalikan tombol normal
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalButtonText;

                    return;
                }

                currentSnapToken = result.snap_token;

                document.getElementById('detailInvoice').innerText = result.invoice;

                document.getElementById('detailTotal').innerText =
                    'Rp ' + parseInt(result.total).toLocaleString('id-ID');

                orderModal.classList.add('active');

            } catch (error) {
                alert('Terjadi kesalahan');
            }

            // kembalikan tombol normal
            submitButton.disabled = false;
            submitButton.innerHTML = originalButtonText;
        });

        closeOrderModal.addEventListener('click', function() {
            orderModal.classList.remove('active');
        });

        document.getElementById('btnEditCampaign').addEventListener('click', function() {
            orderModal.classList.remove('active');
        });

        document.getElementById('btnCheckout').addEventListener('click', function() {
            orderModal.classList.remove('active');

            snap.pay(currentSnapToken, {
                onSuccess: function(result) {
                    window.location.reload();
                },
                onPending: function(result) {
                    window.location.reload();
                },
                onError: function(result) {
                    alert('Pembayaran gagal');
                }
            });
        });
    </script>
</body>

</html>
