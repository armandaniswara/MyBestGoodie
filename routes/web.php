<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - MyBestGoodie.com
|--------------------------------------------------------------------------
*/

// 1. Halaman Utama (Katalog)
Route::get('/', [ProductController::class, 'index'])->name('home');

// 2. Halaman Detail Produk + Customizer (GET)
// Pastikan method 'showCustomize' ada di ProductController dan menerima parameter $id
Route::get('/product/{id}', [ProductController::class, 'showCustomize'])->name('product.detail');

// 3. Simpan Hasil Custom (POST)
Route::post('/detail-product/save', [ProductController::class, 'storeColor'])->name('detail-product.store');

// 4. Redirect WhatsApp (Opsional jika masih dipakai)
Route::get('/whatsapp/product', [HomeController::class, 'whatsappProduct'])->name('whatsapp.product');
