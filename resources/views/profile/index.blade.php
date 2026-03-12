@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Web Profile</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item active">Web Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Web Profile</h4>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea class="form-control" disabled cols="30" rows="5">{{ $data->alamat ?? '' }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat Email</label>
                                    <input class="form-control" readonly value="{{ $data->email ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nomor Hanphone (WA)</label>
                                    <input class="form-control" readonly value="{{ $data->no_hp ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Instagram</label>

                                    <div class="input-group">

                                        <input class="form-control" readonly value="{{ $data->instagram ?? '' }}">

                                        <a href="{{ $data->instagram ?? '#' }}" target="_blank"
                                            class="btn btn-light border">

                                            <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png"
                                                style="width:20px;height:20px">
                                        </a>

                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">TikTok</label>

                                    <div class="input-group">

                                        <input class="form-control" readonly value="{{ $data->tiktok ?? '' }}">

                                        <a href="{{ $data->tiktok ?? '#' }}" target="_blank" class="btn btn-light border">

                                            <img src="https://cdn-icons-png.flaticon.com/512/3046/3046121.png"
                                                style="width:20px;height:20px">
                                        </a>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <form class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Edit Profile</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>
                                        <textarea class="form-control" id="alamat" cols="30" rows="5">{{ $data->alamat ?? '' }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Alamat Email</label>
                                        <input class="form-control" id="email" value="{{ $data->email ?? '' }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Nomor Handphone (WA)</label>
                                        <input class="form-control" id="no_hp" value="{{ $data->no_hp ?? '' }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Instagram</label>
                                        <input class="form-control" id="instagram"
                                            value="{{ $data->instagram ?? 'https://instagram.com/' }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">TikTok</label>
                                        <input class="form-control" id="tiktok"
                                            value="{{ $data->tiktok ?? 'https://www.tiktok.com/id-ID/' }}">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <button class="btn btn-primary" type="button" id="change-profile">
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('own_script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#change-profile').on('click', function() {

            const btn = $(this);
            const formData = new FormData();

            formData.append('alamat', $('#alamat').val());
            formData.append('email', $('#email').val());
            formData.append('no_hp', $('#no_hp').val());
            formData.append('instagram', $('#instagram').val());
            formData.append('tiktok', $('#tiktok').val());

            btn.prop('disabled', true).text('Updating...');
            $('body').css('cursor', 'wait');

            $.ajax({
                url: "/profile",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success: function(res) {

                    $('body').css('cursor', 'default');

                    if (res.status) {
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
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: xhr.responseJSON?.message ??
                                "Terjadi kesalahan"
                        });
                    }

                },

                error: function(xhr) {

                    $('body').css('cursor', 'default');

                    let msg = 'Something went wrong';

                    if (xhr.responseJSON?.message) {
                        msg = xhr.responseJSON.message;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: msg ??
                            "Terjadi kesalahan"
                    });
                },

                complete: function() {
                    btn.prop('disabled', false).text('Update Profile');
                }
            });

        });
    </script>
@endsection
