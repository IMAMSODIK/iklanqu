$(document).ready(function () {
    $('#tableClient').DataTable({
        responsive: true,
        autoWidth: false
    });

    $(document).on('click', '.hapus', function () {

        let id = $(this).data('id');

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Pesan tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        })
            .then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "/get-in-touch/delete",
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

    $(document).on("click", ".hubungi", function () {

        let nomor = $(this).data("id");
        let nama = $(this).data("nama");

        nomor = nomor.replace(/[^0-9]/g, '');

        if (nomor.startsWith("0")) {
            nomor = "62" + nomor.substring(1);
        }

        let pesan = encodeURIComponent("Halo " + nama + ", saya Admin dari IklanQu.");

        window.open("https://wa.me/" + nomor + "?text=" + pesan, "_blank");

    });
});