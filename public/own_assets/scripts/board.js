let modal = "", userDetail = "";

function closeModal(element) {
    element.modal("hide");
}

$("#filter").on("click", function () {
    let section = $("#filter-section");

    if (section.hasClass("d-none")) {
        section.removeClass("d-none").hide().slideDown(200);
    } else {
        section.slideUp(200, function () {
            section.addClass("d-none");
        });
    }
});


$("#cancel-edit").on("click", function () {
    closeModal($("#edit-data-modal"));
});

$("#cancel-add").on("click", function () {
    closeModal($("#tambah-data-modal"));
});

$(document).on("click", ".error-response", function () {
    closeModal($(`#${modal}`));
})

$("#tambah-data").on("click", function () {
    modal = "tambah-data-modal";
    $(`#${modal}`).modal("show");
});

$(document).on("click", ".detail-board", function () {
    modal = "edit-data-modal";
    let id = $(this).data('id');

    $('body').css('cursor', 'wait');

    $.ajax({
        url: "/board/detail",
        method: "GET",
        data: { id: id },

        success: function (response) {

            $('body').css('cursor', 'default');

            if (response.status) {

                let d = response.data;

                $("#edit_id").val(d.id);
                $("#edit_nama").val(d.name);
                $("#edit_kode").val(d.kode);
                $("#edit_pin").val(d.pin);
                $("#edit_lokasi").val(d.lokasi_id);

                // STATUS BUTTON
                if (d.status == 1) {
                    $("#delete").show();
                    $("#activate").hide();
                } else {
                    $("#delete").hide();
                    $("#activate").show();
                }

                // CAROUSEL FOTO
                $("#carousel-images").html("");

                if (Array.isArray(d.photos) && d.photos.length) {

                    d.photos.forEach((photo, index) => {

                        let active = index === 0 ? "active" : "";

                        $("#carousel-images").append(`
            <div class="carousel-item ${active} position-relative">

                <img src="/storage/${photo.file}"
                    class="d-block w-100"
                    style="height:300px;object-fit:cover">

                <button
                    type="button"
                    class="btn btn-danger btn-sm delete-photo"
                    data-id="${photo.id}"
                    style="
                        position:absolute;
                        top:10px;
                        right:10px;
                        z-index:999;
                    ">
                    <i class="fa fa-trash"></i>
                </button>

            </div>
        `);

                    });

                } else {

                    $("#carousel-images").html(`
        <div class="carousel-item active">
            <img src="/own_assets/images/no-image.jpg"
            class="d-block w-100"
            style="height:300px;object-fit:cover">
        </div>
    `);

                }

                $("#edit-data-modal").modal("show");

            }

        }

    });

});

let editFiles = [];

$("#edit_photos").on("change", function (e) {

    editFiles = Array.from(e.target.files);

    $("#preview-edit-images").html("");

    editFiles.forEach((file, index) => {

        let reader = new FileReader();

        reader.onload = function (e) {

            $("#preview-edit-images").append(`
                <div class="col-md-3 mb-2">
                    <img src="${e.target.result}"
                    style="width:100%;height:120px;object-fit:cover">
                </div>
            `);

        };

        reader.readAsDataURL(file);

    });

});

$(document).on("click", ".delete-photo", function (e) {

    e.preventDefault();
    e.stopPropagation();

    let btn = $(this);
    let id = btn.data("id");

    if (!confirm("Hapus foto ini?")) return;

    $.post("/board/delete-photo", {
        _token: $("meta[name='csrf-token']").attr("content"),
        id: id
    }, function (res) {

        if (res.status) {

            $('#carouselBoard').carousel('pause');

            let item = btn.closest(".carousel-item");

            item.fadeOut(200, function () {

                $(this).remove();

                let items = $("#carousel-images .carousel-item");

                if (items.length > 0) {
                    items.removeClass("active");
                    items.first().addClass("active");
                }

                if (items.length === 0) {

                    $("#carousel-images").html(`
                        <div class="carousel-item active">
                            <img src="/own_assets/images/no-image.jpg"
                            class="d-block w-100"
                            style="height:300px;object-fit:cover">
                        </div>
                    `);

                }

                $('#carouselBoard').carousel(0);

            });

        }

    });

});

$(document).on("click", ".error-response", function () {
    $(`#${modal}`).modal("show");
});

