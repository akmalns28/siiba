@extends('layout.main')
@section('container')
    <div class="section-body">
        <div class="invoice">
            <div class="invoice-print">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-title">
                            <h2>{{ $tittle }}</h2>
                            <div class="invoice-number">{{ $data->no_peminjaman }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Pihak 1:</strong><br>
                                    {{ $data->user->name }}<br>
                                    {{ $data->user->hak_akses->hak_akses }}
                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                    <strong>Peminjam:</strong><br>
                                    {{ $data->peminjam->nama }}<br>
                                    {{ $data->peminjam->no_hp }}<br>
                                    {{ $data->peminjam->jabatan }}<br>
                                    <br>
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Dikembalikan Pada:</strong><br>
                                    @if ($data->tgl_kembali)
                                        <div>{{ $data->tgl_kembali }}</div>
                                    @else
                                        <div>Belum Dikembalikan</div>
                                    @endif
                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                    <strong>Tanggal Pinjam:</strong><br>
                                    {{ $data->tgl_peminjaman }}<br>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="section-title">Ringkasan Peminjaman</div>
                        <p class="section-lead"></p>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-md">
                                <tbody>
                                    <tr>
                                        <th data-width="40" style="width: 40px;">No</th>
                                        <th>Barang</th>
                                        <th class="text-center">Kode Barang</th>
                                        <th class="text-center">Kondisi</th>
                                    </tr>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($datas as $det_peminjaman)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $det_peminjaman->detail_barang->detail_barang_masuk->nama_barang }}</td>
                                            <td class="text-center">{{ $det_peminjaman->detail_barang->kode_barang }}</td>
                                            <td class="text-center">{{ $det_peminjaman->detail_barang->kondisi }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-8">
                            </div>
                            <div class="col-lg-4 text-right">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-md-right">
                    <div class="float-lg-left mb-lg-0 mb-3">
                        <button type="button" onclick="history.back()" class="btn btn-primary btn-icon icon-left"><svg
                                xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 256 256">
                                <path fill="currentColor"
                                    d="M228 128a12 12 0 0 1-12 12H69l51.52 51.51a12 12 0 0 1-17 17l-72-72a12 12 0 0 1 0-17l72-72a12 12 0 0 1 17 17L69 116h147a12 12 0 0 1 12 12Z" />
                            </svg>
                            Kembali</button>
                    </div>
                    <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
                </div>
            </div>
        </div>
    @endsection
