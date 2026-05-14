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
                                <div><b>Lokasi:</b> ${lok.lokasi?.name ?? '-'}</div>
                                <div>
                                    <b>Tanggal:</b>
                                    ${lok.tanggal_mulai}
                                    s/d
                                    ${lok.tanggal_selesai}
                                </div>
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
                                            ${item.created_at}
                                        </small>
                                    </div>
                                    ${statusBadge}
                                </div>
                                <div class="mb-3">
                                    ${item.description ?? '-'}
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-2">
                                            <b>Total Pembayaran:</b>
                                            Rp ${parseInt(item.total_price).toLocaleString()}
                                        </div>
                                        <div class="mb-2">
                                            <b>Metode:</b>
                                            ${item.payment_method ?? '-'}
                                        </div>
                                        <div class="mb-2">
                                            <b>Waktu Bayar:</b>
                                            ${item.paid_at ?? '-'}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        ${lokasi}
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