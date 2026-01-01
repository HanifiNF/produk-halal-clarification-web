<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UMKMController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PembinaController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/howto', function () {
    return view('howto');
})->name('howto');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Define the admin-only list-all route before the resource routes to avoid conflicts
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/umkm/list-all', [UMKMController::class, 'listAll'])->name('umkm.listall');
    Route::get('/admin/products', [ProductController::class, 'adminIndex'])->name('admin.products.index');
});

// Define routes for data access users (read-only access to all data)
Route::middleware(['auth', 'data.access'])->group(function () {
    Route::get('/data-access/users', [UserController::class, 'index'])->name('data.access.users.index');
    Route::get('/data-access/umkm', [UMKMController::class, 'listAll'])->name('data.access.umkm.index');
    Route::get('/data-access/products', [ProductController::class, 'adminIndex'])->name('data.access.products.index');
    Route::get('/data-access/dashboard', [App\Http\Controllers\DataAccessDashboardController::class, 'index'])->name('data.access.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User resource routes (CRUD) - protected by auth
    Route::resource('users', UserController::class);

    // UMKM resource routes - protected by auth (must come after specific routes to avoid conflicts)
    Route::resource('umkm', UMKMController::class);

    // Product resource routes - protected by auth
    Route::resource('products', ProductController::class);

    // Pembina routes - for pembina to see their binaan
    Route::get('/pembina/binaan', [PembinaController::class, 'index'])->name('pembina.binaan');
});

// Admin dashboard route - protected by both auth and admin middleware
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

require __DIR__.'/auth.php';
