function renderMedia(media){
    if(!media){
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

    if(imageExt.includes(extension)){
        return `
            <img src="${fileUrl}"
                 class="img-fluid rounded shadow-sm"
                 style="max-height:250px; width:100%; object-fit:cover;">
        `;
    } else if(videoExt.includes(extension)) {
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

function formatTanggal(dateString){
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
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

    return diffDays;
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
                    res.data.forEach((item, index) => {
                        let statusBadge = '';
                        if (item.payment_status == 'paid') {
                            statusBadge = `<span class="badge bg-success">Paid</span>`;
                        } else if (item.payment_status == 'pending') {
                            statusBadge = `<span class="badge bg-warning">Pending</span>`;
                        } else {
                            statusBadge = `<span class="badge bg-danger">Failed</span>`;
                        }
                        let lokasi = '';
                        item.lokasi_kampanye_iklans.forEach((lok) => {
                            lokasi += `
                            <div class="border rounded p-2 mb-2">
                                <table>
                                    <tr>
                                        <td><b>Nama Lokasi</b></td>
                                        <td>: ${lok.lokasi?.nama ?? '-'}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Tanggal Mulai</b></td>
                                        <td>: ${formatTanggal(lok.tanggal_mulai)}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Tanggal Selesai</b></td>
                                        <td>: ${formatTanggal(lok.tanggal_selesai)}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Durasi</b></td>
                                        <td>: ${hitungDurasi(lok.tanggal_mulai, lok.tanggal_selesai)}</td>
                                    </tr>
                                </table>
                            </div>
                        `;
                        });

                        html += `
                        <div class="card shadow-sm mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h5 class="mb-1">${item.name}</h5>
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
                                <div class="mb-3">
                                    ${renderMedia(item.media)}
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <table>
                                            <tr>
                                                <td><b>Total Pembayaran</b></td>
                                                <td>: Rp ${parseInt(item.total_price).toLocaleString()}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Waktu Bayar</b></td>
                                                <td>: ${item.paid_at ?? '-'}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    });
                }

                $('#listIklan').html(html);
            }
        });

    });
});