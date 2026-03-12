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

                        @foreach ($data as $l)
                            <div class="col-6 col-md-4 col-xl-3 detail-lokasi" data-id="{{ $l->id }}"
                                data-status="{{ $l->status }}" style="cursor:pointer">

                                <div class="card h-100 shadow-sm">

                                    <div class="product-img position-relative">

                                        <img class="img-fluid w-100" style="height:200px;object-fit:cover"
                                            src="{{ $l->gambar ? asset('storage/' . $l->gambar) : asset('own_assets/images/no-image.jpg') }}">

                                        @if ($l->status)
                                            <div class="ribbon ribbon-success">Active</div>
                                        @else
                                            <div class="ribbon ribbon-danger">Nonactive</div>
                                        @endif

                                    </div>

                                    <div class="card-body text-center">

                                        <h6 class="mb-1">
                                            {{ $l->nama }}
                                        </h6>

                                        <p class="text-muted small mb-2">
                                            {{ Str::limit($l->alamat, 60) }}
                                        </p>

                                        {{-- BOARD YANG TERHUBUNG --}}
                                        <div class="mb-2">

                                            @if ($l->board->count())
                                                @foreach ($l->board->take(3) as $b)
                                                    <span class="badge bg-info">
                                                        {{ $b->name }}
                                                    </span>
                                                @endforeach

                                                @if ($l->board->count() > 3)
                                                    <span class="badge bg-dark">
                                                        +{{ $l->board->count() - 3 }}
                                                    </span>
                                                @endif
                                            @else
                                                <span class="badge bg-secondary">
                                                    No Board
                                                </span>
                                            @endif

                                        </div>

                                        <div class="d-flex justify-content-center gap-2">

                                            <a href="{{ $l->link_maps }}" target="_blank" class="btn btn-sm btn-primary">
                                                <i class="fa fa-map-marker me-1"></i>
                                                Maps
                                            </a>

                                        </div>

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
        aria-labelledby="modalLokasi" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Add Lokasi</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body dark-modal">
                    <div class="card">
                        <form class="form theme-form dark-inputs">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Lokasi</label>
                                            <input type="text" class="form-control input-air-primary" id="nama"
                                                placeholder="Masukkan nama lokasi">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Alamat</label>
                                            <textarea class="form-control input-air-primary" id="alamat" rows="3" placeholder="Masukkan alamat lokasi"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Link Google Maps</label>
                                            <input type="text" class="form-control input-air-primary" id="link_maps"
                                                placeholder="https://maps.google.com/...">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">

                                            <label class="form-label">Upload Gambar Lokasi</label>

                                            <input type="file" id="gambar" class="form-control" accept="image/*">

                                            <div class="mt-3 text-center">
                                                <img id="preview-gambar" src=""
                                                    style="max-height:200px; display:none; object-fit:cover;"
                                                    class="img-fluid rounded shadow-sm">
                                            </div>

                                        </div>
                                    </div>
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
                    <h5 class="modal-title">Edit Lokasi</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="edit_id">

                    <!-- PREVIEW GAMBAR -->
                    <div class="text-center mb-4">

                        <img id="edit_preview" src="/own_assets/images/no-image.jpg" class="img-fluid rounded shadow-sm"
                            style="max-height:250px; object-fit:cover">

                    </div>

                    <!-- FORM -->

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Lokasi</label>
                            <input type="text" id="edit_nama" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Link Maps</label>
                            <input type="text" id="edit_link_maps" class="form-control">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea id="edit_alamat" class="form-control" rows="3"></textarea>
                        </div>

                    </div>

                    <!-- GANTI GAMBAR -->

                    <div class="mt-3">

                        <label class="form-label">Ganti Gambar</label>

                        <input type="file" id="edit_gambar" class="form-control" accept="image/*">

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-danger" id="delete">
                        Nonaktifkan
                    </button>

                    <button class="btn btn-success" id="activate">
                        Aktifkan
                    </button>

                    <button class="btn btn-primary" id="update-lokasi">
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
    <script src="{{ asset('own_assets/scripts/lokasi.js') }}"></script>
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
