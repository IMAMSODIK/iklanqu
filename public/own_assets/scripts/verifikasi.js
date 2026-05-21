
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

    if (!confirm('Apakah yakin ingin memverifikasi iklan ini?')) {
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

                alert(result.message);

                button.prop('disabled', false);
                button.html(originalText);

            }

        },

        error: function () {

            alert('Terjadi kesalahan');

            button.prop('disabled', false);
            button.html(originalText);

        }
    });

});