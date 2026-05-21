
// $('#tableVerifikasi').DataTable({
//     responsive: true,
//     autoWidth: false
// });

// $('#tableHistory').DataTable({
//     responsive: true,
//     autoWidth: false
// });

$(document).on('click', '.btn-verifikasi', function () {

    const button = $(this);
    const id = button.data('id');

    Swal.fire({
        title: 'Verifikasi Iklan?',
        text: 'Iklan akan diaktifkan setelah diverifikasi',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Verifikasi',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#16a34a',
        cancelButtonColor: '#d33'
    }).then((result) => {

        if (!result.isConfirmed) {
            return;
        }

        const originalText = button.html();

        button.prop('disabled', true);

        button.html(`
                <span class="spinner-border spinner-border-sm"></span>
                Loading...
            `);

        $.ajax({
            url: `/verifikasi/${id}`,
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
            },

            success: function (result) {

                if (result.success) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: result.message,
                        timer: 1800,
                        showConfirmButton: false
                    });

                    const row = $(`#row-${id}`);

                    row.css({
                        transition: 'all 0.3s ease',
                        opacity: '0',
                        transform: 'translateX(20px)'
                    });

                    setTimeout(() => {
                        row.remove();
                    }, 300);

                } else {

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: result.message
                    });

                    button.prop('disabled', false);
                    button.html(originalText);

                }

            },

            error: function () {

                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Server gagal memproses permintaan'
                });

                button.prop('disabled', false);
                button.html(originalText);

            }

        });

    });

});