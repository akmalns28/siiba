@extends('layout.main')
@section('container')
<div class="section-body">
    <div class="row">
        <div class="col-sm-12 col-md-12 mb-4">
            <div class="hero text-white hero-bg-image hero-bg-parallax" style="background-image: url('{{ asset('img/logo.png') }}');">
              <div class="hero-inner">
                <h2>Selamat Datang, @auth
                    {{ Auth::user()->name }}
                @endauth</h2>
                <p class="lead"></p>
                <div class="mt-4 mx-4 d-flex flex-wrap gap-2 justify-content-around">
                  <a href="{{ route('barang') }}" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-user"></i> Barang</a>
                  <a href="{{ route('barang-masuk') }}" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-user"></i> Barang Masuk</a>
                  <a href="{{ route('lokasi') }}" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-user"></i> Lokasi</a>
                  <a href="{{ route('peminjaman') }}" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-user"></i> Peminjaman</a>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
@endsection