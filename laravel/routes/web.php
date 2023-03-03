<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\BerandaController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\MentorController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\BillingController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\TimController;
use App\Http\Controllers\Mentor\DashboardController;
use App\Http\Controllers\Mentor\KelasController as MentorKelasController;
use App\Http\Controllers\Member\DashboardController as DashboardMemberController;
use App\Http\Controllers\Member\KelasController as KelasMemberController;
use App\Http\Controllers\Member\BillingController as BillingMemberController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kebijakan-privasi', [HomeController::class, 'privasi'])->name('privasi');
Route::get('/kelas', [HomeController::class, 'kelas'])->name('allkelas');
Route::get('/kelas/{slug}', [HomeController::class, 'kelas'])->name('kelas');
Route::get('/kelas/d/{slug}', [HomeController::class, 'detailkelas'])->name('kelas.detail');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/blog/d/{slug}', [HomeController::class, 'detailblog'])->name('blog.detail');
Route::get('/tentang-kami', [HomeController::class, 'tentangkami'])->name('tentangkami');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');
Route::post('/keluar', [HomeController::class, 'keluar'])->name('keluar');
Route::get('/masuk', [HomeController::class, 'masuk'])->name('masuk');
Route::post('/masuk/proses', [HomeController::class, 'prosesmasuk'])->name('masuk.proses');
Route::get('/daftar', [HomeController::class, 'daftar'])->name('daftar');
Route::post('/daftar/proses', [HomeController::class, 'prosesdaftar'])->name('daftar.proses');

Route::get('/jadilah-mentor', [HomeController::class, 'daftarmentor'])->name('mentor.daftar');
Route::post('/jadilah-mentor/proses', [HomeController::class, 'prosesdaftarmentor'])->name('mentor.daftar.proses');

Route::post('/billing/konfirmasi', [HomeController::class, 'konfirmasi'])->name('konfirmasi');
Route::get('/forum/buat', [HomeController::class, 'buatforum'])->name('forum.buat');
Route::post('/forum/simpan', [HomeController::class, 'simpanforum'])->name('forum.simpan');
Route::get('/forum/v/{slug}', [HomeController::class, 'viewforum'])->name('forum.view');
Route::get('/forum/hapus/{id}', [HomeController::class, 'hapusforum'])->name('forum.hapus');
Route::post('/forum/komentar/{id}', [HomeController::class, 'komentarforum'])->name('forum.komentar');
Route::get('/forum/komentar/hapus/{id}', [HomeController::class, 'hapuskomentarforum'])->name('forum.komentar.hapus');
Route::get('/forum', [HomeController::class, 'forum'])->name('forum');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/masuk', [LoginController::class, 'index'])->name('admin.masuk');
    Route::post('/masuk/proses', [LoginController::class, 'proses'])->name('admin.masuk.proses');
    Route::post('/keluar/proses', [LoginController::class, 'keluar'])->name('admin.keluar.proses');
});

