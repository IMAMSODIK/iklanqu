<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard_layouts.head')
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

        <div class="modal fade" id="modalDetailIklan" tabindex="-1">

            <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down">

                <div class="modal-content border-0">

                    <div class="modal-header">

                        <h5 class="modal-title">
                            Detail Iklan
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        <div id="detailContent"></div>

                    </div>

                </div>

            </div>

        </div>

        @include('dashboard_layouts.nav')
    </div>

    @include('dashboard_layouts.script')
    <script>
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

        $(document).on('click', '.iklan-item', function() {

            let name = $(this).data('name');
            let description = $(this).data('description');
            let media = $(this).data('media');
            let total = $(this).data('total');
            let status = $(this).data('status');
            let payment = $(this).data('payment');
            let paid = $(this).data('paid');

            let statusBadge = '';

            if (status == 'paid') {

                statusBadge = `
            <span class="badge bg-success">
                Paid
            </span>
        `;

            } else if (status == 'pending') {

                statusBadge = `
            <span class="badge bg-warning">
                Pending
            </span>
        `;

            } else {

                statusBadge = `
            <span class="badge bg-danger">
                Failed
            </span>
        `;
            }

            let mediaHtml = `
        <div class="text-muted">
            Tidak ada media
        </div>
    `;

            if (media) {

                if (
                    media.includes('.jpg') ||
                    media.includes('.jpeg') ||
                    media.includes('.png') ||
                    media.includes('.webp')
                ) {

                    mediaHtml = `
                <img src="${media}"
                     class="img-fluid rounded shadow-sm"
                     style="width:100%; max-height:300px; object-fit:cover;">
            `;

                } else if (
                    media.includes('.mp4') ||
                    media.includes('.mov') ||
                    media.includes('.avi')
                ) {

                    mediaHtml = `
                <video controls
                       class="w-100 rounded shadow-sm"
                       style="max-height:300px;">
                    <source src="${media}">
                </video>
            `;
                }
            }

            let html = `

        <div class="mb-4">

            <div class="d-flex justify-content-between align-items-start mb-3">

                <div>

                    <h4 class="fw-bold mb-1">
                        ${name}
                    </h4>

                    <div class="text-muted">
                        ${description ?? '-'}
                    </div>

                </div>

                ${statusBadge}

            </div>

            <div class="mb-4">

                ${mediaHtml}

            </div>

            <div class="row g-3">

                <div class="col-md-6">

                    <div class="border rounded p-3 h-100">

                        <div class="fw-bold mb-3">
                            Informasi Pembayaran
                        </div>

                        <table class="table table-borderless table-sm mb-0">

                            <tr>
                                <td width="140">
                                    <b>Total</b>
                                </td>

                                <td>
                                    Rp ${total}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b>Metode</b>
                                </td>

                                <td>
                                    ${payment ?? '-'}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b>Status</b>
                                </td>

                                <td>
                                    ${statusBadge}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b>Waktu Bayar</b>
                                </td>

                                <td>
                                    ${paid ? formatTanggal(paid) : '-'}
                                </td>
                            </tr>

                        </table>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="border rounded p-3 h-100">

                        <div class="fw-bold mb-3">
                            Informasi Iklan
                        </div>

                        <table class="table table-borderless table-sm mb-0">

                            <tr>
                                <td width="120">
                                    <b>Nama</b>
                                </td>

                                <td>
                                    ${name}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b>Status</b>
                                </td>

                                <td>
                                    ${status}
                                </td>
                            </tr>

                        </table>

                    </div>

                </div>

            </div>

        </div>
    `;

            $('#detailContent').html(html);

            $('#modalDetailIklan').modal('show');

        });
    </script>
</body>

</html>
