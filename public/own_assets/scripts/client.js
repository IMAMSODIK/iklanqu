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

$(document).on("click", ".detail-lokasi", function () {

    modal = "edit-data-modal";

    let id = $(this).data('id');

    $('body').css('cursor', 'wait');

    $.ajax({

        url: "/lokasi/detail",
        method: "GET",
        data: { id: id },

        success: function (response) {

            $('body').css('cursor', 'default');

            if (response.status) {

                let d = response.data;

                $("#edit_id").val(d.id);
                $("#edit_nama").val(d.nama);
                $("#edit_alamat").val(d.alamat);
                $("#edit_link_maps").val(d.link_maps);

                // preview gambar
                if (d.gambar) {

                    $("#edit_preview").attr(
                        "src",
                        "/storage/" + d.gambar
                    );

                } else {

                    $("#edit_preview").attr(
                        "src",
                        "/own_assets/images/no-image.jpg"
                    );

                }

                // status button
                if (d.status == 1) {

                    $("#delete").show();
                    $("#activate").hide();

                } else {

                    $("#delete").hide();
                    $("#activate").show();

                }

                $("#edit-data-modal").modal("show");

            }

        }

    });

});

$("#edit_gambar").on("change", function () {

    let file = this.files[0];

    if (file) {

        let reader = new FileReader();

        reader.onload = function (e) {

            $("#edit_preview").attr("src", e.target.result);

        };
        reader.readAsDataURL(file);

    }

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

$("#gambar").on("change", function (e) {

    let file = e.target.files[0];

    if (file) {

        let reader = new FileReader();

        reader.onload = function (e) {
            $("#preview-gambar")
                .attr("src", e.target.result)
                .show();
        };

        reader.readAsDataURL(file);
    }

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
    button.prop('disabled', true);

    formData.append("_token", $("meta[name='csrf-token']").attr("content"));
    formData.append("nama", $("#nama").val());
    formData.append("alamat", $("#alamat").val());
    formData.append("link_maps", $("#link_maps").val());

    let gambar = $("#gambar")[0].files[0];

    if (gambar) {

        let allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];

        if (!allowedTypes.includes(gambar.type)) {

            alertModal(false, "Gambar harus JPG, JPEG, atau PNG");

            $('body').css('cursor', 'default');
            button.prop('disabled', false);
            return;
        }

        if (gambar.size > 2 * 1024 * 1024) {

            alertModal(false, "Ukuran gambar maksimal 2MB");

            $('body').css('cursor', 'default');
            button.prop('disabled', false);
            return;
        }

        formData.append("gambar", gambar);
    }

    $.ajax({

        url: "/lokasi/store",
        method: "POST",
        processData: false,
        contentType: false,
        data: formData,

        success: function (response) {

            $('body').css('cursor', 'default');
            button.prop('disabled', false);

            if (response.status) {

                $("#tambah-data-modal").modal("hide");

                let lokasi = response.data;

                let gambar = lokasi.gambar
                    ? "/storage/" + lokasi.gambar
                    : "/own_assets/images/no-image.jpg";

                let html = `
                <div class="col-6 col-md-4 col-xl-3 detail-lokasi"
                    data-id="${lokasi.id}"
                    data-status="1"
                    style="cursor:pointer">

                    <div class="card h-100 shadow-sm">

                        <div class="product-img position-relative">

                            <img class="img-fluid w-100"
                                style="height:200px;object-fit:cover"
                                src="${gambar}">

                            <div class="ribbon ribbon-success">Active</div>

                        </div>

                        <div class="card-body text-center">

                            <h6 class="mb-2">
                                ${lokasi.nama}
                            </h6>

                            <p class="text-muted small mb-2">
                                ${lokasi.alamat}
                            </p>

                            <div class="d-flex justify-content-center gap-2">

                                <a href="${lokasi.link_maps}"
                                    target="_blank"
                                    class="btn btn-sm btn-primary">

                                    <i class="fa fa-map-marker me-1"></i>
                                    Maps
                                </a>

                            </div>

                        </div>

                    </div>

                </div>
                `;

                $(".data-ctr").prepend(html);

                // reset form
                $("#nama").val('');
                $("#alamat").val('');
                $("#link_maps").val('');
                $("#gambar").val('');
                $("#preview-gambar").hide().attr("src","");

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
            button.prop('disabled', false);

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

$("#update-lokasi").on("click", function () {

    let formData = new FormData();
    let button = $(this);

    $('body').css('cursor', 'wait');
    button.prop('disabled', true);

    formData.append("_token", $("meta[name='csrf-token']").attr("content"));
    formData.append("id", $("#edit_id").val());
    formData.append("nama", $("#edit_nama").val());
    formData.append("alamat", $("#edit_alamat").val());
    formData.append("link_maps", $("#edit_link_maps").val());

    let gambar = $("#edit_gambar")[0].files[0];

    if (gambar) {
        formData.append("gambar", gambar);
    }

    $.ajax({

        url: "/lokasi/update",
        method: "POST",
        processData: false,
        contentType: false,
        data: formData,

        success: function (response) {
            $("#edit-data-modal").modal("hide");
            $('body').css('cursor', 'default');
            button.prop('disabled', false);

            if (response.status) {

                let d = response.data;

                let card = $(`.detail-lokasi[data-id="${d.id}"]`);

                // update nama
                card.find("h6").text(d.nama);

                // update alamat
                card.find("p").text(d.alamat.substring(0,60) + "...");

                // update link maps
                card.find("a.btn-primary").attr("href", d.link_maps);

                // update gambar jika ada
                if (d.gambar) {
                    card.find("img").attr("src", "/storage/" + d.gambar);
                }

                $("#edit-data-modal").modal("hide");

                alertModal(true, response.message);

            }

        }

    });

});

$("#delete").on("click", function () {
    let id = $("#edit_id").val();
    let button = $(this);

    $('body').css('cursor', 'wait');
    button.prop('disabled', true);

    $.ajax({

        url: "/lokasi/delete",
        method: "POST",
        data: {
            _token: $("meta[name='csrf-token']").attr("content"),
            id: id
        },

        success: function (response) {
            $("#edit-data-modal").modal("hide");
            $('body').css('cursor', 'default');
            button.prop('disabled', false);

            if (response.status) {

                let card = $(`.detail-lokasi[data-id="${id}"]`);

                card.attr("data-status", 0);

                card.find(".ribbon")
                    .removeClass("ribbon-success")
                    .addClass("ribbon-danger")
                    .text("Nonactive");

                $("#delete").hide();
                $("#activate").show();

                alertModal(true, response.message);

            }

        }

    });

});

$("#activate").on("click", function () {

    let id = $("#edit_id").val();
    let button = $(this);

    $('body').css('cursor', 'wait');
    button.prop('disabled', true);

    $.ajax({

        url: "/lokasi/activate",
        method: "POST",
        data: {
            _token: $("meta[name='csrf-token']").attr("content"),
            id: id
        },

        success: function (response) {
            $("#edit-data-modal").modal("hide");
            $('body').css('cursor', 'default');
            button.prop('disabled', false);

            if (response.status) {

                let card = $(`.detail-lokasi[data-id="${id}"]`);

                card.attr("data-status", 1);

                card.find(".ribbon")
                    .removeClass("ribbon-danger")
                    .addClass("ribbon-success")
                    .text("Active");

                $("#activate").hide();
                $("#delete").show();

                alertModal(true, response.message);

            }

        }

    });

});

$("#search").on('input', function () {

    let text = $(this).val();

    $.ajax({

        url: "/lokasi/search",
        method: "GET",
        data: { q: text },

        success: function (response) {

            $(".data-ctr").empty();

            if (response.status) {

                response.data.forEach(function (lokasi) {

                    let photo = lokasi.gambar
                        ? "/storage/" + lokasi.gambar
                        : "/own_assets/images/no-image.jpg";

                    let ribbon = lokasi.status
                        ? `<div class="ribbon ribbon-success">Active</div>`
                        : `<div class="ribbon ribbon-danger">Nonactive</div>`;

                    let alamat = lokasi.alamat.length > 60
                        ? lokasi.alamat.substring(0, 60) + "..."
                        : lokasi.alamat;

                    let html = `
                    <div class="col-6 col-md-4 col-xl-3 detail-lokasi"
                        style="cursor:pointer"
                        data-id="${lokasi.id}"
                        data-status="${lokasi.status}">

                        <div class="card h-100 shadow-sm">

                            <div class="product-img position-relative">

                                <img class="img-fluid w-100"
                                    style="height:200px;object-fit:cover"
                                    src="${photo}">

                                ${ribbon}

                            </div>

                            <div class="card-body text-center">

                                <h6 class="mb-2">
                                    ${lokasi.nama}
                                </h6>

                                <p class="text-muted small mb-2">
                                    ${alamat}
                                </p>

                                <div class="d-flex justify-content-center gap-2">

                                    <a href="${lokasi.link_maps}"
                                        target="_blank"
                                        class="btn btn-sm btn-primary">

                                        <i class="fa fa-map-marker me-1"></i>
                                        Maps
                                    </a>

                                    <button class="btn btn-sm btn-warning edit-lokasi"
                                        data-id="${lokasi.id}">

                                        <i class="fa fa-edit"></i>
                                    </button>

                                </div>

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
                        Terjadi kesalahan saat mencari data.
                    </p>
                </div>
            `);

        }

    });

});

$("#apply-filter").on("click", function () {

    let status = $("#filter-status").val();

    $(".detail-lokasi").each(function () {

        let boardStatus = $(this).data("status");

        if (status === "" || boardStatus == status) {
            $(this).fadeIn(150);
        } else {
            $(this).fadeOut(150);
        }

    });

});