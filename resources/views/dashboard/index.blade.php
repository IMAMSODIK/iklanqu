<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Buat Kampanye Iklan | Iklanqu.id</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, sans-serif;
        }

        body {
            background: #f8fafc;
        }

        /* Layout styles */
        .app-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 20px 16px 80px 16px;
        }

        /* Header minimalis */
        .dashboard-header {
            margin-bottom: 24px;
        }
        .dashboard-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, #1E3A8A, #3B82F6);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .dashboard-header p {
            color: #475569;
            margin-top: 6px;
        }

        /* main card campaign */
        .campaign-card {
            background: white;
            border-radius: 28px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.03), 0 2px 6px rgba(0,0,0,0.05);
            padding: 24px 28px;
            margin-bottom: 32px;
            transition: all 0.2s ease;
        }

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
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 12px 16px;
            border-radius: 20px;
            border: 1.5px solid #e2e8f0;
            background: #ffffff;
            font-size: 0.95rem;
            transition: 0.2s;
            outline: none;
        }
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
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
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
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
        .add-location-row select, .add-location-row input {
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
            display: flex;
            justify-content: flex-end;
            gap: 16px;
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
            box-shadow: 0 4px 8px rgba(37,99,235,0.2);
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
            .location-table th, .location-table td {
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
<div class="app-container">
    <div class="dashboard-header">
        <h1>✨ Buat Iklan Baru</h1>
        <p>Atur kampanye, unggah kreatif, dan kelola jadwal tiap lokasi dengan mudah</p>
    </div>

    <div class="campaign-card">
        <form id="campaignForm">
            @csrf
            <!-- NAMA CAMPAIGN -->
            <div class="form-group">
                <label>Nama Campaign <span class="required-star">*</span></label>
                <input type="text" id="campaign_name" placeholder="Contoh: Promo Ramadhan 2025 - Brand Boost" required>
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
                    <span style="font-size: 12px; background:#e2e8f0; padding:3px 10px; border-radius:40px;">Setiap lokasi punya jadwal sendiri</span>
                </div>
                <div class="table-wrapper">
                    <table class="location-table" id="locationTable">
                        <thead>
                            <table>
                                <th>Lokasi</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th style="width: 60px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="locationTableBody">
                            <!-- Data awal akan diisi via javascript (default 3 contoh lokasi populer) -->
                        </tbody>
                    </table>
                </div>
                <!-- baris tambah lokasi manual -->
                <div class="add-location-row">
                    <select id="newLocationSelect">
                        <option value="Jakarta Pusat">Jakarta Pusat</option>
                        <option value="Surabaya">Surabaya</option>
                        <option value="Bandung">Bandung</option>
                        <option value="Medan">Medan</option>
                        <option value="Yogyakarta">Yogyakarta</option>
                        <option value="Denpasar">Denpasar</option>
                        <option value="Makassar">Makassar</option>
                        <option value="Palembang">Palembang</option>
                    </select>
                    <input type="date" id="newStartDate" value="{{ date('Y-m-d') }}">
                    <input type="date" id="newEndDate" value="{{ date('Y-m-d', strtotime('+7 days')) }}">
                    <button type="button" class="btn-add" id="addLocationBtn">+ Tambah Lokasi</button>
                </div>
                <small style="display: block; margin-top: 12px; color:#475569;">✔ Setiap lokasi bisa memiliki durasi tayang berbeda sesuai kebutuhan campaign</small>
            </div>

            <div class="action-buttons">
                <button type="button" class="btn-secondary" id="resetBtn">Reset Form</button>
                <button type="submit" class="btn-submit">🚀 Simpan Campaign</button>
            </div>
        </form>
    </div>

    <div class="info-badge">
        💡 Tips: Gunakan video pendek (15-30 detik) untuk engagement maksimal, dan atur jadwal tiap lokasi berdasarkan zona waktu harian.
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    // Data lokasi dinamis : array of objects { name, start_date, end_date }
    let locationsData = [
        { name: "Jakarta Pusat", start_date: "2026-05-10", end_date: "2026-05-25" },
        { name: "Surabaya", start_date: "2026-05-12", end_date: "2026-05-28" },
        { name: "Bandung", start_date: "2026-05-15", end_date: "2026-06-01" }
    ];

    // Helper render table lokasi
    function renderLocationTable() {
        const tbody = document.getElementById('locationTableBody');
        if (!tbody) return;
        tbody.innerHTML = '';
        locationsData.forEach((loc, idx) => {
            const row = tbody.insertRow();
            // kolom nama lokasi
            const cellName = row.insertCell(0);
            cellName.className = 'location-name';
            cellName.textContent = loc.name;
            // kolom tanggal mulai
            const cellStart = row.insertCell(1);
            const startInput = document.createElement('input');
            startInput.type = 'date';
            startInput.value = loc.start_date;
            startInput.classList.add('date-input');
            startInput.style.padding = '8px';
            startInput.style.borderRadius = '30px';
            startInput.style.border = '1px solid #cbd5e1';
            startInput.style.width = '130px';
            startInput.addEventListener('change', (e) => {
                locationsData[idx].start_date = e.target.value;
            });
            cellStart.appendChild(startInput);
            // kolom tanggal selesai
            const cellEnd = row.insertCell(2);
            const endInput = document.createElement('input');
            endInput.type = 'date';
            endInput.value = loc.end_date;
            endInput.classList.add('date-input');
            endInput.style.padding = '8px';
            endInput.style.borderRadius = '30px';
            endInput.style.border = '1px solid #cbd5e1';
            endInput.style.width = '130px';
            endInput.addEventListener('change', (e) => {
                locationsData[idx].end_date = e.target.value;
            });
            cellEnd.appendChild(endInput);
            // kolom aksi hapus
            const cellAction = row.insertCell(3);
            const deleteBtn = document.createElement('button');
            deleteBtn.textContent = '🗑️';
            deleteBtn.className = 'btn-sm';
            deleteBtn.style.background = '#fee2e2';
            deleteBtn.style.cursor = 'pointer';
            deleteBtn.style.border = 'none';
            deleteBtn.style.padding = '6px 10px';
            deleteBtn.style.borderRadius = '32px';
            deleteBtn.addEventListener('click', () => {
                if (locationsData.length <= 1) {
                    alert("Minimal satu lokasi harus tersedia!");
                    return;
                }
                locationsData.splice(idx, 1);
                renderLocationTable();
            });
            cellAction.appendChild(deleteBtn);
        });
    }

    // Inisialisasi tabel lokasi
    renderLocationTable();

    // Event tambah lokasi
    document.getElementById('addLocationBtn')?.addEventListener('click', () => {
        const selectEl = document.getElementById('newLocationSelect');
        const newName = selectEl.value;
        const startDate = document.getElementById('newStartDate').value;
        const endDate = document.getElementById('newEndDate').value;
        if (!startDate || !endDate) {
            alert("Tanggal mulai dan selesai harus diisi");
            return;
        }
        if (new Date(startDate) > new Date(endDate)) {
            alert("Tanggal selesai harus setelah atau sama dengan tanggal mulai!");
            return;
        }
        // cek duplikat nama lokasi (optional warning)
        const duplicated = locationsData.some(loc => loc.name.toLowerCase() === newName.toLowerCase());
        if (duplicated) {
            alert(`Lokasi "${newName}" sudah ada dalam daftar. Gunakan nama lain atau kelola jadwal di tabel.`);
            return;
        }
        locationsData.push({
            name: newName,
            start_date: startDate,
            end_date: endDate
        });
        renderLocationTable();
        // optional reset pilihan ke default
        document.getElementById('newStartDate').value = new Date().toISOString().slice(0,10);
        document.getElementById('newEndDate').value = new Date(Date.now() + 7*86400000).toISOString().slice(0,10);
    });

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

    // Reset form
    document.getElementById('resetBtn')?.addEventListener('click', () => {
        if (confirm("Reset semua data campaign? Data lokasi juga akan kembali ke default.")) {
            // reset nama dan deskripsi
            document.getElementById('campaign_name').value = '';
            document.getElementById('ad_description').value = '';
            // reset file
            selectedFile = null;
            previewArea.innerHTML = '';
            fileInput.value = '';
            // reset lokasi ke default tiga kota
            locationsData = [
                { name: "Jakarta Pusat", start_date: "2026-05-10", end_date: "2026-05-25" },
                { name: "Surabaya", start_date: "2026-05-12", end_date: "2026-05-28" },
                { name: "Bandung", start_date: "2026-05-15", end_date: "2026-06-01" }
            ];
            renderLocationTable();
            // reset pilihan add location
            document.getElementById('newStartDate').value = new Date().toISOString().slice(0,10);
            document.getElementById('newEndDate').value = new Date(Date.now() + 7*86400000).toISOString().slice(0,10);
            alert("Form telah direset ke keadaan awal");
        }
    });

    // SUBMIT campaign (simulasi AJAX & validasi)
    const campaignForm = document.getElementById('campaignForm');
    campaignForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const campaignName = document.getElementById('campaign_name').value.trim();
        if (!campaignName) {
            alert("Nama campaign wajib diisi");
            return;
        }
        if (!selectedFile) {
            alert("Harap unggah file media (gambar atau video) untuk iklan");
            return;
        }
        if (locationsData.length === 0) {
            alert("Minimal satu lokasi harus ditambahkan");
            return;
        }
        // validasi tiap jadwal lokasi (tanggal mulai <= selesai)
        for (let i=0; i<locationsData.length; i++) {
            const loc = locationsData[i];
            if (!loc.start_date || !loc.end_date) {
                alert(`Lokasi "${loc.name}" : tanggal mulai dan selesai harus diisi`);
                return;
            }
            if (new Date(loc.start_date) > new Date(loc.end_date)) {
                alert(`Lokasi "${loc.name}" : Tanggal mulai harus <= tanggal selesai`);
                return;
            }
        }
        // Simulasi pengiriman data via FormData (untuk keperluan demo POST ke endpoint /dashboard/campaign/store)
        const formData = new FormData();
        formData.append('_token', document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}');
        formData.append('campaign_name', campaignName);
        formData.append('description', document.getElementById('ad_description').value);
        formData.append('media', selectedFile);
        formData.append('locations', JSON.stringify(locationsData));

        // Proses AJAX (sementara kita gunakan fetch / sweet alert demo, tanpa refresh berat)
        // karena environment blade asli tidak ada endpoint nyata, kita buat notifikasi sukses dan console log.
        // namun menggunakan $.ajax dengan dummy success agar user experience baik.
        // Untuk keperluan demonstrasi, kita akan simulasikan pengiriman sukses karena tidak ada endpoint riil dalam soal, tapi menggunakan alert sukses.
        // Jika ingin integrasi ke backend, ganti url menjadi endpoint nyata.
        
        // ========= DEMO MODE (Endpoint simulasi) =========
        // Karena pada soal hanya frontend + blade dengan asumsi route belum ada, tetapi kita buat feedback yang seamless.
        // Menampilkan pesan sukses + data yang dikirim ke console.
        console.log("Data campaign terkirim (simulasi):", {
            campaign_name: campaignName,
            description: document.getElementById('ad_description').value,
            media_file: selectedFile.name,
            locations: locationsData
        });
        
        // Tampilkan popup modern alert sukses
        alert(`✅ Campaign "${campaignName}" berhasil dibuat!\n\n📌 Lokasi terjadwal: ${locationsData.length} lokasi\n🖼️ Media: ${selectedFile.name}\n\nData tersimpan (simulasi). Untuk implementasi nyta, hubungkan ke endpoint backend.`);
        
        // Optional: reset form setelah sukses jika diperlukan? Biarkan user memutuskan
        if(confirm("Ingin langsung membersihkan form untuk membuat campaign baru?")) {
            document.getElementById('campaign_name').value = '';
            document.getElementById('ad_description').value = '';
            selectedFile = null;
            previewArea.innerHTML = '';
            fileInput.value = '';
            locationsData = [
                { name: "Jakarta Pusat", start_date: "2026-05-10", end_date: "2026-05-25" },
                { name: "Surabaya", start_date: "2026-05-12", end_date: "2026-05-28" },
                { name: "Bandung", start_date: "2026-05-15", end_date: "2026-06-01" }
            ];
            renderLocationTable();
        }
        
        // Jika ingin benar2 mengirim ajax ke server, uncomment kode di bawah tapi sesuaikan endpoint:
        /*
        $.ajax({
            url: "/api/campaign/store",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                alert("Campaign tersimpan! ID: "+res.id);
            },
            error: function(xhr) {
                alert("Gagal menyimpan campaign: " + xhr.responseText);
            }
        });
        */
    });

    // sedikit tweak styling tombol hapus di tabel agar lebih rapih, event listener tambahan untuk menyinkronkan jika perlu
    // trigger change manual untuk konsistensi
    // juga set minimal date agar lebih rapi
    window.addEventListener('load', () => {
        // set default tanggal untuk form tambah lokasi
        const today = new Date().toISOString().slice(0,10);
        const nextWeek = new Date(Date.now() + 7*86400000).toISOString().slice(0,10);
        if(document.getElementById('newStartDate')) document.getElementById('newStartDate').value = today;
        if(document.getElementById('newEndDate')) document.getElementById('newEndDate').value = nextWeek;
    });
</script>
</body>
</html>