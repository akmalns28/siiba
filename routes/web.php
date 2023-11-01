<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DanaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\DetailBarangController;
use App\Http\Controllers\HakAksesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KodeBarangController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\SubKategoriController;
use App\Http\Controllers\SupplierController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layout.login');
});

// Login
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login-proses', 'proses')->name('login-proses');
    Route::get('/logout', 'logout')->name('logout');
});

// user
Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'index')->name('user');
    Route::post('user/search', 'showUser')->name('user-search');
    Route::get('/tambah-user', 'tambahUser')->name('tambah-user');
    Route::post('/insert-user', 'insertUser')->name('insert-user');
    Route::get('/tampil-user/{id}', 'tampilUser')->name('tampil-user');
    Route::post('/update-user/{id}', 'updateUser')->name('update-user');
    Route::get('/delete-user/{id}', 'deleteUser')->name('delete-user');
});
// Kategori
Route::controller(KategoriController::class)->group(function () {
    Route::get('/kategori', 'index')->name('kategori');
    Route::get('/tambah-kategori', 'tambahKategori')->name('tambah-kategori');
    Route::post('/insert-kategori', 'insertKategori')->name('insert-kategori');
    Route::get('/tampil-kategori/{id}', 'tampilKategori')->name('tampil-kategori');
    Route::post('/update-kategori/{id}', 'updateKategori')->name('update-kategori');
    Route::get('/delete-kategori/{id}', 'deleteKategori')->name('delete-kategori');
    Route::get('/subcategories/{kategori_id}', 'getSubCategories')->name('get-sub-kategori');
});

// sub kategori
Route::controller(SubKategoriController::class)->group(function () {
    Route::get('/sub-kategori', 'index')->name('sub-kategori');
    Route::get('/tambah-sub-kategori', 'tambahSubKategori')->name('tambah-sub-kategori');
    Route::post('/insert-sub-kategori', 'insertSubKategori')->name('insert-sub-kategori');
    Route::get('/tampil-sub-kategori/{id}', 'tampilSubKategori')->name('tampil-sub-kategori');
    Route::post('/update-sub-kategori/{id}', 'updateSubKategori')->name('update-sub-kategori');
    Route::get('/delete-sub-kategori/{id}', 'deleteSubKategori')->name('delete-sub-kategori');
});

// satuan
Route::controller(SatuanController::class)->group(function () {
    Route::get('/satuan', 'index')->name('satuan');
    Route::get('/tambah-satuan', 'tambahSatuan')->name('tambah-satuan');
    Route::post('/insert-satuan', 'insertSatuan')->name('insert-satuan');
    Route::get('/tampil-satuan/{id}', 'tampilSatuan')->name('tampil-satuan');
    Route::post('/update-satuan/{id}', 'updateSatuan')->name('update-satuan');
    Route::get('/delete-satuan/{id}', 'deleteSatuan')->name('delete-satuan');
});

// ruangan
Route::controller(RuanganController::class)->group(function () {
    Route::get('/ruangan', 'index')->name('ruangan');
    Route::get('/tambah-ruangan', 'tambahRuangan')->name('tambah-ruangan');
    Route::post('/insert-ruangan', 'insertRuangan')->name('insert-ruangan');
    Route::get('/tampil-ruangan/{id}', 'tampilRuangan')->name('tampil-ruangan');
    Route::post('/update-ruangan/{id}', 'updateRuangan')->name('update-ruangan');
    Route::get('/delete-ruangan/{id}', 'deleteRuangan')->name('delete-ruangan');
});

// supplier
Route::controller(SupplierController::class)->group(function () {
    Route::get('/supplier', 'index')->name('supplier');
    Route::get('/tambah-supplier', 'tambahSupplier')->name('tambah-supplier');
    Route::post('/insert-supplier', 'insertSupplier')->name('insert-supplier');
    Route::get('/tampil-supplier/{id}', 'tampilSupplier')->name('tampil-supplier');
    Route::post('/update-supplier/{id}', 'updateSupplier')->name('update-supplier');
    Route::get('/delete-supplier/{id}', 'deleteSupplier')->name('delete-supplier');
});

// departemen
Route::controller(DepartemenController::class)->group(function () {
    Route::get('/departemen', 'index')->name('departemen');
    Route::get('/tambah-departemen', 'tambahdepartemen')->name('tambah-departemen');
    Route::post('/insert-departemen', 'insertdepartemen')->name('insert-departemen');
    Route::get('/tampil-departemen/{id}', 'tampildepartemen')->name('tampil-departemen');
    Route::post('/update-departemen/{id}', 'updatedepartemen')->name('update-departemen');
    Route::get('/delete-departemen/{id}', 'deletedepartemen')->name('delete-departemen');
});

// dana
Route::controller(DanaController::class)->group(function () {
    Route::get('/dana', 'index')->name('dana');
    Route::get('/tambah-dana', 'tambahDana')->name('tambah-dana');
    Route::post('/insert-dana', 'insertDana')->name('insert-dana');
    Route::get('/tampil-dana/{id}', 'tampilDana')->name('tampil-dana');
    Route::post('/update-dana/{id}', 'updateDana')->name('update-dana');
    Route::get('/delete-dana/{id}', 'deleteDana')->name('delete-dana');
});

