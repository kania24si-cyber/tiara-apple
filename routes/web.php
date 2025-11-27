<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PelangganController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/pcr', function () {
    return 'Selamat Datang di Website Kampus PCR!';
});
Route::get('/mahasiswa', function () {
    return 'Halo Mahasiswa';
})->name('mahasiswa.show');

Route::get('/nama/{param1?}', function ($param1='') {
    return 'Nama saya: '.$param1;
});
Route::get('/mahasiswa/{param1}', [MahasiswaController::class,'show']);

Route::get('/about', function () {
    return view('halaman-about');
})->name('route.about');

Route::get('/home',[HomeController::class,'index'])
    ->name('home');

Route::post('question/store', [QuestionController::class, 'store'])
		->name('question.store');

Route::get('/dashboard',[DashboardController::class,'index'])
->name('dashboard');

Route::resource('pelanggan', PelangganController::class);
Route::resource('user', UserController::class);

// ROUTE PROFILE
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show'); // TAMBAHAN
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // TAMBAHAN
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update'); // TAMBAHAN
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // TAMBAHAN