Route::group(['middleware' => 'admin'], function (){ 
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', [BerandaController::class, 'index'])->name('admin.beranda');

        Route::get('/akun', [BerandaController::class, 'akun'])->name('admin.akun'); 
        Route::post('/akun/simpan', [BerandaController::class, 'simpanakun'])->name('admin.akun.simpan'); 

        //kategori
        Route::get('/blog', [BlogController::class, 'index'])->name('admin.blog');
        Route::get('/blog/tambah', [BlogController::class, 'tambah'])->name('admin.blog.tambah');
        Route::post('/blog/simpan', [BlogController::class, 'simpan'])->name('admin.blog.simpan');
        Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('admin.blog.edit');
        Route::post('/blog/update', [BlogController::class, 'update'])->name('admin.blog.update');
        Route::get('/blog/hapus/{id}', [BlogController::class, 'hapus'])->name('admin.blog.hapus');

        //kategori
        Route::get('/kategori', [KategoriController::class, 'index'])->name('admin.kategori');
        Route::get('/kategori/tambah', [KategoriController::class, 'tambah'])->name('admin.kategori.tambah');
        Route::post('/kategori/simpan', [KategoriController::class, 'simpan'])->name('admin.kategori.simpan');
        Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
        Route::post('/kategori/update', [KategoriController::class, 'update'])->name('admin.kategori.update');
        Route::get('/kategori/hapus/{id}', [KategoriController::class, 'hapus'])->name('admin.kategori.hapus');

         //tim
        Route::get('/tim', [TimController::class, 'index'])->name('admin.tim');
        Route::get('/tim/tambah', [TimController::class, 'tambah'])->name('admin.tim.tambah');
        Route::post('/tim/simpan', [TimController::class, 'simpan'])->name('admin.tim.simpan');
        Route::get('/tim/edit/{id}', [TimController::class, 'edit'])->name('admin.tim.edit');
        Route::post('/tim/update', [TimController::class, 'update'])->name('admin.tim.update');
        Route::get('/tim/hapus/{id}', [TimController::class, 'hapus'])->name('admin.tim.hapus');

        //siswa
        Route::get('/siswa', [SiswaController::class, 'index'])->name('admin.siswa');
        Route::get('/siswa/edit/{id}', [SiswaController::class, 'edit'])->name('admin.siswa.edit');
        Route::post('/siswa/update', [SiswaController::class, 'update'])->name('admin.siswa.update');
        Route::get('/siswa/hapus/{id}', [SiswaController::class, 'hapus'])->name('admin.siswa.hapus');

        //mentor
        Route::get('/mentor/permintaan', [MentorController::class, 'permintaan'])->name('admin.mentor.permintaan');
        Route::get('/mentor/permintaan/terima/{id}', [MentorController::class, 'terima'])->name('admin.mentor.permintaan.terima');
        Route::post('/mentor/permintaan/tolak', [MentorController::class, 'tolak'])->name('admin.mentor.permintaan.tolak');

        Route::get('/mentor', [MentorController::class, 'index'])->name('admin.mentor');
        Route::get('/mentor/tambah', [MentorController::class, 'tambah'])->name('admin.mentor.tambah');
        Route::post('/mentor/simpan', [MentorController::class, 'simpan'])->name('admin.mentor.simpan');
        Route::get('/mentor/detail/{id}', [MentorController::class, 'detail'])->name('admin.mentor.detail');
        Route::get('/mentor/edit/{id}', [MentorController::class, 'edit'])->name('admin.mentor.edit');
        Route::post('/mentor/update', [MentorController::class, 'update'])->name('admin.mentor.update');
        Route::get('/mentor/hapus/{id}', [MentorController::class, 'hapus'])->name('admin.mentor.hapus');
        Route::get('/mentor/suspend/{id}', [MentorController::class, 'suspend'])->name('admin.mentor.suspend');
        Route::get('/mentor/unsuspend/{id}', [MentorController::class, 'unsuspend'])->name('admin.mentor.unsuspend');

        //kelas
        Route::get('/kelas/permintaan', [KelasController::class, 'permintaan'])->name('admin.kelas.permintaan');
        Route::get('/kelas/permintaan/detail/{id}', [KelasController::class, 'permintaandetail'])->name('admin.kelas.permintaan.detail');
        Route::get('/kelas/permintaan/terima/{id}', [KelasController::class, 'terima'])->name('admin.kelas.permintaan.terima');
        Route::post('/kelas/permintaan/tolak/{id}', [KelasController::class, 'tolak'])->name('admin.kelas.permintaan.tolak');

        Route::get('/kelas', [KelasController::class, 'index'])->name('admin.kelas');
        Route::get('/kelas/detail/{id}', [KelasController::class, 'detail'])->name('admin.kelas.detail');
        Route::post('/kelas/update', [KelasController::class, 'update'])->name('admin.kelas.update');
        Route::post('/kelas/suspend', [KelasController::class, 'suspend'])->name('admin.kelas.suspend');
        Route::get('/kelas/unsuspend/{id}', [KelasController::class, 'unsuspend'])->name('admin.kelas.unsuspend');

        //billing
        Route::get('/billing', [BillingController::class, 'index'])->name('admin.billing');
        Route::post('/billing/pembayaran/tolak', [BillingController::class, 'tolak'])->name('admin.billing.tolak');
        Route::get('/billing/pembayaran/terima/{id}', [BillingController::class, 'terima'])->name('admin.billing.terima');

        //penarikan
        Route::get('/penarikan', [BillingController::class, 'penarikan'])->name('admin.penarikan');
        Route::post('/penarikan/tolak', [BillingController::class, 'tolakpenarikan'])->name('admin.penarikan.tolak');
        Route::get('/penarikan/terima/{id}', [BillingController::class, 'terimapenarikan'])->name('admin.penarikan.terima');

        //pengaturan
        Route::get('/pengaturan', [BerandaController::class, 'pengaturan'])->name('admin.pengaturan');
        Route::post('/pengaturan/simpan', [BerandaController::class, 'simpanpengaturan'])->name('admin.pengaturan.simpan');
    });
});

