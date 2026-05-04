<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard_layouts.head')
    <style>
        .tour-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.3);
            z-index: 9990;
        }

        .tour-highlight {
            position: relative;
            z-index: 9992;
            border-radius: 12px;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.7),
                0 0 20px rgba(59, 130, 246, 0.6);
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, .6);
            }

            70% {
                box-shadow: 0 0 0 12px rgba(59, 130, 246, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0);
            }
        }

        .tour-tooltip {
            position: fixed;
            max-width: 260px;
            background: #fff;
            border-radius: 14px;
            padding: 14px;
            z-index: 9995;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .25);
            font-size: 14px;
            animation: fadeIn .3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .tour-tooltip .tour-buttons {
            margin-top: 10px;
            text-align: right;
        }

        .tour-tooltip button {
            border: none;
            background: #2563eb;
            color: white;
            padding: 6px 10px;
            border-radius: 6px;
            cursor: pointer;
        }

        .tour-arrow {
            position: absolute;
            width: 12px;
            height: 12px;
            background: white;
            transform: rotate(45deg);
        }

        @media(max-width:600px) {
            .tour-tooltip {
                max-width: 200px;
                font-size: 13px;
            }
        }

        .phone-popup {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
        }

        .phone-box {
            background: white;
            padding: 25px;
            border-radius: 16px;
            width: 90%;
            max-width: 380px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            animation: fadeIn .3s ease;
        }

        .phone-box h3 {
            margin-bottom: 10px;
        }

        .phone-box input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-top: 10px;
        }

        .phone-box button {
            margin-top: 15px;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            font-weight: 600;
            cursor: pointer;
        }
    </style>

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
                                        <table>
                                            <th>Lokasi</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th style="width: 60px;">Aksi</th>
                                            </tr>
                                    </thead>
                                    <tbody id="locationTableBody">

                                    </tbody>
                                </table>
                            </div>
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
                            <small style="display: block; margin-top: 12px; color:#475569;">✔ Setiap lokasi bisa
                                memiliki durasi tayang berbeda sesuai kebutuhan campaign</small>
                        </div>

                        <div class="action-buttons">
                            <button type="button" class="btn-secondary" id="resetBtn">Reset Form</button>
                            <button type="submit" class="btn-submit">🚀 Simpan Campaign</button>
                        </div>
                    </form>
                </div>

                <div class="create-ad-card">
                    <h3>Iklan Cepat, Hasil Tepat dan Biaya Murah</h3>
                    <p><b>iklanqu.id</b> <i>The Best Partner For Your Bussines</i></p>
                    <button class="create-ad-button" onclick="alert('Mulai membuat iklan')">
                        <span>+</span> Buat Iklan Sekarang
                    </button>
                </div>

                <div style="margin: 20px 0 12px; font-weight: 600; color: #1e293b;">Pilih format iklan:</div>
                <div class="format-options">
                    <div class="format-card">
                        <div class="emoji">🖼️</div>
                        <h4>Iklan Gambar</h4>
                    </div>
                    <div class="format-card">
                        <div class="emoji">🎥</div>
                        <h4>Iklan Video</h4>
                    </div>
                    <div class="format-card">
                        <div class="emoji">📝</div>
                        <h4>Iklan Teks</h4>
                    </div>
                    <div class="format-card">
                        <div class="emoji">🔄</div>
                        <h4>Karusel</h4>
                    </div>
                </div>

                <div style="background: #eef2ff; border-radius: 20px; padding: 16px; margin: 20px 0;">
                    <p style="color: #1e40af; font-weight: 500;">💡 Tips: Iklan video memiliki engagement 40% lebih
                        tinggi</p>
                </div>
            </div>
        </div>

        @include('dashboard_layouts.nav')
    </div>

    @include('dashboard_layouts.script')
    <script>
        const tourSteps = [{
                element: ".create-ad-button",
                text: "Klik disini untuk mulai membuat iklan baru."
            },
            {
                element: ".format-options",
                text: "Pilih format iklan sesuai kebutuhan bisnis Anda."
            },
            {
                element: ".nav-item.middle-item",
                text: "Menu ini adalah shortcut untuk membuat iklan baru."
            },
            {
                element: ".nav-item.lokasi",
                text: "Menu ini adalah shortcut untuk membuat lokasi baru."
            },
            {
                element: ".nav-item.riwayat",
                text: "Menu ini adalah shortcut untuk membuat riwayat baru."
            },
            {
                element: ".nav-item.pantau",
                text: "Menu ini adalah shortcut untuk membuat pantau baru."
            },
            {
                element: ".nav-item.akun",
                text: "Menu ini adalah shortcut untuk membuat akun baru."
            }
        ];

        let currentStep = 0;
        let tooltip;
        let overlay;

        function startTour() {
            overlay = document.createElement("div");
            overlay.className = "tour-overlay";
            document.body.appendChild(overlay);

            tooltip = document.createElement("div");
            tooltip.className = "tour-tooltip";
            document.body.appendChild(tooltip);

            showStep();
        }

        function showStep() {

            document.querySelectorAll(".tour-highlight")
                .forEach(e => e.classList.remove("tour-highlight"));

            const step = tourSteps[currentStep];
            const el = document.querySelector(step.element);

            if (!el) return;

            el.classList.add("tour-highlight");

            el.scrollIntoView({
                behavior: "smooth",
                block: "center"
            });

            tooltip.innerHTML = `
                ${step.text}
                <div class="tour-buttons">
                    <button onclick="nextStep()">Next</button>
                </div>
            `;

            positionTooltip(el);
        }

        function positionTooltip(el) {

            const rect = el.getBoundingClientRect();
            const spaceTop = rect.top;
            const spaceBottom = window.innerHeight - rect.bottom;
            const spaceLeft = rect.left;
            const spaceRight = window.innerWidth - rect.right;

            let position = "bottom";

            if (spaceBottom > 150) position = "bottom";
            else if (spaceTop > 150) position = "top";
            else if (spaceRight > 200) position = "right";
            else position = "left";

            const tipRect = tooltip.getBoundingClientRect();

            let top, left;

            if (position === "bottom") {
                top = rect.bottom + 10;
                left = rect.left + (rect.width / 2) - (tipRect.width / 2);
            }

            if (position === "top") {
                top = rect.top - tipRect.height - 10;
                left = rect.left + (rect.width / 2) - (tipRect.width / 2);
            }

            if (position === "right") {
                top = rect.top + (rect.height / 2) - (tipRect.height / 2);
                left = rect.right + 10;
            }

            if (position === "left") {
                top = rect.top + (rect.height / 2) - (tipRect.height / 2);
                left = rect.left - tipRect.width - 10;
            }

            tooltip.style.top = `${top}px`;
            tooltip.style.left = `${left}px`;

            createArrow(position);
        }

        function createArrow(position) {

            let arrow = document.createElement("div");
            arrow.className = "tour-arrow";

            tooltip.appendChild(arrow);

            if (position === "bottom") {
                arrow.style.top = "-6px";
                arrow.style.left = "50%";
            }

            if (position === "top") {
                arrow.style.bottom = "-6px";
                arrow.style.left = "50%";
            }

            if (position === "left") {
                arrow.style.right = "-6px";
                arrow.style.top = "50%";
            }

            if (position === "right") {
                arrow.style.left = "-6px";
                arrow.style.top = "50%";
            }
        }

        function nextStep() {
            currentStep++;

            if (currentStep >= tourSteps.length) {
                endTour();
                return;
            }

            showStep();
        }

        function endTour() {
            tooltip.remove();
            overlay.remove();

            document.querySelectorAll(".tour-highlight")
                .forEach(e => e.classList.remove("tour-highlight"));

            showPhonePopup();
        }

        function showPhonePopup() {

            let popup = document.createElement("div");
            popup.className = "phone-popup";

            popup.innerHTML = `
        <div class="phone-box">
            <h3>Masukkan Nomor WhatsApp</h3>
            <p>Nomor ini akan digunakan untuk notifikasi iklan Anda</p>

            <input type="tel" id="phone_number" placeholder="08xxxxxxxxxx">

            <button onclick="savePhone()">Simpan</button>
        </div>
    `;

            document.body.appendChild(popup);
        }

        function savePhone() {

            let phone = document.getElementById("phone_number").value;

            if (phone.length < 10) {
                alert("Nomor tidak valid");
                return;
            }

            $.ajax({
                url: "/dashboard/tutorial/selesai",
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    'no_wa': $("#phone_number").val()
                },
                success: function(res) {
                    document.querySelector(".phone-popup").remove();
                    alert("Nomor berhasil disimpan");
                },
                error: function() {
                    console.log("Gagal update tutorial");
                }
            });
        }

        const userTutorial = {{ $user->tutorial }};
        window.addEventListener("load", function() {
            if (userTutorial === 0) {
                setTimeout(() => {
                    startTour();
                }, 800);
            }

        });
    </script>
</body>

</html>
