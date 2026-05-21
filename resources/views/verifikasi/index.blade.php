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
            @endif

            <!-- TAB -->
            <ul class="nav nav-tabs mb-4" id="campaignTab">

                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pendingTab">

                        <i class="fa fa-clock me-1"></i>
                        Menunggu Verifikasi

                        <span class="badge bg-warning text-dark ms-1">
                            {{ $pendingCount }}
                        </span>

                    </button>
                </li>

                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#historyTab">

                        <i class="fa fa-history me-1"></i>
                        History Verifikasi

                    </button>
                </li>

            </ul>

            <div class="tab-content">

                <!-- TAB PENDING -->
                <div class="tab-pane fade show active" id="pendingTab">

                    <div class="table-responsive">

                        <table class="table table-bordered align-middle" id="tableVerifikasi">

                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Campaign</th>
                                    <th>Pengiklan</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Tanggal</th>
                                    <th width="220">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($pendingCampaigns as $item)
                                    <tr id="row-{{ $item->id }}">

                                        <td>
                                            {{ $loop->iteration }}
                                        </td>

                                        <td>
                                            <strong>
                                                {{ $item->name }}
                                            </strong>

                                            @if ($item->description)
                                                <br>
                                                <small class="text-muted">
                                                    {{ $item->description }}
                                                </small>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $item->user->name ?? '-' }}
                                        </td>

                                        <td>
                                            <span class="badge bg-warning">
                                                {{ ucfirst($item->payment_status) }}
                                            </span>
                                        </td>

                                        <td>
                                            Rp {{ number_format($item->total_price, 0, ',', '.') }}
                                        </td>

                                        <td>
                                            {{ $item->created_at->format('d M Y H:i') }}
                                        </td>

                                        <td>

                                            @if ($item->media)
                                        <td>

                                            <button class="btn btn-primary btn-sm btn-lihat-media"
                                                data-media="{{ $item->media }}">

                                                <i class="fa fa-image"></i>
                                                Lihat Media

                                            </button>

                                            <button class="btn btn-success btn-sm btn-verifikasi"
                                                data-id="{{ $item->id }}">

                                                <i class="fa fa-check"></i>
                                                Verifikasi

                                            </button>

                                        </td>
                                @endif

                                <button class="btn btn-success btn-sm btn-verifikasi"data-id="{{ $item->id }}">
                                    <i class="fa fa-check"></i>
                                    Verifikasi
                                </button>

                                </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="7" class="text-center text-muted py-5">

                                        Tidak ada iklan menunggu verifikasi

                                    </td>
                                </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

                <!-- TAB HISTORY -->
                <div class="tab-pane fade" id="historyTab">

                    <div class="table-responsive">

                        <table class="table table-bordered align-middle" id="tableHistory">

                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Campaign</th>
                                    <th>Pengiklan</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Diverifikasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($historyCampaigns as $item)
                                    <tr>

                                        <td>
                                            {{ $loop->iteration }}
                                        </td>

                                        <td>
                                            <strong>
                                                {{ $item->name }}
                                            </strong>
                                        </td>

                                        <td>
                                            {{ $item->user->name ?? '-' }}
                                        </td>

                                        <td>
                                            <span class="badge bg-success">
                                                Aktif
                                            </span>
                                        </td>

                                        <td>
                                            Rp {{ number_format($item->total_price, 0, ',', '.') }}
                                        </td>

                                        <td>
                                            {{ $item->updated_at->format('d M Y H:i') }}
                                        </td>

                                        <td>

                                            <button class="btn btn-primary btn-sm btn-lihat-media"
                                                data-media="{{ $item->media }}">

                                                <i class="fa fa-image"></i>
                                                Lihat Media

                                            </button>

                                        </td>

                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-5">
                                            Belum ada history verifikasi
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Modal Media -->
    <div class="modal fade" id="mediaModal" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Preview Media
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body text-center" id="mediaContainer"></div>

            </div>

        </div>

    </div>
@endsection

@section('own_script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('own_assets/scripts/verifikasi.js') }}"></script>
@endsection
