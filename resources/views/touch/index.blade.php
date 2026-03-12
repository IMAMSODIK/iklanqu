@extends('layouts.template')

@section('own_style')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-4">
                    <h4>{{ $pageTitle }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid product-wrapper sidebaron">
        <div class="card p-4">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @else
                <div class="product-grid">
                    <div class="product-wrapper-grid">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="tableClient" class="table table-bordered table-striped table-hover"
                                    style="width:100%">
                                    <thead class="text-center">
                                        <tr>
                                            <th style="width: 60px;">No</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">No. Whatsapp</th>
                                            <th class="text-center">Pesan</th>
                                            <th style="width: 150px;">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php $i = 1; @endphp
                                        @foreach ($data as $d)
                                            <tr>
                                                <td class="text-center align-middle">{{ $i++ }}</td>
                                                <td class="align-middle">{{ $d->nama }}</td>
                                                <td class="align-middle">{{ $d->no_wa }}</td>
                                                <td class="align-middle">{{ $d->pesan }}</td>

                                                <td class="text-center align-middle">
                                                    <div class="d-flex justify-content-center gap-1">

                                                        <button class="btn btn-sm btn-warning hubungi"
                                                            data-id="{{ $d->no_wa }}" data-nama="{{ $d->nama }}">
                                                            Hubungi
                                                        </button>

                                                        <button class="btn btn-sm btn-danger hapus"
                                                            data-id="{{ $d->id }}">
                                                            Hapus
                                                        </button>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            @endif
        </div>
    </div>

    <div class="modal fade modal-alert" id="alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1"
        aria-hidden="true">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('own_assets/scripts/touch.js') }}"></script>
@endsection
