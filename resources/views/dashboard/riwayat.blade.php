<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard_layouts.head')
    <style>
        .status-badge {
            padding: 7px 14px;
            border-radius: 999px;

            font-size: 12px;
            font-weight: 600;

            color: white;

            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .status-paid {
            background: #16a34a;
        }

        .status-pending {
            background: #f59e0b;
        }

        .status-failed {
            background: #dc2626;
        }
    </style>
    <style>
        .custom-modal {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(4px);
            z-index: 99999;

            display: none;
            align-items: center;
            justify-content: center;

            padding: 20px;
        }

        .custom-modal.show {
            display: flex;
        }

        .custom-modal-content {
            width: 100%;
            max-width: 950px;
            max-height: 92vh;

            background: #fff;
            border-radius: 24px;

            overflow: hidden;

            display: flex;
            flex-direction: column;

            animation: modalShow .25s ease;
        }

        @keyframes modalShow {
            from {
                opacity: 0;
                transform: translateY(20px) scale(.96);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .custom-modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e2e8f0;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .custom-modal-header h3 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
        }

        .close-modal {
            border: none;
            background: #f1f5f9;

            width: 38px;
            height: 38px;

            border-radius: 10px;

            cursor: pointer;

            font-size: 16px;
        }

        .custom-modal-body {
            padding: 24px;
            overflow-y: auto;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .detail-box {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 18px;
        }

        .detail-title {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 7px 0;
            vertical-align: top;
            font-size: 14px;
        }

        .media-preview {
            display: flex;
            justify-content: center;
            align-items: center;

            background: #f8fafc;
            border-radius: 20px;
            overflow: hidden;

            max-height: 420px;
        }

        .media-preview img {
            width: 100%;
            max-height: 420px;
            object-fit: contain;
        }

        .media-preview video {
            width: auto;
            max-width: 100%;
            max-height: 420px;
            object-fit: contain;
            background: black;
        }

        .status-badge {
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            color: white;
        }

        .status-paid {
            background: #16a34a;
        }

        .status-pending {
            background: #f59e0b;
        }

        .status-failed {
            background: #dc2626;
        }

        .lokasi-item {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 12px;
        }

        @media(max-width:768px) {

            .custom-modal {
                padding: 0;
            }

            .custom-modal-content {
                max-width: 100%;
                height: 100vh;
                max-height: 100vh;
                border-radius: 0;
            }

            .custom-modal-body {
                padding: 16px;
            }

            .detail-grid {
                grid-template-columns: 1fr;
            }

        }
    </style>
</head>

<body>
    <input type="hidden" id="page" value="riwayat">
    <div class="app-container">
        @include('dashboard_layouts.header')

        <div class="content-area" id="content-area">
            <!-- Halaman Daftar Lokasi -->
            <div class="page" id="page-riwayat">
                <div class="page-header">
                    <div class="page-title">Riwayat Iklan</div>
                    <div class="page-subtitle">Iklan yang sudah tayang</div>
                </div>
                <div class="card">
                    <div class="card riwayat-wrapper">

                        @forelse ($riwayat as $item)

                            @php

                                $lokasiPertama = $item->lokasiKampanyeIklans->first();

                                $tanggalMulai = optional($lokasiPertama)->tanggal_mulai;
                                $tanggalSelesai = optional($lokasiPertama)->tanggal_selesai;

                            @endphp

                            <div class="card-item iklan-item" data-id="{{ $item->id }}">

                                <div class="item-icon">

                                    @if ($item->media)
                                        @php
                                            $ext = pathinfo($item->media, PATHINFO_EXTENSION);
                                        @endphp

                                        @if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp']))
                                            🖼️
                                        @elseif(in_array($ext, ['mp4', 'mov', 'avi']))
                                            🎥
                                        @else
                                            📁
                                        @endif
                                    @else
                                        📺
                                    @endif

                                </div>

                                <div class="item-info">

                                    <h4>
                                        {{ $item->name }}
                                    </h4>

                                    <p>

                                        {{ $tanggalMulai ? \Carbon\Carbon::parse($tanggalMulai)->translatedFormat('d M Y') : '-' }}

                                        -

                                        {{ $tanggalSelesai ? \Carbon\Carbon::parse($tanggalSelesai)->translatedFormat('d M Y') : '-' }}

                                    </p>

                                </div>

                                @php

                                    $statusClass = match ($item->payment_status) {
                                        'paid' => 'status-paid',
                                        'pending' => 'status-pending',
                                        'failed' => 'status-failed',
                                        default => 'status-pending',
                                    };

                                    $statusText = match ($item->payment_status) {
                                        'paid' => 'Sudah Bayar',
                                        'pending' => 'Menunggu Pembayaran',
                                        'failed' => 'Gagal',
                                        default => 'Menunggu Pembayaran',
                                    };

                                @endphp

                                <span class="status-badge {{ $statusClass }}">
                                    {{ $statusText }}
                                </span>

                            </div>

                        @empty

                            <div class="text-center py-5 text-muted">
                                Belum ada riwayat iklan
                            </div>

                        @endforelse

                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL DETAIL -->
        <div class="custom-modal" id="detailModal">

            <div class="custom-modal-content">

                <div class="custom-modal-header">

                    <div>
                        <h3>Detail Iklan</h3>
                    </div>

                    <button class="close-modal" id="closeModal">
                        ✕
                    </button>

                </div>

                <div class="custom-modal-body" id="detailContent">

                </div>

            </div>

        </div>

        @include('dashboard_layouts.nav')
    </div>

    @include('dashboard_layouts.script')
    <script>
        function formatStatus(status) {

            const statuses = {
                paid: 'Sudah Bayar',
                pending: 'Menunggu Pembayaran',
                failed: 'Gagal'
            };

            return statuses[status] ?? status;
        }

        function formatTanggal(dateString) {

            if (!dateString) return '-';

            const date = new Date(dateString);

            return date.toLocaleDateString('id-ID', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });

        }

        function formatMetodePembayaran(method) {

            if (!method) return '-';

            const methods = {

                bank_transfer: 'Transfer Bank',
                bca_va: 'BCA Virtual Account',
                bni_va: 'BNI Virtual Account',
                bri_va: 'BRI Virtual Account',
                permata_va: 'Permata Virtual Account',

                credit_card: 'Kartu Kredit',
                gopay: 'GoPay',
                shopeepay: 'ShopeePay',
                qris: 'QRIS',

                cstore: 'Convenience Store',
                alfamart: 'Alfamart',
                indomaret: 'Indomaret',

                echannel: 'Mandiri Bill',
                danamon_online: 'Danamon Online',
                akulaku: 'Akulaku',
                kredivo: 'Kredivo',

                bca_klikpay: 'BCA KlikPay',
                bca_klikbca: 'KlikBCA',
                mandiri_clickpay: 'Mandiri ClickPay',

                paypal: 'PayPal'
            };

            return methods[method] ?? method
                .replaceAll('_', ' ')
                .replace(/\b\w/g, l => l.toUpperCase());
        }

        function hitungDurasi(startDate, endDate) {

            const start = new Date(startDate);
            const end = new Date(endDate);

            const diffTime = end - start;

            return Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
        }

        function renderMedia(media) {

            if (!media) {

                return `
            <div class="text-muted">
                Tidak ada media
            </div>
        `;
            }

            let fileUrl = `/storage/${media}`;

            let ext = media.split('.').pop().toLowerCase();

            let imageExt = ['jpg', 'jpeg', 'png', 'webp'];

            let videoExt = ['mp4', 'mov', 'avi'];

            if (imageExt.includes(ext)) {

                return `
            <img src="${fileUrl}">
        `;

            } else if (videoExt.includes(ext)) {

                return `
            <video controls>
                <source src="${fileUrl}">
            </video>
        `;
            }

            return `
        <a href="${fileUrl}" target="_blank">
            Lihat File
        </a>
    `;
        }

        $(document).on('click', '.iklan-item', function() {

            let id = $(this).data('id');

            $('#detailModal').addClass('show');

            $('#detailContent').html(`
        <div style="
            padding:40px;
            text-align:center;
        ">
            Loading...
        </div>
    `);

            $.ajax({

                url: '/riwayat/detail/' + id,
                type: 'GET',

                success: function(res) {

                    let item = res.data;

                    let badgeClass = 'status-pending';

                    if (item.payment_status == 'paid') {
                        badgeClass = 'status-paid';
                    }

                    if (item.payment_status == 'failed') {
                        badgeClass = 'status-failed';
                    }

                    let lokasiHtml = '';

                    item.lokasi_kampanye_iklans.forEach((lok) => {

                        lokasiHtml += `

                    <div class="lokasi-item">

                        <table class="info-table">

                            <tr>
                                <td width="120">
                                    <b>Lokasi</b>
                                </td>

                                <td>
                                    ${lok.lokasi?.nama ?? '-'}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b>Mulai</b>
                                </td>

                                <td>
                                    ${formatTanggal(lok.tanggal_mulai)}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b>Selesai</b>
                                </td>

                                <td>
                                    ${formatTanggal(lok.tanggal_selesai)}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b>Durasi</b>
                                </td>

                                <td>
                                    ${hitungDurasi(
                                        lok.tanggal_mulai,
                                        lok.tanggal_selesai
                                    )} Hari
                                </td>
                            </tr>

                        </table>

                    </div>
                `;
                    });

                    let html = `

                <div class="media-preview mb-4">

                    ${renderMedia(item.media)}

                </div>

                <div style="
                    display:flex;
                    justify-content:space-between;
                    align-items:start;
                    gap:12px;
                    margin-bottom:20px;
                    flex-wrap:wrap;
                ">

                    <div>

                        <h2 style="
                            margin-bottom:8px;
                            font-size:24px;
                            font-weight:700;
                        ">
                            ${item.name}
                        </h2>

                        <div style="
                            color:#64748b;
                            line-height:1.7;
                        ">
                            ${item.description ?? '-'}
                        </div>

                    </div>

                    <div class="status-badge ${badgeClass}">
                        ${formatStatus(item.payment_status)}
                    </div>

                </div>

                <div class="detail-grid">

                    <!-- PEMBAYARAN -->
                    <div class="detail-box">

                        <div class="detail-title">
                            Informasi Pembayaran
                        </div>

                        <table class="info-table">

                            <tr>
                                <td width="140">
                                    <b>Total</b>
                                </td>

                                <td>
                                    Rp ${parseInt(item.total_price).toLocaleString()}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b>Metode</b>
                                </td>

                                <td>
                                    ${formatMetodePembayaran(item.payment_method)}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b>Status</b>
                                </td>

                                <td>
                                    ${item.payment_status}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b>Waktu Bayar</b>
                                </td>

                                <td>
                                    ${item.paid_at
                                        ? formatTanggal(item.paid_at)
                                        : '-'}
                                </td>
                            </tr>

                        </table>

                    </div>

                    <!-- INFORMASI CAMPAIGN -->
                    <div class="detail-box">

                        <div class="detail-title">
                            Informasi Campaign
                        </div>

                        <table class="info-table">

                            <tr>
                                <td width="140">
                                    <b>Nama</b>
                                </td>

                                <td>
                                    ${item.name}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b>Dibuat</b>
                                </td>

                                <td>
                                    ${formatTanggal(item.created_at)}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b>Status</b>
                                </td>

                                <td>
                                    ${item.is_active ? 'Aktif' : 'Tidak Aktif'}
                                </td>
                            </tr>

                        </table>

                    </div>

                </div>

                <!-- LOKASI -->
                <div class="detail-box" style="margin-top:18px;">

                    <div class="detail-title">
                        Lokasi Penayangan
                    </div>

                    ${lokasiHtml}

                </div>

            `;

                    $('#detailContent').html(html);

                },

                error: function() {

                    $('#detailContent').html(`
                <div style="
                    padding:40px;
                    text-align:center;
                    color:red;
                ">
                    Gagal memuat detail iklan
                </div>
            `);

                }

            });

        });

        $('#closeModal').click(function() {

            $('#detailModal').removeClass('show');

        });

        $('#detailModal').click(function(e) {

            if (e.target === this) {
                $('#detailModal').removeClass('show');
            }

        });
    </script>
</body>

</html>
