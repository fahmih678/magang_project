<?php

use App\Http\Controllers\admin\{
    BarangController,
    DashboardController,
    KategoriController
};
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::prefix('/')->middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard-admin');
    Route::get('barang', [BarangController::class, 'index'])->name('barang');
    Route::get('kategori', [KategoriController::class, 'index'])->name('kategori');
});

require __DIR__ . '/auth.php';