// hak akses
Route::controller(HakAksesController::class)->group(function () {
    Route::get('/hak-akses', 'index')->name('hak-akses');
    Route::get('/tambah-hak-akses', 'tambahHakAkses')->name('tambah-hak-akses');
    Route::post('/insert-hak-akses', 'insertHakAkses')->name('insert-hak-akses');
    Route::get('/tampil-hak-akses/{id}', 'tampilHakAkses')->name('tampil-hak-akses');
    Route::post('/update-hak-akses/{id}', 'updateHakAkses')->name('update-hak-akses');
});

// barang
Route::controller(BarangController::class)->group(function () {
    Route::get('/barang', 'index')->name('barang');
    Route::get('/detail-barang/{sub_kategori_id}', 'detailBarang')->name('detail-barang');
    Route::get('/tambah-barang', 'tambahBarang')->name('tambah-barang');
    Route::post('/insert-barang', 'insertBarang')->name('insert-barang');
    Route::get('/tampil-barang/{sub_kategori_id}', 'tampilBarang')->name('tampil-barang');
    Route::post('/update-barang/{id}', 'updateBarang')->name('update-barang');
    Route::get('/export-pdf-barang', 'exportPDF')->name('export-pdf-barang');
});

// detailbarang
Route::controller(DetailBarangController::class)->group(function () {
    Route::get('/view-detail-barang', 'viewDetBarang')->name('view-detail-barang');
    Route::get('/tampil-detail-barang/{id}', 'tampilDetBarang')->name('tampil-detail-barang');
    Route::post('/update-detail-barang/{id}', 'updateDetailBarang')->name('update-detail-barang');
    Route::get('/delete-detail-barang/{id}', 'deleteDetailBarang')->name('delete-detail-barang');
    Route::get('/export-pdf-detail-barang', 'exportPDF')->name('export-pdf-detail-barang');
});

// lokasi
Route::controller(LokasiController::class)->group(function () {
    Route::get('/lokasi', 'index')->name('lokasi');
    Route::get('/lokasi/grafik', 'grafik')->name('grafik-lokasi');
    Route::post('update-lokasi', 'multiUpdate')->name('update-lokasi');
    Route::get('/detail-lokasi/{id}', 'detailLokasi')->name('detail-lokasi');
    Route::get('/tambah-lokasi', 'tambahLokasi')->name('tambah-lokasi');
    Route::post('/insert-lokasi', 'insertLokasi')->name('insert-lokasi');
    Route::get('/delete-lokasi/{id}', 'deleteLokasi')->name('delete-lokasi');
    Route::get('/export-pdf-lokasi', 'exportPDF')->name('export-pdf-lokasi');
});

// barang-masuk
Route::controller(BarangMasukController::class)->group(function () {
    Route::get('/barang-masuk', 'index')->name('barang-masuk');
    Route::get('/detail-barang-masuk/{id}', 'detailBarangMasuk')->name('detail-barang-masuk');
    Route::get('/tambah-barang-masuk', 'tambahBarangMasuk')->name('tambah-barang-masuk');
    Route::post('/insert-barang-masuk', 'insertBarangMasuk')->name('insert-barang-masuk');
    Route::get('/tampil-barang-masuk/{id}', 'tampilBarangMasuk')->name('tampil-barang-masuk');
    Route::post('/update-barang-masuk/{id}', 'updateBarangMasuk')->name('update-barang-masuk');
    Route::get('/export-pdf', 'exportPDF')->name('export-pdf-barang-masuk');
});

// Peminjaman
Route::controller(PeminjamanController::class)->group(function () {
    Route::get('/peminjaman', 'index')->name('peminjaman');
    Route::get('/peminjaman/grafik', 'grafik')->name('grafik-peminjaman');
    Route::post('/peminjaman/{peminjam_id}/pinjam', 'updateStatus')->name('update-status');
    Route::get('/riwayat-peminjaman', 'riwayatPeminjaman')->name('riwayat-peminjaman');
    Route::get('/detail-peminjaman/{peminjam_id}', 'detailPeminjaman')->name('detail-peminjaman');
    Route::get('/tambah-peminjaman', 'tambahPeminjaman')->name('tambah-peminjaman');
    Route::post('/insert-peminjaman', 'insertPeminjaman')->name('insert-peminjaman');
    Route::get('/tampil-peminjaman/{id}', 'tampilPeminjaman')->name('tampil-peminjaman');
    Route::get('/export-pdf-peminjaman', 'exportPDF')->name('export-pdf-peminjaman');
});

// laporan
Route::controller(LaporanController::class)->group(function () {
    Route::get('/laporan', 'index')->name('laporan');
});

// middleware
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //grup route hak akses admin
    Route::group(['middleware' => ['cekUserLogin:1']], function () {});

    //grup route hak akses operator
    Route::group(['middleware' => ['cekUserLogin:2']], function () {});

    // middleware kepala sekolah
    Route::group(['middleware' => ['cekUserLogin:3']], function () {});
});
