$(document).ready(function () {
    $('#tableClient').DataTable({
        responsive: true,
        autoWidth: false
    });

    $('#tableSelectUser').DataTable({
        responsive: true,
        autoWidth: false
    });

    $(document).on('click', '.hapus', function () {

        let id = $(this).data('id');

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data user tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        })
            .then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "/user/delete",
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

    $(document).on('click', '.pilih', function () {

        let id = $(this).data('id');

        Swal.fire({
            title: 'Konfirmasi Pilihan?',
            text: "Pengguna ini akan menjadi verifikator!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Lanjut',
            cancelButtonText: 'Batal'
        })
            .then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "/user/update",
                        type: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            id: id,
                            role: 'verifikator'
                        },

                        success: function (response) {
                            $("#modalTambahUser").modal("hide");

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

    $(document).on('click', '.reset', function () {

        let id = $(this).data('id');

        Swal.fire({
            title: 'Konfirmasi Pilihan?',
            text: "Pengguna ini akan menjadi user!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Lanjut',
            cancelButtonText: 'Batal'
        })
            .then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "/user/update",
                        type: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            id: id,
                            role: 'user'
                        },

                        success: function (response) {
                            $("#modalTambahUser").modal("hide");

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

    $("#tambah-data").on("click", function () {
        $("#modalTambahUser").modal("show");
    });
});