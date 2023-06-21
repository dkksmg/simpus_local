<?php

use App\Http\Controllers\Admin\AjaxDropdown;
use App\Http\Controllers\Admin\FaskesController as AdminFaskesController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Faskes\FaskesController as FaskesFaskesController;
use App\Http\Controllers\Faskes\HomeController as FaskesHomeController;
use App\Http\Controllers\Faskes\KunjunganController;
use App\Http\Controllers\Faskes\NakesController;
use App\Http\Controllers\Faskes\ObatController;
use App\Http\Controllers\Faskes\PasienController;
use App\Http\Controllers\Faskes\PoliController;
use App\Http\Controllers\Faskes\ProfileController;
use App\Http\Controllers\Faskes\RekamMedisController;
use App\Http\Controllers\Faskes\TindakanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IcdController;

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
    return redirect(route('login'));
})->name('home');
Route::get('/register', function () {
    return redirect(route('login'));
});

Auth::routes();

Route::get('cek-faskes', [AdminFaskesController::class, 'cekKodeFaskes'])->name('cek-kode');

Route::prefix('admin')->middleware(['auth', 'admin',])
    ->group(function () {
        Route::get('dashboard', [AdminHomeController::class, 'index'])->name('admin.dashboard');
        Route::get('faskes/non-aktif', [AdminFaskesController::class, 'ListNonaktif'])->name('admin.faskes.list-nonaktif');
        Route::put('faskes/aktifkan/{id}', [AdminFaskesController::class, 'AktifkanFaskes'])->name('admin.faskes.aktifkan');
        Route::put('faskes/nonaktifkan/{id}', [AdminFaskesController::class, 'NonaktifkanFaskes'])->name('admin.faskes.nonaktifkan');
        Route::get('faskes/restore/{id}', [AdminFaskesController::class, 'restore'])->name('admin.faskes.restore');
        Route::get('faskes/cek-faskes', [AdminFaskesController::class, 'cekFaskes'])->name('admin.faskes.cek');
        Route::post('faskes/resend/{id}', [AdminFaskesController::class, 'resend'])->name('admin.faskes.resend');
        Route::get('faskes/data', [AdminFaskesController::class, 'ambilData'])->name('admin.faskes.data');
        Route::get('faskes/pasien/data', [PasienController::class, 'ambilPasien'])->name('admin.faskes.pasien.data');
        Route::get('faskes/obat/data', [ObatController::class, 'ambilObat'])->name('admin.faskes.obat.data');
        Route::get('faskes/tindakan/data', [TindakanController::class, 'ambilTindakan'])->name('admin.faskes.tindakan.data');
        Route::get('faskes/nakes/data', [NakesController::class, 'ambilNakes'])->name('admin.faskes.nakes.data');
        Route::resource('faskes', AdminFaskesController::class);
        Route::get('cek-json', [AdminFaskesController::class, 'cekJson']);
    });
