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

        /* lokasi table style - rapi & modern */
        .locations-section {
            margin-top: 32px;
            background: #f1f5f9;
            border-radius: 24px;
            padding: 20px;
        }

        .section-title {
            font-weight: 700;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
            color: #0f172a;
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 20px;
            background: white;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .location-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        .location-table th {
            background: #f8fafc;
            padding: 14px 12px;
            text-align: left;
            font-weight: 600;
            color: #1e293b;
            border-bottom: 1px solid #e2e8f0;
        }

        .location-table td {
            padding: 12px 12px;
            border-bottom: 1px solid #eef2ff;
            vertical-align: middle;
        }

        .location-table tr:last-child td {
            border-bottom: none;
        }

        .location-name {
            font-weight: 600;
            color: #0f3b5f;
        }

        .date-input-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .date-input-group input {
            padding: 8px 10px;
            border-radius: 32px;
            border: 1px solid #cbd5e1;
            font-size: 0.75rem;
            width: 140px;
        }

        .btn-sm {
            background: #e2e8f0;
            border: none;
            border-radius: 40px;
            padding: 6px 12px;
            font-size: 0.7rem;
            font-weight: 500;
            cursor: pointer;
            transition: 0.1s;
        }

        .btn-sm-primary {
            background: #3b82f6;
            color: white;
        }

        .add-location-row {
            margin-top: 20px;
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        .add-location-row select,
        .add-location-row input {
            padding: 8px 12px;
            border-radius: 40px;
            border: 1px solid #cbd5e1;
            background: white;
        }

        .btn-add {
            background: #0f172a;
            color: white;
            border: none;
            padding: 8px 18px;
            border-radius: 40px;
            font-weight: 500;
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
                                📍 Daftar Lokasi & Jadwal Penayangan
                                <span
                                    style="font-size: 12px; background:#e2e8f0; padding:3px 10px; border-radius:40px;">Setiap
                                    lokasi punya jadwal sendiri</span>
                            </div>
                            <div class="table-wrapper">
                                <table class="location-table" id="locationTable">
                                    <thead>
                                        <tr>
                                            <th>Lokasi</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Jumlah</th>
                                            <th style="width: 60px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="locationTableBody">
                                        @foreach ($lokasis as $lokasi)
                                            <tr data-id="{{ $lokasi->id }}" data-nama="{{ $lokasi->nama }}">
                                                <td class="location-name">{{ $lokasi->nama }}</td>
                                                <td>
                                                    <input type="date" name="tanggal_mulai[{{ $lokasi->id }}]"
                                                        class="tanggal-mulai"
                                                        style="padding: 8px; border-radius: 30px; border: 1px solid #cbd5e1; width: 130px;">
                                                </td>
                                                <td>
                                                    <input type="date" name="tanggal_selesai[{{ $lokasi->id }}]"
                                                        class="tanggal-selesai"
                                                        style="padding: 8px; border-radius: 30px; border: 1px solid #cbd5e1; width: 130px;">
                                                </td>
                                                <td class="location-name">0 Hari</td>
                                                <td>
                                                    <button type="button" class="btn-sm remove-location"
                                                        data-id="{{ $lokasi->id }}"
                                                        style="background: #fee2e2; cursor: pointer; border: none; padding: 6px 10px; border-radius: 32px;">
                                                        🗑️
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if ($lokasis->isEmpty())
                                <div
                                    style="text-align: center; padding: 40px; background: #f8fafc; border-radius: 20px;">
                                    <p style="color: #64748b;">Belum ada lokasi. Silakan tambah lokasi terlebih dahulu.
                                    </p>
                                    <a href="{{ route('lokasi.index') }}" class="btn-add"
                                        style="display: inline-block; margin-top: 12px;">+ Tambah Lokasi</a>
                                </div>
                            @endif
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

    @include('dashboard_layouts.script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        $(document).on('change', '.tanggal-mulai, .tanggal-selesai', function() {
            const row = $(this).closest('tr');
            const startDate = row.find('.tanggal-mulai').val();
            const endDate = row.find('.tanggal-selesai').val();

            if (startDate && endDate && new Date(startDate) > new Date(endDate)) {
                alert('Tanggal mulai tidak boleh lebih besar dari tanggal selesai!');

                if ($(this).hasClass('tanggal-mulai')) {
                    $(this).val(endDate);
                } else {
                    $(this).val(startDate);
                }
            }
        });

        function hitungHari(row) {
            const startDate = row.find('.tanggal-mulai').val();
            const endDate = row.find('.tanggal-selesai').val();

            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);

                const selisih = end - start;
                const hari = Math.floor(selisih / (1000 * 60 * 60 * 24)) + 1;

                if (hari > 0) {
                    row.find('td:eq(3)').text(hari + ' Hari');
                } else {
                    row.find('td:eq(3)').text('0 Hari');
                }
            }
        }

        $(document).on('change', '.tanggal-mulai, .tanggal-selesai', function() {
            const row = $(this).closest('tr');
            hitungHari(row);
        });

        $(document).ready(function() {
            $('#locationTableBody tr').each(function() {
                hitungHari($(this));
            });
        });

        $(document).on('click', '.remove-location', function() {
            const row = $(this).closest('tr');
            const lokasiNama = row.find('.location-name').text();

            if (confirm(`Reset jadwal untuk lokasi "${lokasiNama}"?`)) {
                row.find('.tanggal-mulai').val('');
                row.find('.tanggal-selesai').val('');

                row.find('td:eq(3)').text('0 Hari');

                row.css('background', '#fee2e2');
                setTimeout(() => {
                    row.css('background', '');
                }, 500);
            }
        });
    </script>

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
</body>

</html>