Route::group(['middleware' => 'member'], function (){ 
    Route::group(['namespace' => 'Users'], function () 
    { 
        Route::get('/member', [DashboardMemberController::class, 'index']);
        Route::get('/member/dashbord', [DashboardMemberController::class, 'index'])->name('member.dashboard');
        Route::get('/beli-kelas/{id}', [DashboardMemberController::class, 'belikelas'])->name('member.belikelas');
        Route::post('/buat-invocie', [BillingMemberController::class, 'buat_invoice'])->name('member.invoice.buat');
        Route::get('/member/billing', [BillingMemberController::class, 'index'])->name('member.billing');
        Route::post('/member/billing/konfirmasi', [BillingMemberController::class, 'konfirmasi'])->name('member.konfirmasi');
        Route::get('/member/kelas', [KelasMemberController::class, 'index'])->name('member.kelas');
        Route::get('/member/kelas/{id}', [KelasMemberController::class, 'detail'])->name('member.kelas.detail');
        Route::get('/member/kelas/ujian/{id}', [KelasMemberController::class, 'ujian'])->name('member.kelas.ujian');
        Route::post('/member/kelas/ujian/kirim', [KelasMemberController::class, 'kirimujian'])->name('member.kelas.ujian.kirim');
        Route::post('/member/kelas/materi', [KelasMemberController::class, 'materi'])->name('member.kelas.materi');
        Route::post('/member/kelas/sertifikat', [KelasMemberController::class, 'sertifikat'])->name('member.kelas.sertifikat');

        Route::get('/member/profil', [DashboardMemberController::class, 'profil'])->name('member.profil');
        Route::post('/member/profil/simpan', [DashboardMemberController::class, 'simpanprofil'])->name('member.profil.simpan');
    });
});

Route::group(['middleware' => 'mentor'], function (){ 
    Route::group(['namespace' => 'Mentor'], function () 
    { 
        Route::get('/mentor', [DashboardController::class, 'index']);
        Route::get('/mentor/dashbord', [DashboardController::class, 'index'])->name('mentor.dashboard');

        Route::get('/mentor/penarikan', [DashboardController::class, 'penarikan'])->name('mentor.penarikan');
        Route::post('/mentor/penarikan/aksi', [DashboardController::class, 'aksipenarikan'])->name('mentor.penarikan.aksi');
        Route::get('/mentor/siswa', [DashboardController::class, 'siswa'])->name('mentor.siswa');
        Route::get('/mentor/profil', [DashboardController::class, 'profil'])->name('mentor.profil');
        Route::post('/mentor/profil/simpan', [DashboardController::class, 'simpanprofil'])->name('mentor.profil.simpan');

        Route::get('/mentor/penghasilan', [DashboardController::class, 'penghasilan'])->name('mentor.penghasilan');

        Route::get('/mentor/tambah-kelas', [MentorKelasController::class, 'tambah'])->name('mentor.tambah_kelas');
        Route::get('/mentor/kelas-saya', [MentorKelasController::class, 'index'])->name('mentor.kelas');
        Route::get('/mentor/kelas-saya/edit/{id}', [MentorKelasController::class, 'edit'])->name('mentor.kelas.edit');
        Route::get('/mentor/kelas-saya/hapus/{id}', [MentorKelasController::class, 'hapus'])->name('mentor.kelas.hapus');
        Route::post('/mentor/kelas-saya/update', [MentorKelasController::class, 'update'])->name('mentor.kelas.update');
        Route::post('/mentor/tambah-kelas/simpan', [MentorKelasController::class, 'simpan'])->name('mentor.tambah_kelas.simpan');
    });
});
