@extends('layouts.template')

@section('own_style')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/assets/css/vendors/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/assets/css/vendors/owlcarousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/assets/css/vendors/range-slider.css') }}">
    <style>
        .product-img img {
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card {
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-4">
                    <h4>{{ $pageTitle }}</h4>
                </div>
                <div class="col-8 d-flex justify-content-end">
                    <button class="btn btn-primary" id="tambah-data" style="margin-right: 5px">
                        <i class="fa fa-plus-circle me-2"></i> Add Data
                    </button>

                    <button class="btn btn-primary" id="filter">
                        <i class="fa fa-filter me-2"></i> Filter
                    </button>

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid product-wrapper sidebaron">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @else
            <div class="card d-none" id="filter-section">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" id="filter-status">
                                    <option value="">-- All --</option>
                                    <option value="1">Active</option>
                                    <option value="0">Nonactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" id="apply-filter">
                                <i class="fa fa-check me-2"></i> Apply Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-grid">
                <div class="feature-products">
                    <div class="row">
                        <div class="col-12">
                            <form>
                                <div class="form-group m-0">
                                    <input class="form-control" type="search" id="search" placeholder="Search.."
                                        data-original-title="" title=""><i class="fa fa-search"></i>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="product-wrapper-grid">
                    <div class="row g-3 data-ctr" id="board-container">

                        @foreach ($data as $d)
                            <div class="col-6 col-md-4 col-xl-3 detail-board" style="cursor:pointer"
                                data-id="{{ $d->id }}" data-status="{{ $d->status }}">

                                <div class="card h-100 shadow-sm">

                                    <div class="product-img position-relative">

                                        @if ($d->photos->count())
                                            <img class="img-fluid w-100" style="height:200px;object-fit:cover"
                                                src="{{ asset('storage/' . $d->photos->first()->file) }}">
                                        @else
                                            <img class="img-fluid w-100" style="height:200px;object-fit:cover"
                                                src="{{ asset('own_assets/images/no-image.jpg') }}">
                                        @endif

                                        @if ($d->status)
                                            <div class="ribbon ribbon-success">Active</div>
                                        @else
                                            <div class="ribbon ribbon-danger">Nonactive</div>
                                        @endif

                                    </div>

                                    <div class="card-body text-center">

                                        <span class="badge bg-info mb-2">
                                            {{ $d->lokasi->nama ?? '-' }}
                                        </span>

                                        <h6 class="mb-1">
                                            {{ $d->name }}
                                        </h6>

                                        <p class="text-muted small mb-1">
                                            Kode : {{ $d->kode }}
                                        </p>
                                        <p class="text-muted small mb-1">
                                            Harga : Rp {{ number_format($d->price, 0, ',', '.') }}
                                        </p>

                                        <span class="badge bg-dark">
                                            {{ $d->photos->count() }} Foto
                                        </span>

                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        @endif
    </div>

    <div class="modal fade bd-example-modal-lg" id="tambah-data-modal" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myExtraLargeModal">Add Board</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body dark-modal">
                    <div class="card">
                        <form class="form theme-form dark-inputs">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="nama">Nama Board</label>
                                            <input type="text" class="form-control input-air-primary" id="nama"
                                                placeholder="Masukkan nama board">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="kode">Kode Board</label>
                                            <input type="text" class="form-control input-air-primary" id="kode"
                                                placeholder="Masukkan kode board">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="pin">Pin Board</label>
                                            <input type="text" class="form-control input-air-primary" id="pin"
                                                placeholder="Masukkan pin board">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="mb-3">
                                            <label>Harga (Wajib diisi)</label>
                                            <input type="text" name="price" id="price" class="form-control"
                                                placeholder="Masukkan harga produk">
                                            <small class="text-danger error-price"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="lokasi">Lokasi Board</label>
                                            <select class="form-control input-air-primary" id="lokasi">
                                                @foreach ($lokasi as $l)
                                                    <option value="{{ $l->id }}">{{ $l->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="mb-3">

                                            <label class="form-label">Upload Foto Board</label>

                                            <input type="file" id="photos" name="photos[]" class="input-air-primary form-control"
                                                accept="image/*" multiple>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="row mt-3" id="preview-images"></div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <input class="btn btn-light" type="button" id="cancel-add" value="Cancel">
                                <button class="btn btn-primary me-3" type="button" id="store">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-data-modal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Board</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="edit_id">

                    <div id="carouselBoard" class="carousel slide mb-4" data-bs-touch="false">
                        <div class="carousel-inner" id="carousel-images"></div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselBoard"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselBoard"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>

                    <!-- DETAIL BOARD -->

                    <div class="row">
                        <div class="col-md-6 col-12 mb-3">
                            <label class="form-label">Nama Board</label>
                            <input type="text" id="edit_nama" class="form-control">
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <label class="form-label">Kode Board</label>
                            <input type="text" id="edit_kode" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-12 mb-3">
                            <label class="form-label">Pin</label>
                            <input type="text" id="edit_pin" class="form-control">
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="mb-3">
                                <label>Harga (Wajib diisi)</label>
                                <input type="text" name="price" id="edit_price" class="form-control"
                                    placeholder="Masukkan harga produk">
                                <small class="text-danger error-price"></small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-12 mb-3">
                            <label class="form-label">Lokasi</label>
                            <select id="edit_lokasi" class="form-control">
                                @foreach ($lokasi as $l)
                                    <option value="{{ $l->id }}">
                                        {{ $l->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label class="form-label">Tambah Foto</label>
                            <input type="file" id="edit_photos" multiple class="form-control" accept="image/*">
                        </div>
                    </div>

                    <div class="row">
                        <div class="row mt-3" id="preview-edit-images"></div>
                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-danger" id="delete">
                        Nonaktifkan
                    </button>

                    <button class="btn btn-success" id="activate">
                        Aktifkan
                    </button>

                    <button class="btn btn-primary" id="update-board">
                        Update
                    </button>

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade modal-alert" id="alert" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenter1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-toggle-wrapper">
                        <ul class="modal-img">
                            <li> <img id="alert-image"></li>
                        </ul>
                        <h4 class="text-center pb-2" id="alert-title"></h4>
                        <p class="text-center" id="alert-message"></p>
                        <button class="btn btn-secondary d-flex m-auto" id="is-error" type="button"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-toggle-wrapper">
                        <ul class="modal-img">
                            <li> <img id="alert-image" src="{{ asset('own_assets/icon/confirm.gif') }}" width="300px">
                            </li>
                        </ul>
                        <h4 class="text-center pb-2" id="alert-title">Hapus Data</h4>
                        <p class="text-center" id="alert-message">Apakah anda yakin ingin menghapus data?</p>
                        <div class="row">
                            <div class="col-md-6 d-flex justify-content-end">
                                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                            <div class="col-md-6 d-flex justify-content-start">
                                <button class="btn btn-danger" id="delete-confirmed" type="button"
                                    data-bs-dismiss="modal">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('own_script')
    <script src="{{ asset('own_assets/scripts/board.js') }}"></script>
    <script src="{{ asset('dashboard_assets/assets/js/range-slider/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/assets/js/range-slider/rangeslider-script.js') }}"></script>
    <script src="{{ asset('dashboard_assets/assets/js/touchspin/vendors.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/assets/js/touchspin/touchspin.js') }}"></script>
    <script src="{{ asset('dashboard_assets/assets/js/touchspin/input-groups.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/assets/js/owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('dashboard_assets/assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/assets/js/select2/select2-custom.js') }}"></script>
    <script src="{{ asset('dashboard_assets/assets/js/product-tab.js') }}"></script>
@endsection
