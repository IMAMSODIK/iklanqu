function renderMedia(media) {
    if (!media) {
        return `
            <div class="text-muted">
                Tidak ada media
            </div>
        `;
    }

    let fileUrl = `/storage/${media}`;
    let extension = media.split('.').pop().toLowerCase();
    let imageExt = ['jpg', 'jpeg', 'png', 'webp'];
    let videoExt = ['mp4', 'mov', 'avi'];

    if (imageExt.includes(extension)) {
        return `
            <img src="${fileUrl}"
                 class="img-fluid rounded shadow-sm"
                 style="max-height:250px; width:100%; object-fit:cover;">
        `;
    } else if (videoExt.includes(extension)) {
        return `
            <video controls
                   class="w-100 rounded shadow-sm"
                   style="max-height:300px;">
                <source src="${fileUrl}">
            </video>
        `;
    }

    return `
        <a href="${fileUrl}" target="_blank" class="btn btn-sm btn-primary">
            Lihat File
        </a>
    `;
}

function formatTanggal(dateString) {
    const date = new Date(dateString);

    return date.toLocaleDateString('id-ID', {
        weekday: 'long',
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    });
}

function hitungDurasi(startDate, endDate) {
    const start = new Date(startDate);
    const end = new Date(endDate);
    const diffTime = end - start;
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

    return diffDays;
}

function formatStatus(status){

    const statuses = {
        paid: 'Lunas',
        pending: 'Menunggu',
        failed: 'Gagal'
    };

    return statuses[status] ?? status;
}

function formatMetodePembayaran(method){

    if(!method) return '-';

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
    };

    return methods[method] ?? method
        .replaceAll('_', ' ')
        .replace(/\b\w/g, l => l.toUpperCase());
}

$(document).ready(function () {
    $('#tableClient').DataTable({
        responsive: true,
        autoWidth: false
    });

    $(document).on('click', '.hapus', function () {

        let id = $(this).data('id');

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data client tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        })
            .then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "/client/delete",
                        type: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            id: id
                        },

                        success: function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            });

                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        },

                        error: function (xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: xhr.responseJSON?.message ??
                                    "Terjadi kesalahan"
                            });
                        }
                    });

                }

            });

    });

    $(document).on('click', '.detail-iklan', function () {

    let id = $(this).data('id');

    $('#modalDetailIklan').modal('show');

    $('#listIklan').html(`
        <div class="text-center py-5">
            Loading...
        </div>
    `);

    $.ajax({

        url: '/client/detail-iklan/' + id,
        type: 'GET',

        success: function (res) {

            let html = '';

            if (res.data.length == 0) {

                html = `
                    <div class="alert alert-danger">
                        Belum ada iklan
                    </div>
                `;

            } else {

                res.data.forEach((item) => {

                    let badgeClass = '';

                    if(item.payment_status == 'paid'){
                        badgeClass = 'status-paid';
                    } else if(item.payment_status == 'pending'){
                        badgeClass = 'status-pending';
                    } else {
                        badgeClass = 'status-failed';
                    }

                    let statusBadge = `
                        <div class="status-badge ${badgeClass}">
                            ${formatStatus(item.payment_status)}
                        </div>
                    `;

                    let lokasi = '';

                    item.lokasi_kampanye_iklans.forEach((lok, index) => {

                        lokasi += `

                            <div style="
                                border:1px solid #e5e7eb;
                                border-radius:14px;
                                padding:14px;
                                margin-bottom:14px;
                                background:#fafafa;
                            ">

                                <div style="
                                    display:flex;
                                    align-items:center;
                                    justify-content:space-between;
                                    margin-bottom:12px;
                                    gap:10px;
                                    flex-wrap:wrap;
                                ">

                                    <div style="
                                        font-weight:700;
                                        color:#111827;
                                        font-size:14px;
                                    ">
                                        Lokasi ${index + 1}
                                    </div>

                                    <div style="
                                        padding:5px 12px;
                                        border-radius:999px;
                                        background:#eff6ff;
                                        color:#2563eb;
                                        font-size:12px;
                                        font-weight:600;
                                    ">
                                        ${hitungDurasi(
                                            lok.tanggal_mulai,
                                            lok.tanggal_selesai
                                        )} Hari
                                    </div>

                                </div>

                                <table class="table table-borderless table-sm mb-0">

                                    <tr>
                                        <td>
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

                                </table>

                            </div>

                        `;
                    });

                    html += `

                        <div class="card shadow-sm border-0 mb-4">

                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-start mb-3">

                                    <div>

                                        <h5 class="mb-1 fw-bold">
                                            ${item.name}
                                        </h5>

                                        <small class="text-muted">
                                            Dibuat:
                                            ${formatTanggal(item.created_at)}
                                        </small>

                                    </div>

                                    ${statusBadge}

                                </div>

                                <div class="mb-3">

                                    ${item.description ?? '-'}

                                </div>

                                <div class="mb-4">

                                    ${renderMedia(item.media)}

                                </div>

                                <div class="row">

                                    <!-- INFORMASI PEMBAYARAN -->
                                    <div class="col-md-6">

                                        <div class="border rounded h-100">

                                            <div class="fw-bold mb-3">
                                                Informasi Pembayaran
                                            </div>

                                            <table class="table table-borderless table-sm mb-0">

                                                <tr>
                                                    <td>
                                                        <b>Total</b>
                                                    </td>

                                                    <td>
                                                        Rp ${parseInt(
                                                            item.total_price
                                                        ).toLocaleString()}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <b>Metode</b>
                                                    </td>

                                                    <td>
                                                        ${formatMetodePembayaran(
                                                            item.payment_method
                                                        )}
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
                                                        ${item.paid_at
                                                            ? formatTanggal(item.paid_at)
                                                            : '-'}
                                                    </td>
                                                </tr>

                                            </table>

                                        </div>

                                    </div>

                                    <!-- INFORMASI LOKASI -->
                                    <div class="col-md-6">

                                        <div class="border rounded h-100">

                                            <div class="fw-bold mb-3">
                                                Lokasi Penayangan
                                            </div>

                                            ${lokasi}

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    `;
                });
            }

            $('#listIklan').html(html);

        },

        error: function () {

            $('#listIklan').html(`
                <div class="alert alert-danger">
                    Gagal memuat data iklan
                </div>
            `);

        }

    });

});
});