function alertModal(status, message = null) {
    if (status) {
        $("#alert-image").attr(
            "src",
            "../../dashboard_assets/assets/images/gif/dashboard-8/successful.gif"
        );
        $("#alert-message").text("Success");
        $("#alert-message").text(message);
    } else {
        $("#alert-image").attr(
            "src",
            "../../dashboard_assets/assets/images/gif/danger.gif"
        );
        $("#alert-message").text("Gagal");
        $("#alert-message").html(message);
    }

    $("#alert").modal("show");
}

let selectedFiles = [];

$("#photos").on("change", function (e) {

    selectedFiles = Array.from(e.target.files).filter(file =>
        file.type.startsWith("image/")
    );

    renderPreview();

});

function renderPreview() {

    $("#preview-images").html("");

    selectedFiles.forEach((file, index) => {

        let reader = new FileReader();

        reader.onload = function (e) {

            let html = `
            <div class="col-md-3 mb-3">
                <div style="position:relative">

                    <img src="${e.target.result}"
                    style="width:100%;height:150px;object-fit:cover;border-radius:8px">

                    <button 
                        type="button"
                        class="btn btn-danger btn-sm remove-image"
                        data-index="${index}"
                        style="position:absolute;top:5px;right:5px">
                        ×
                    </button>

                </div>
            </div>
            `;

            $("#preview-images").append(html);

        };

        reader.readAsDataURL(file);

    });

}

$(document).on("click", ".remove-image", function () {

    let index = $(this).data("index");

    selectedFiles.splice(index, 1);

    renderPreview();

});

$("#store").on("click", function () {

    let formData = new FormData();
    let button = $(this);

    $('body').css('cursor', 'wait');
    $(button).prop('disabled', true);

    formData.append("_token", $("meta[name='csrf-token']").attr("content"));
    formData.append("name", $("#nama").val());
    formData.append("kode", $("#kode").val());
    formData.append("pin", $("#pin").val());
    formData.append("lokasi_id", $("#lokasi").val());

    // Validasi file sebelum dikirim
    if (selectedFiles.length > 0) {
        // Cek tipe file
        for (let i = 0; i < selectedFiles.length; i++) {
            const file = selectedFiles[i];
            if (!file.type.startsWith('image/')) {
                alertModal(false, `File ${file.name} bukan gambar!`);
                $('body').css('cursor', 'default');
                $(button).prop('disabled', false);
                return;
            }

            // Cek ekstensi file
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            if (!allowedTypes.includes(file.type)) {
                alertModal(false, `File ${file.name} harus bertipe JPG, JPEG, atau PNG!`);
                $('body').css('cursor', 'default');
                $(button).prop('disabled', false);
                return;
            }

            // Cek ukuran file (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alertModal(false, `File ${file.name} terlalu besar! Maksimal 2MB`);
                $('body').css('cursor', 'default');
                $(button).prop('disabled', false);
                return;
            }
        }

        // Append files dengan nama yang benar
        selectedFiles.forEach(file => {
            formData.append("photos[]", file);
        });
    }

    $.ajax({
        url: "/board/store",
        method: "POST",
        processData: false,
        contentType: false,
        data: formData,

        // Tambahkan timeout untuk upload file
        timeout: 30000, // 30 detik

        success: function (response) {
            $('body').css('cursor', 'default');
            $(button).prop('disabled', false);

            if (response.status) {

                $("#tambah-data-modal").modal("hide");

                let board = response.data;

                let photo = "/own_assets/images/no-image.jpg";

                if (board.photos && board.photos.length > 0) {
                    photo = "/storage/" + board.photos[0].file;
                }

                let ribbon = '<div class="ribbon ribbon-success">Active</div>'

                let html = `
        <div class="col-6 col-md-4 col-xl-3 detail-board" style="cursor:pointer"
            data-id="${board.id}" data-status="1">

            <div class="card h-100 shadow-sm">

                <div class="product-img position-relative">

                    <img class="img-fluid w-100"
                        style="height:200px;object-fit:cover"
                        src="${photo}">

                    ${ribbon}

                </div>

                <div class="card-body text-center">

                    <span class="badge bg-info mb-2">
                        ${board.lokasi?.nama ?? '-'}
                    </span>

                    <h6 class="mb-1">
                        ${board.name}
                    </h6>

                    <p class="text-muted small mb-1">
                        Kode : ${board.kode}
                    </p>

                    <span class="badge bg-dark">
                        ${board.photos ? board.photos.length : 0} Foto
                    </span>

                </div>

            </div>

        </div>
        `;

                $("#board-container").prepend(html);

                // reset form
                $("#nama").val('');
                $("#kode").val('');
                $("#pin").val('');
                $("#photos").val('');
                selectedFiles = [];
                $("#preview-images").html('');

                alertModal(true, response.message);

            } else {

                let message = response.message;

                if (response.errors) {
                    const detailMessages = Object.values(response.errors)
                        .map(msgs => msgs[0])
                        .join("<br>");
                    message += "<br>" + detailMessages;
                }

                alertModal(false, message);
            }
        },

        error: function (xhr) {
            $('body').css('cursor', 'default');
            $(button).prop('disabled', false);

            let message = "Terjadi kesalahan";

            if (xhr.responseJSON?.errors) {
                message = Object.values(xhr.responseJSON.errors)
                    .map(msgs => msgs[0])
                    .join("<br>");
            } else if (xhr.responseJSON?.message) {
                message = xhr.responseJSON.message;
            }

            alertModal(false, message);
        }

    });

});

