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
</head>

<body>
    {{dd($user)}}
    <input type="hidden" id="page" value="buat">
    <div class="app-container">
        @include('dashboard_layouts.header')

        <div class="content-area" id="content-area">
            <div class="page active-page" id="page-buat">
                <div class="page-header">
                    <div class="page-title">Buat Iklan Baru</div>
                    <div class="page-subtitle">Mulai kampanye iklan Anda</div>
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

            showPhonePopup(); // tampilkan popup setelah tutorial
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

            console.log("Nomor disimpan:", phone);

            document.querySelector(".phone-popup").remove();

            alert("Nomor berhasil disimpan");
        }

        window.addEventListener("load", function() {
            setTimeout(() => {
                startTour();
            }, 800);
        });
    </script>
</body>

</html>
