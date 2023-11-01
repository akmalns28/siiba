@extends('layout.main')
@section('container')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Barang</h4>
                    </div>
                    <div class="card-body">
                        {{ $sStok }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Peminjaman</h4>
                    </div>
                    <div class="card-body">
                        {{ $cPeminjaman }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Barang Masuk</h4>
                    </div>
                    <div class="card-body">
                        {{ $cBarangMasuk }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total User</h4>
                    </div>
                    <div class="card-body">
                        {{ $cUser }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
