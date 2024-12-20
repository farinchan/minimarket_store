<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProdukController as frontProdukController;
use App\Http\Controllers\Front\CartController;

use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\KasirController;
use App\Http\Controllers\Back\KategoriProdukController;
use App\Http\Controllers\Back\MetodePembayaranController;
use App\Http\Controllers\Back\TransaksiController;
use App\Http\Controllers\Back\ProdukController;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\PesananController;
use App\Models\PemesananItem;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerProcess'])->name('register.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/forgot-password', [AuthController::class, 'forgetPasswordProcess'])->name('forgot-password.process');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('reset-password');
Route::post('/reset-password/{token}', [AuthController::class, 'resetPasswordProcess'])->name('reset-password.process');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/produk', [frontProdukController::class, 'index'])->name('produk');
Route::get('/produk/detail/{id}', [frontProdukController::class, 'detail'])->name('produk-detail');
Route::get('/produk/kategori', [frontProdukController::class, 'category'])->name('produk-category');

Route::get('/cart', [CartController::class, "cart"])->name('cart')->middleware('auth');
Route::get('/cart/api', [CartController::class, "cartApi"])->name('cart-api');
Route::delete('/cart/{id}/remove', [CartController::class, "removeCart"])->name('cart-remove')->middleware(['auth', 'role:pembeli']);
Route::post('/cart/add', [CartController::class, "addToCart"])->name('cart-add')->middleware(['auth', 'role:pembeli']);

Route::get('/checkout', [CheckoutController::class, "checkout"])->name('checkout')->middleware(['auth', 'role:pembeli']);
Route::post('/checkout/process', [CheckoutController::class, "checkoutProcess"])->name('checkout-process')->middleware(['auth', 'role:pembeli']);

Route::get('/pesanan-saya', [PesananController::class, 'index'])->name('pesanan-saya')->middleware(['auth', 'role:pembeli']);
Route::delete('/pesanan-saya/{id}/batal', [PesananController::class, 'batalPesanan'])->name('pesanan-batal')->middleware(['auth', 'role:pembeli']);
Route::get('/pesanan-saya/{id}/invoice', [PesananController::class, 'cetakInvoice'])->name('pesanan-invoice')->middleware(['auth', 'role:pembeli']);
Route::post('/pesanan-saya/{id}/pembayaran', [PesananController::class, 'pembayaranStore'])->name('pesanan-pembayaran')->middleware(['auth', 'role:pembeli']);

Route::prefix('back')->middleware('auth')->name('back.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/ajax-dashboard', [DashboardController::class, 'ajaxDashboard'])->name('ajax-dashboard');

    Route::get('/profile', [DashboardController::class, 'profileEdit'])->name('profile');
    Route::put('/profile/update', [DashboardController::class, 'profileUpdate'])->name('profile.update');

    Route::prefix('kasir')->name('kasir.')->group(function () {
        Route::get('/', [KasirController::class, 'index'])->name('index');
        Route::post('/transaksi-process-ajax', [KasirController::class, 'transaksiProcessAjax'])->name('transaksi-process-ajax');

        Route::get('/history', [KasirController::class, 'history'])->name('history');
    });

    Route::prefix('kategori-produk')->name('kategori-produk.')->group(function () {
        Route::get('/', [KategoriProdukController::class, 'index'])->name('index');
        Route::post('/store', [KategoriProdukController::class, 'store'])->name('store');
        Route::put('/update/{id}', [KategoriProdukController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [KategoriProdukController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('produk')->name('produk.')->group(function () {
        Route::get('/', [ProdukController::class, 'index'])->name('index');
        Route::get('/create', [ProdukController::class, 'create'])->name('create');
        Route::post('/store', [ProdukController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProdukController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ProdukController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [ProdukController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('metode-pembayaran')->name('metode-pembayaran.')->middleware(['role:admin super|admin jual beli|pegawai'])->group(function () {
        Route::get('/', [MetodePembayaranController::class, 'index'])->name('index');
        Route::post('/store', [MetodePembayaranController::class, 'store'])->name('store');
        Route::put('/update/{id}', [MetodePembayaranController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [MetodePembayaranController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('pesanan')->name('pesanan.')->group(function () {
        Route::get('/konfirmasi-pembayaran', [TransaksiController::class, 'konfirmasiPembayaran'])->name('konfirmasi-pembayaran');
        Route::post('/konfirmasi-pembayaran/{id_konfirmasi}/approve', [TransaksiController::class, 'konfirmasiPembayaranApprove'])->name('konfirmasi-pembayaran.approve');
        Route::post('/konfirmasi-pembayaran/{id_konfirmai}/reject', [TransaksiController::class, 'konfirmasiPembayaranReject'])->name('konfirmasi-pembayaran.reject');
        Route::post('/cancel-Pembayaran/{id}', [TransaksiController::class, 'cancelPembayaran'])->name('cancelPembayaran');

        Route::get('/diproses', [TransaksiController::class, 'diproses'])->name('diproses');
        Route::post('/diproses/{id}/kirim', [TransaksiController::class, 'diprosesKirim'])->name('diproses.kirim');

        Route::get('/dikirim', [TransaksiController::class, 'dikirim'])->name('dikirim');
        Route::post('/dikirim/{id}/selesai', [TransaksiController::class, 'dikirimSelesai'])->name('dikirim.selesai');

        Route::get('/selesai', [TransaksiController::class, 'selesai'])->name('selesai');

        Route::get('/dibatalkan', [TransaksiController::class, 'dibatalkan'])->name('dibatalkan');

    });

    Route::prefix('pengguna')->name('pengguna.')->group(function () {
        route::middleware('role:admin super')->group(function () {
            Route::get('/pembeli', [UserController::class, 'pembeli'])->name('pembeli');
            Route::post('/pembeli/store', [UserController::class, 'pembeliStore'])->name('pembeli.store');
            Route::put('/pembeli/update/{id}', [UserController::class, 'pembeliUpdate'])->name('pembeli.update');
            Route::delete('/pembeli/destroy/{id}', [UserController::class, 'pembeliDestroy'])->name('pembeli.destroy');
        });

        route::middleware(['role:admin super|admin kepegawaian'])->group(function () {
            Route::get('/pegawai', [UserController::class, 'pegawai'])->name('pegawai');
            Route::post('/pegawai/store', [UserController::class, 'pegawaiStore'])->name('pegawai.store');
            Route::put('/pegawai/update/{id}', [UserController::class, 'pegawaiUpdate'])->name('pegawai.update');
            Route::delete('/pegawai/destroy/{id}', [UserController::class, 'pegawaiDestroy'])->name('pegawai.destroy');
        });
    });
});
