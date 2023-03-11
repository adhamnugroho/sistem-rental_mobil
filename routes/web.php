<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\PenyewaanController as UserPenyewaanController;
use App\Http\Controllers\User\MobilController as UserMobilController;


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KasAdminController;
use App\Http\Controllers\KasAsuransiController;
use App\Http\Controllers\LaporanKasAdminController;
use App\Http\Controllers\LaporanKasAsuransiController;
use App\Http\Controllers\LaporanPenyewaanController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PerentalController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\TransaksiPenyewaController;
use App\Http\Controllers\TransaksiPerentalController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Artisan;


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

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return redirect()->route('login')
        ->with('status', 'success')
        ->with('message', 'Cache berhasil dibersihkan!');
});

Route::get('/', function () {
    return redirect()->route('userDashboard');
});

Route::get('/dashboard', [UserDashboardController::class, 'main'])->name('userDashboard');

Route::group(['middleware' => 'guest'], function () {

    Route::get('/login', [AuthController::class, 'main'])->name('login');
    Route::post('/postLogin', [AuthController::class, 'postLogin'])->name('postLogin');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/registerStore', [AuthController::class, 'registerStore'])->name('registerStore');
});



Route::group(['middleware' => 'auth'], function () {


    Route::group(['middleware' => 'pengguna'], function () {

        Route::group(['prefix' => 'penyewaan'], function () {

            Route::get('/{id}', [UserPenyewaanController::class, 'index'])->name('userPenyewaan');
            Route::post('/hitungHargaPenyewaan', [UserPenyewaanController::class, 'hitungPenyewaanAjax'])->name('userHitungPenyewaanAjax');
            Route::post('/store', [UserPenyewaanController::class, 'storePenyewaan'])->name('userStorePenyewaan');
        });
        Route::get('/penyewaanBerhasil', [UserPenyewaanController::class, 'penyewaanBerhasil'])->name('userPenyewaanBerhasil');
        Route::get('/detailMobil/{id}', [UserMobilController::class, 'detail'])->name('userDetailMobil');
    });

    Route::group(['middleware' => 'admin'], function () {

        Route::group(['prefix' => 'admin'], function () {

            Route::get('/dashboard', [DashboardController::class, 'main'])->name('dashboard');

            Route::group(['prefix' => 'users'], function () {

                Route::get('/', [UsersController::class, 'index'])->name('users');
                Route::get('/create', [UsersController::class, 'create'])->name('usersCreate');
                Route::post('/store', [UsersController::class, 'store'])->name('usersStore');
                Route::get('/show/{id}', [UsersController::class, 'show'])->name('usersShow');
                Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('usersEdit');
                Route::post('/update/{id}', [UsersController::class, 'update'])->name('usersUpdate');
                Route::get('/delete/{id}', [UsersController::class, 'destroy'])->name('usersDelete');

                Route::post('/getKabupaten', [UsersController::class, 'getKabupaten'])->name('usersGetKabupaten');
            });


            Route::group(['prefix' => 'perental'], function () {

                Route::group(['prefix' => 'data-perental'], function () {

                    Route::get('/', [PerentalController::class, 'index'])->name('perental');
                    Route::get('/create', [PerentalController::class, 'create'])->name('perentalCreate');
                    Route::post('/store', [PerentalController::class, 'store'])->name('perentalStore');
                    Route::get('/show/{id}', [PerentalController::class, 'show'])->name('perentalShow');
                    Route::get('/edit/{id}', [PerentalController::class, 'edit'])->name('perentalEdit');
                    Route::post('/update/{id}', [PerentalController::class, 'update'])->name('perentalUpdate');
                    Route::get('/delete/{id}', [PerentalController::class, 'destroy'])->name('perentalDelete');
                });

                Route::group(['prefix' => 'mobil'], function () {

                    Route::get('/', [MobilController::class, 'index'])->name('mobil');
                    Route::get('/create', [MobilController::class, 'create'])->name('mobilCreate');
                    Route::post('/store', [MobilController::class, 'store'])->name('mobilStore');
                    Route::get('/show/{id}', [MobilController::class, 'show'])->name('mobilShow');
                    Route::get('/edit/{id}', [MobilController::class, 'edit'])->name('mobilEdit');
                    Route::post('/update/{id}', [MobilController::class, 'update'])->name('mobilUpdate');
                    Route::get('/delete/{id}', [MobilController::class, 'destroy'])->name('mobilDelete');
                });
            });


            Route::group(['prefix' => 'transaksi'], function () {

                Route::group(['prefix' => 'transaksi-penyewa'], function () {

                    Route::get('/', [TransaksiPenyewaController::class, 'index'])->name('transaksiPenyewa');
                    Route::get('/create', [TransaksiPenyewaController::class, 'create'])->name('transaksiPenyewaCreate');
                    Route::post('/store', [TransaksiPenyewaController::class, 'store'])->name('transaksiPenyewaStore');
                    Route::get('/show/{id}', [TransaksiPenyewaController::class, 'show'])->name('transaksiPenyewaShow');
                    Route::get('/penyewaanBerjalan/{id}', [TransaksiPenyewaController::class, 'penyewaanBerjalan'])->name('transaksiPenyewaBerjalan');

                    Route::get('/preBayar/{id}', [TransaksiPenyewaController::class, 'preBayar'])->name('transaksiPenyewaPreBayar');
                    Route::post('/postBayar/{id}', [TransaksiPenyewaController::class, 'postBayar'])->name('transaksiPenyewaPostBayar');

                    Route::get('/batal/{id}', [TransaksiPenyewaController::class, 'batal'])->name('transaksiPenyewaBatal');

                    Route::get('/print/{id}', [TransaksiPenyewaController::class, 'print'])->name('transaksiPenyewaPrint');
                });


                Route::group(['prefix' => 'transaksi-perental'], function () {

                    Route::get('/', [TransaksiPerentalController::class, 'index'])->name('transaksiPerental');
                    Route::get('/show/{id}', [TransaksiPerentalController::class, 'show'])->name('transaksiPerentalShow');
                    Route::get('/mobilSudahDatang/{id}', [TransaksiPerentalController::class, 'mobilSudahDatang'])->name('transaksiPerentalMobilSudahDatang');

                    Route::get('/selesaiSemua/{id}', [TransaksiPerentalController::class, 'selesaiSemua'])->name('transaksiPerentalSelesaiSemua');
                    Route::get('/selesaiSatu/{id}', [TransaksiPerentalController::class, 'selesaiSatu'])->name('transaksiPerentalSelesaiSatu');

                    Route::get('/batal/{id}', [TransaksiPerentalController::class, 'batal'])->name('transaksiPerentalBatal');

                    Route::get('/printBanyak/{id}/{id_penyewa}', [TransaksiPerentalController::class, 'printBanyak'])->name('transaksiPerentalPrintBanyak');
                    Route::get('/printSatu/{id}/{id_penyewa}', [TransaksiPerentalController::class, 'printSatu'])->name('transaksiPerentalPrintSatu');
                });
            });


            Route::group(['prefix' => 'keuangan'], function () {

                Route::group(['prefix' => 'keuangan-asuransi'], function () {

                    Route::get('/', [KasAsuransiController::class, 'index'])->name('keuanganAsuransi');
                    Route::get('/show/{id}', [KasAsuransiController::class, 'show'])->name('keuanganAsuransiShow');

                    Route::get('/tambahCreate', [KasAsuransiController::class, 'tambahCreate'])->name('keuanganAsuransiTambahCreate');
                    Route::post('/tambahStore', [KasAsuransiController::class, 'tambahStore'])->name('keuanganAsuransiTambahStore');
                    Route::get('/tambahEdit/{id}', [KasAsuransiController::class, 'tambahEdit'])->name('keuanganAsuransiTambahEdit');
                    Route::post('/tambahUpdate/{id}', [KasAsuransiController::class, 'tambahUpdate'])->name('keuanganAsuransiTambahUpdate');

                    Route::get('/kurangCreate', [KasAsuransiController::class, 'kurangCreate'])->name('keuanganAsuransiKurangCreate');
                    Route::post('/kurangStore', [KasAsuransiController::class, 'kurangStore'])->name('keuanganAsuransiKurangStore');
                    Route::get('/kurangEdit/{id}', [KasAsuransiController::class, 'kurangEdit'])->name('keuanganAsuransiKurangEdit');
                    Route::post('/kurangUpdate/{id}', [KasAsuransiController::class, 'kurangUpdate'])->name('keuanganAsuransiKurangUpdate');
                });

                Route::group(['prefix' => 'keuanganAdmin'], function () {

                    Route::get('/', [KasAdminController::class, 'index'])->name('keuanganAdmin');
                    Route::get('/show/{id}', [KasAdminController::class, 'show'])->name('keuanganAdminShow');

                    Route::get('/tambahCreate', [KasAdminController::class, 'tambahCreate'])->name('keuanganAdminTambahCreate');
                    Route::post('/tambahStore', [KasAdminController::class, 'tambahStore'])->name('keuanganAdminTambahStore');
                    Route::get('/tambahEdit/{id}', [KasAdminController::class, 'tambahEdit'])->name('keuanganAdminTambahEdit');
                    Route::post('/tambahUpdate/{id}', [KasAdminController::class, 'tambahUpdate'])->name('keuanganAdminTambahUpdate');

                    Route::get('/kurangCreate', [KasAdminController::class, 'kurangCreate'])->name('keuanganAdminKurangCreate');
                    Route::post('/kurangStore', [KasAdminController::class, 'kurangStore'])->name('keuanganAdminKurangStore');
                    Route::get('/kurangEdit/{id}', [KasAdminController::class, 'kurangEdit'])->name('keuanganAdminKurangEdit');
                    Route::post('/kurangUpdate/{id}', [KasAdminController::class, 'kurangUpdate'])->name('keuanganAdminKurangUpdate');
                });
            });


            Route::group(['prefix' => 'laporan-rekapitulasi'], function () {

                Route::group(['prefix' => 'laporan-penyewaan'], function () {

                    Route::get('/', [LaporanPenyewaanController::class, 'index'])->name('laporanPenyewaan');
                    Route::get('/cariData', [LaporanPenyewaanController::class, 'cariData'])->name('laporanPenyewaanCariData');
                    Route::get('/print', [LaporanPenyewaanController::class, 'print'])->name('laporanPenyewaanPrint');
                });


                Route::group(['prefix' => 'laporan-kas-admin'], function () {

                    Route::get('/', [LaporanKasAdminController::class, 'index'])->name('laporanKasAdmin');
                    Route::get('/cariData', [LaporanKasAdminController::class, 'cariData'])->name('laporanKasAdminCariData');
                    Route::get('/print', [LaporanKasAdminController::class, 'print'])->name('laporanKasAdminPrint');
                });


                Route::group(['prefix' => 'laporan-kas-asuransi'], function () {

                    Route::get('/', [LaporanKasAsuransiController::class, 'index'])->name('laporanKasAsuransi');
                    Route::get('/cariData', [LaporanKasAsuransiController::class, 'cariData'])->name('laporanKasAsuransiCariData');
                    Route::get('/print', [LaporanKasAsuransiController::class, 'print'])->name('laporanKasAsuransiPrint');
                });
            });
        });
    });


    // Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