Route::prefix('faskes')->middleware(['auth', 'klinik',])
    ->group(function () {
        // dashboard
        Route::get('dashboard', [FaskesHomeController::class, 'index'])->name('faskes.dashboard');
        Route::get('policy', [FaskesHomeController::class, 'policy'])->name('faskes.policy');
        // resource nakes
        Route::get('nakes', [NakesController::class, 'index'])->name('faskes.nakes');
        Route::get('nakes/tambah', [NakesController::class, 'create'])->name('faskes.nakes.create');
        Route::post('nakes', [NakesController::class, 'store'])->name('faskes.nakes.store');
        Route::delete('nakes/{id}', [NakesController::class, 'destroy'])->name('faskes.nakes.destroy');
        Route::get('nakes/edit/{id}', [NakesController::class, 'edit'])->name('faskes.nakes.edit');
        Route::put('nakes/{id}', [NakesController::class, 'update'])->name('faskes.nakes.update');
        Route::put('nakes/aktifkan/{id}', [NakesController::class, 'AktifkanNakes'])->name('faskes.nakes.aktifkan');
        Route::put('nakes/nonaktifkan/{id}', [NakesController::class, 'NonaktifkanNakes'])->name('faskes.nakes.nonaktifkan');
        // resource obat
        Route::get('obat', [ObatController::class, 'index'])->name('faskes.obat');
        Route::get('obat/tambah', [ObatController::class, 'create'])->name('faskes.obat.create');
        Route::get('obat/edit/{id}', [ObatController::class, 'edit'])->name('faskes.obat.edit');
        Route::delete('obat/{id}', [ObatController::class, 'destroy'])->name('faskes.obat.destroy');
        Route::post('obat', [ObatController::class, 'store'])->name('faskes.obat.store');
        Route::put('obat/{id}', [ObatController::class, 'update'])->name('faskes.obat.update');
        // resource tindakan
        Route::get('tindakan', [TindakanController::class, 'index'])->name('faskes.tindakan');
        Route::get('tindakan/tambah', [TindakanController::class, 'create'])->name('faskes.tindakan.create');
        Route::get('tindakan/edit/{id}', [TindakanController::class, 'edit'])->name('faskes.tindakan.edit');
        Route::delete('tindakan/{id}', [TindakanController::class, 'destroy'])->name('faskes.tindakan.destroy');
        Route::post('tindakan', [TindakanController::class, 'store'])->name('faskes.tindakan.store');
        Route::put('tindakan/{id}', [TindakanController::class, 'update'])->name('faskes.tindakan.update');
        // resource pasien
        Route::get('pasien', [PasienController::class, 'index'])->name('faskes.pasien');
        Route::get('pasien/tambah', [PasienController::class, 'create'])->name('faskes.pasien.create');
        Route::get('pasien/edit/{id}', [PasienController::class, 'edit'])->name('faskes.pasien.edit');
        Route::post('pasien/tinggal/', [PasienController::class, 'getTinggal'])->name('faskes.pasien.tinggal');
        Route::delete('pasien/{id}', [PasienController::class, 'destroy'])->name('faskes.pasien.destroy');
        Route::post('pasien', [PasienController::class, 'store'])->name('faskes.pasien.store');
        Route::put('pasien/{id}', [PasienController::class, 'update'])->name('faskes.pasien.update');
        // resource Poli
        Route::get('poli', [PoliController::class, 'index'])->name('faskes.poli');
        Route::get('poli/tambah', [PoliController::class, 'create'])->name('faskes.poli.create');
        Route::get('poli/edit/{id}', [PoliController::class, 'edit'])->name('faskes.poli.edit');
        Route::delete('poli/{id}', [PoliController::class, 'destroy'])->name('faskes.poli.destroy');
        Route::post('poli', [PoliController::class, 'store'])->name('faskes.poli.store');
        Route::put('poli/{id}', [PoliController::class, 'update'])->name('faskes.poli.update');
        Route::put('ppoli/aktifkan/{id}', [PoliController::class, 'AktifkanPoli'])->name('faskes.poli.aktifkan');
        Route::put('poli/nonaktifkan/{id}', [PoliController::class, 'NonaktifkanPoli'])->name('faskes.poli.nonaktifkan');
        //profile
        Route::get('profile', [ProfileController::class, 'index'])->name('faskes.profile');
        Route::put('profile/{id}', [ProfileController::class, 'update'])->name('faskes.profile.update');
        // resource kunjungan
        Route::get('pasien/cari', [KunjunganController::class, 'caripasien'])->name('faskes.kunjungan.caripasien');
        Route::get('kunjungan/cari', [KunjunganController::class, 'index'])->name('faskes.kunjungan');
        Route::get('kunjungan/list', [KunjunganController::class, 'list'])->name('faskes.kunjungan.list');
        Route::get('kunjungan/pasien/data-list', [KunjunganController::class, 'datalist'])->name('faskes.kunjungan.data-list');
        Route::post('kunjungan', [KunjunganController::class, 'store'])->name('faskes.kunjungan.store');
        Route::delete('kunjungan/{id}', [KunjunganController::class, 'destroy'])->name('faskes.kunjungan.destroy');
        // Pemeriksaan
        Route::get('pemeriksaan/', [RekamMedisController::class, 'index'])->name('faskes.catat');
        Route::get('pemeriksaan-old', [RekamMedisController::class, 'old'])->name('faskes.catat.old');
        Route::get('pemeriksaan/pasien/{id}', [RekamMedisController::class, 'show'])->name('faskes.catat.show');
        Route::get('pemeriksaan/pasien/{id}/edit', [RekamMedisController::class, 'edit'])->name('faskes.catat.edit');
        Route::get('pemeriksaan/pencarian', [RekamMedisController::class, 'carikunjungan'])->name('faskes.catat.cari');
        Route::post('pemeriksaan', [RekamMedisController::class, 'store'])->name('faskes.catat.store');
        Route::get('pemeriksaan/selesai', [RekamMedisController::class, 'riwayatPasien'])->name('faskes.catat.list');
        Route::get('pemeriksaan/data/list-selesai', [RekamMedisController::class, 'listPasienSelesai'])->name('faskes.catat.data-list');
    });
Route::prefix('faskes/data/ajax')->middleware(['auth', 'klinik'])
    ->group(function () {
        Route::post('api/kelurahan-list', [AjaxDropdown::class, 'getKelurahan'])->name('data.kelurahan-list');
        Route::post('api/kota-kab', [AjaxDropdown::class, 'fetchKotaKab'])->name('data.kota');
        Route::post('api/kecamatan', [AjaxDropdown::class, 'fetchKecamatan'])->name('data.kecamatan');
        Route::post('api/kelurahan', [AjaxDropdown::class, 'fetchKelurahan'])->name('data.kelurahan');
        Route::get('preview-icd', [IcdController::class, 'listICD'])->name('data.ajax.view-icd');
        Route::get('popup-icd', [IcdController::class, 'popupICD'])->name('data.ajax.popup-icd');
        Route::get('tampil-icd/{id}', [IcdController::class, 'tampilICD'])->name('data.ajax.tampil-icd');
        Route::get('popup-tindakan', [IcdController::class, 'popupTindakan'])->name('data.ajax.popup-tindakan');
        Route::get('tampil-tindakan/{id}', [IcdController::class, 'tampilTindakan'])->name('data.ajax.tampil-tindakan');
        Route::get('popup-obat', [IcdController::class, 'popupObat'])->name('data.ajax.popup-obat');
        Route::get('tampil-obat/{id}', [IcdController::class, 'tampilObat'])->name('data.ajax.tampil-obat');
    });
