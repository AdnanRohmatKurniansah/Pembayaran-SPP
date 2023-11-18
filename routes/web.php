<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\TagihanController;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['guest'])->group(function() {
    Route::get('/', [AuthController::class, 'login']);
    Route::post('/auth/login', [AuthController::class, 'authenticate']);
});

Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:siswa,petugas');

Route::prefix('dashboard')->group(function() {
    Route::middleware(['auth:petugas'])->group(function() {
        Route::get('/', function () {
            $pembayaran = Pembayaran::join('tagihans', 'pembayarans.id_tagihan', '=', 'tagihans.id')
                ->select(DB::raw('DATE_FORMAT(pembayarans.updated_at, "%M") AS date'), DB::raw('SUM(pembayarans.jumlah_bayar) AS jumlah_bayar'))
                ->groupBy(DB::raw('DATE_FORMAT(pembayarans.updated_at, "%M")'))
                ->orderBy(DB::raw('DATE_FORMAT(pembayarans.updated_at, "%M")'))
                ->where('tagihans.status', 'lunas')
                ->get();
    
            return view('dashboard.index', [
                'pembayarans' => $pembayaran
            ]);
        });
        Route::middleware(['isAdmin'])->group(function() {
            Route::resource('/petugas', PetugasController::class);
            Route::resource('/siswa/kelas', KelasController::class);
            Route::resource('/spp', SppController::class);
            Route::post('/siswa/import', [SiswaController::class, 'importSiswa']);
            Route::get('/siswa/export', [SiswaController::class, 'exportSiswa']);
            Route::resource('/siswa', SiswaController::class);
            Route::post('/pembayaran/laporan', [PembayaranController::class, 'generateLaporan']);
        });
        Route::post('/tagihan/import', [TagihanController::class, 'importTagihan']);
        Route::resource('/tagihan', TagihanController::class);
        Route::resource('/pembayaran', PembayaranController::class);
    });
    Route::middleware(['auth:siswa'])->group(function() {
        Route::get('/tagihanmu', function() {
            $siswa = Auth::guard('siswa')->user()->id;
            return view('dashboard.tagihanmu', [
                'tagihans' => Tagihan::where('id_siswa', $siswa)->get()
            ]);
        });
        Route::get('/pembayaranmu', function() {
            $siswa = Auth::guard('siswa')->user();

            $pembayarans = Pembayaran::whereHas('tagihan', function ($query) use ($siswa) {
                $query->where('id_siswa', $siswa->id);
            })->with(['petugas', 'tagihan.siswa', 'tagihan.spp'])->get();
            return view('dashboard.historymu', [
                'pembayarans' => $pembayarans
            ]);
        });
    });
    Route::middleware(['auth:siswa,petugas'])->group(function() {
        Route::get('/profile', function() {
            return view('dashboard.profile');
        });
        Route::post('/ubah_password', [AuthController::class, 'ubahPassword']);
    });
});