$("#update-board").click(function () {

    let formData = new FormData();
    let id = $("#edit_id").val();

    formData.append("_token", $("meta[name='csrf-token']").attr("content"));
    formData.append("id", id);
    formData.append("name", $("#edit_nama").val());
    formData.append("kode", $("#edit_kode").val());
    formData.append("pin", $("#edit_pin").val());
    formData.append("lokasi_id", $("#edit_lokasi").val());

    editFiles.forEach(file => {
        formData.append("photos[]", file);
    });

    $.ajax({
        url: "/board/update",
        method: "POST",
        processData: false,
        contentType: false,
        data: formData,

        success: function (response) {

            if (response.status) {

                $("#edit-data-modal").modal("hide");

                let board = response.board;

                let card = $(`.detail-board[data-id="${board.id}"]`);

                card.find("h6").text(board.name);
                card.find(".text-muted").text("Kode : " + board.kode);

                card.find(".badge.bg-info").text(board.lokasi?.nama ?? '-');

                card.find(".badge.bg-dark").text(
                    (board.photos ? board.photos.length : 0) + " Foto"
                );

                if (board.photos && board.photos.length > 0) {

                    card.find("img").attr(
                        "src",
                        "/storage/" + board.photos[0].file
                    );
                }

                alertModal(true, response.message);
            }

        }

    });

});

$("#reset").on("click", function () {
    let formData = new FormData();
    let button = $(this);

    $('body').css('cursor', 'wait');
    $(button).prop('disabled', true);

    let file = $("#edit_foto")[0].files[0];
    if (file) {
        formData.append("foto", file);
    }
    formData.append("_token", $("meta[name='csrf-token']").attr("content"));
    formData.append("id", $("#id").val());

    $.ajax({
        url: "/students/reset-password",
        method: "POST",
        processData: false,
        contentType: false,
        data: formData,
        success: function (response) {
            $(`#${modal}`).modal("hide");

            $('body').css('cursor', 'default');
            $(button).prop('disabled', false);

            if (response.status) {
                alertModal(true, response.message);

                $("#is-error").removeClass('error-response');
            } else {
                let message = `<div style="text-align: center; font-weight: bold; margin-bottom: 10px;">${response.message || "An error occurred."}</div>`;

                if (response.errors) {
                    const detailMessages = Object.values(response.errors)
                        .map(msgs => msgs[0])
                        .join("<br>");
                    message += `<div style="text-align: center;">${detailMessages}</div>`;
                }

                $("#is-error").addClass('error-response');
                alertModal(false, message);
            }

        },
        error: function (xhr) {
            $(`#${modal}`).modal("hide");
            $('body').css('cursor', 'default');
            $(button).prop('disabled', false);

            let message = `<div style="text-align: center; font-weight: bold; margin-bottom: 10px;">An error occurred.</div>`;

            if (xhr.responseJSON) {
                if (xhr.responseJSON.message) {
                    message = `<div style="text-align: center; font-weight: bold; margin-bottom: 10px;">${xhr.responseJSON.message}</div>`;
                }
                if (xhr.responseJSON.errors) {
                    const detailMessages = Object.values(xhr.responseJSON.errors)
                        .map(msgs => msgs[0])
                        .join("<br>");
                    message += `<div style="text-align: center;">${detailMessages}</div>`;
                }
            }

            $("#is-error").addClass('error-response');
            alertModal(false, message);
        }
    });
})

