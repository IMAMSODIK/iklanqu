@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>{{$pageTitle}}</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('dashboard_assets/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row size-column">
            <div class="col-xl-4 col-sm-6">
                <div class="card o-hidden small-widget">
                    <div class="card-body total-project border-b-primary border-2"><span class="f-light f-w-500 f-14">Titik Lokasi</span>
                        <div class="project-details">
                            <div class="project-counter">
                                <h2 class="f-w-600">0</h2><span class="f-12 f-w-400">(Lokasi)</span>
                            </div>
                            <div class="product-sub bg-primary-light">
                                <i class="fa fa-users text-white"></i>
                            </div>
                        </div>
                        <ul class="bubbles">
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
                <div class="card o-hidden small-widget">
                    <div class="card-body total-project border-b-primary border-2"><span class="f-light f-w-500 f-14">Clients</span>
                        <div class="project-details">
                            <div class="project-counter">
                                <h2 class="f-w-600">0</h2><span class="f-12 f-w-400">(Clients)</span>
                            </div>
                            <div class="product-sub bg-primary-light">
                                <i class="fa fa-user-plus text-white"></i>
                            </div>
                        </div>
                        <ul class="bubbles">
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
                <div class="card o-hidden small-widget">
                    <div class="card-body total-project border-b-warning border-2"><span class="f-light f-w-500 f-14">Total Revenue</span>
                        <div class="project-details">
                            <div class="project-counter">
                                <h2 class="f-w-600">Rp. 0</h2><span class="f-12 f-w-400"></span>
                            </div>
                            <div class="product-sub bg-primary-light">
                                <i class="fa fa-user-check text-white"></i>
                            </div>
                        </div>
                        <ul class="bubbles">
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
