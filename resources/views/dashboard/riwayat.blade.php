<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard_layouts.head')
    <style>

.custom-modal{
    position: fixed;
    inset: 0;
    background: rgba(15,23,42,0.65);
    backdrop-filter: blur(4px);
    z-index: 99999;

    display: none;
    align-items: center;
    justify-content: center;

    padding: 20px;
}

.custom-modal.show{
    display: flex;
}

.custom-modal-content{
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

@keyframes modalShow{
    from{
        opacity: 0;
        transform: translateY(20px) scale(.96);
    }
    to{
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.custom-modal-header{
    padding: 20px 24px;
    border-bottom: 1px solid #e2e8f0;

    display: flex;
    align-items: center;
    justify-content: space-between;
}

.custom-modal-header h3{
    margin: 0;
    font-size: 20px;
    font-weight: 700;
}

.close-modal{
    border: none;
    background: #f1f5f9;

    width: 38px;
    height: 38px;

    border-radius: 10px;

    cursor: pointer;

    font-size: 16px;
}

.custom-modal-body{
    padding: 24px;
    overflow-y: auto;
}

.detail-grid{
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
}

.detail-box{
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 18px;
}

.detail-title{
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 14px;
}

.info-table{
    width: 100%;
    border-collapse: collapse;
}

.info-table td{
    padding: 7px 0;
    vertical-align: top;
    font-size: 14px;
}

.media-preview img,
.media-preview video{
    width: 100%;
    border-radius: 16px;
    max-height: 320px;
    object-fit: cover;
}

.status-badge{
    padding: 7px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    color: white;
}

.status-paid{
    background: #16a34a;
}

.status-pending{
    background: #f59e0b;
}

.status-failed{
    background: #dc2626;
}

.lokasi-item{
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 12px;
    margin-bottom: 12px;
}

@media(max-width:768px){

    .custom-modal{
        padding: 0;
    }

    .custom-modal-content{
        max-width: 100%;
        height: 100vh;
        max-height: 100vh;
        border-radius: 0;
    }

    .custom-modal-body{
        padding: 16px;
    }

    .detail-grid{
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

                            <div class="card-item iklan-item" data-id="{{ $item->id }}"
                                data-name="{{ $item->name }}" data-description="{{ $item->description }}"
                                data-media="{{ asset('storage/' . $item->media) }}"
                                data-total="{{ number_format($item->total_price, 0, ',', '.') }}"
                                data-status="{{ $item->payment_status }}" data-payment="{{ $item->payment_method }}"
                                data-paid="{{ $item->paid_at }}">

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

                                <span
                                    class="badge
                @if ($item->payment_status == 'paid') bg-success
                @elseif($item->payment_status == 'pending')
                    bg-warning
                @else
                    bg-danger @endif
            ">
                                    {{ ucfirst($item->payment_status) }}
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

function formatTanggal(dateString){

    if(!dateString) return '-';

    const date = new Date(dateString);

    return date.toLocaleDateString('id-ID', {
        weekday: 'long',
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    });

}

function hitungDurasi(startDate, endDate){

    const start = new Date(startDate);
    const end = new Date(endDate);

    const diffTime = end - start;

    return Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
}

$(document).on('click', '.iklan-item', function(){

    let item = $(this).data('item');

});

$(document).on('click', '.iklan-item', function(){

    let data = $(this).data();

    let badgeClass = 'status-pending';

    if(data.status == 'paid'){
        badgeClass = 'status-paid';
    }

    if(data.status == 'failed'){
        badgeClass = 'status-failed';
    }

    let mediaHtml = `
        <div>Tidak ada media</div>
    `;

    if(data.media){

        if(
            data.media.includes('.jpg') ||
            data.media.includes('.jpeg') ||
            data.media.includes('.png') ||
            data.media.includes('.webp')
        ){

            mediaHtml = `
                <img src="${data.media}">
            `;

        } else {

            mediaHtml = `
                <video controls>
                    <source src="${data.media}">
                </video>
            `;
        }
    }

    let html = `

        <div class="media-preview mb-4">
            ${mediaHtml}
        </div>

        <div style="display:flex; justify-content:space-between; align-items:start; gap:12px; margin-bottom:20px;">

            <div>

                <h2 style="margin-bottom:8px;">
                    ${data.name}
                </h2>

                <div style="color:#64748b;">
                    ${data.description ?? '-'}
                </div>

            </div>

            <div class="status-badge ${badgeClass}">
                ${data.status}
            </div>

        </div>

        <div class="detail-grid">

            <div class="detail-box">

                <div class="detail-title">
                    Informasi Pembayaran
                </div>

                <table class="info-table">

                    <tr>
                        <td width="130">
                            <b>Total</b>
                        </td>

                        <td>
                            Rp ${data.total}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b>Metode</b>
                        </td>

                        <td>
                            ${data.payment ?? '-'}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b>Waktu Bayar</b>
                        </td>

                        <td>
                            ${data.paid ? formatTanggal(data.paid) : '-'}
                        </td>
                    </tr>

                </table>

            </div>

            <div class="detail-box">

                <div class="detail-title">
                    Informasi Iklan
                </div>

                <table class="info-table">

                    <tr>
                        <td width="130">
                            <b>Nama</b>
                        </td>

                        <td>
                            ${data.name}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b>Status</b>
                        </td>

                        <td>
                            ${data.status}
                        </td>
                    </tr>

                </table>

            </div>

        </div>
    `;

    $('#detailContent').html(html);

    $('#detailModal').addClass('show');

});

$('#closeModal').click(function(){

    $('#detailModal').removeClass('show');

});

$('#detailModal').click(function(e){

    if(e.target === this){
        $('#detailModal').removeClass('show');
    }

});

</script>
</body>

</html>