$("#delete").on("click", function () {

    let formData = new FormData();
    let button = $(this);
    let id = $("#edit_id").val();

    $('body').css('cursor', 'wait');
    button.prop('disabled', true);

    formData.append("_token", $("meta[name='csrf-token']").attr("content"));
    formData.append("id", id);

    $.ajax({
        url: "/board/delete",
        method: "POST",
        processData: false,
        contentType: false,
        data: formData,

        success: function (response) {

            $(`#${modal}`).modal("hide");

            if (response.status) {

                let card = $(`.detail-board[data-id="${id}"]`);

                card.attr("data-status", 0);

                card.find(".ribbon").remove();
                card.find(".product-img").append(
                    `<div class="ribbon ribbon-danger">Nonactive</div>`
                );

                alertModal(true, "Board has been Deactivated.");

            } else {

                alertModal(false, response.message);
            }

            $('body').css('cursor', 'default');
            button.prop('disabled', false);
        }
    });
});

$("#activate").on("click", function () {

    let formData = new FormData();
    let button = $(this);
    let id = $("#edit_id").val();

    $('body').css('cursor', 'wait');
    button.prop('disabled', true);

    formData.append("_token", $("meta[name='csrf-token']").attr("content"));
    formData.append("id", id);

    $.ajax({
        url: "/board/activate",
        method: "POST",
        processData: false,
        contentType: false,
        data: formData,

        success: function (response) {

            $(`#${modal}`).modal("hide");

            if (response.status) {

                let card = $(`.detail-board[data-id="${id}"]`);

                card.attr("data-status", 1);

                card.find(".ribbon").remove();
                card.find(".product-img").append(
                    `<div class="ribbon ribbon-success">Active</div>`
                );

                alertModal(true, "Board has been Activated.");

            } else {

                alertModal(false, response.message);
            }

            $('body').css('cursor', 'default');
            button.prop('disabled', false);
        }
    });
});

$("#search").on('input', function () {

    let text = $(this).val();

    $.ajax({
        url: "/board/search",
        method: "GET",
        data: { q: text },

        success: function (response) {

            $(".data-ctr").empty();

            if (response.status) {

                response.data.forEach(function (board) {

                    let photo = "/own_assets/images/no-image.jpg";

                    if (board.photos && board.photos.length > 0) {
                        photo = "/storage/" + board.photos[0].file;
                    }

                    let ribbon = board.status
                        ? `<div class="ribbon ribbon-success">Active</div>`
                        : `<div class="ribbon ribbon-danger">Nonactive</div>`;

                    let lokasi = board.lokasi ? board.lokasi.nama : '-';

                    let html = `
                    <div class="col-6 col-md-4 col-xl-3 detail-board"
                        style="cursor:pointer"
                        data-id="${board.id}"
                        data-status="${board.status}">

                        <div class="card h-100 shadow-sm">

                            <div class="product-img position-relative">

                                <img class="img-fluid w-100"
                                    style="height:200px;object-fit:cover"
                                    src="${photo}">

                                ${ribbon}

                            </div>

                            <div class="card-body text-center">

                                <span class="badge bg-info mb-2">
                                    ${lokasi}
                                </span>

                                <h6 class="mb-1">
                                    ${board.name}
                                </h6>

                                <p class="text-muted small mb-1">
                                    Kode : ${board.kode}
                                </p>

                                <span class="badge bg-dark">
                                    ${board.photos.length} Foto
                                </span>

                            </div>

                        </div>

                    </div>
                    `;

                    $(".data-ctr").append(html);

                });

            } else {

                $(".data-ctr").html(`
                    <div class="col-12 text-center">
                        <p style="font-weight:bold; color:#999;">
                            ${response.message}
                        </p>
                    </div>
                `);

            }

        },

        error: function () {

            $(".data-ctr").html(`
                <div class="col-12 text-center">
                    <p style="font-weight:bold; color:red;">
                        An error occurred while searching.
                    </p>
                </div>
            `);

        }

    });

});

$("#apply-filter").on("click", function () {

    let status = $("#filter-status").val();
    console.log(status)

    $(".detail-board").each(function () {

        let boardStatus = $(this).data("status");

        if (status === "" || boardStatus == status) {
            $(this).fadeIn(150);
        } else {
            $(this).fadeOut(150);
        }

    });

});