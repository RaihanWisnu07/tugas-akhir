<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\KomentarController;
use Illuminate\Support\Facades\Route;

Route::get('/',[GuestController::class, 'index']);


Route::middleware(['guest'])->group(function() {

    route::get('/login', [AuthController::class, 'index'])->name('login');
    route::post('/login/post', [AuthController::class, 'post'])->name('login.post');

    route::get('/register', [AuthController::class, 'register'])->name('register');
    route::post('/register/post', [AuthController::class, 'registerpost'])->name('register.post');
});


Route::middleware(['auth'])->group(function() {
    route::get('/dashboard',[DashboardController::class ,'index'])->name('dashboard');
    route::get('/album/{id}', [DashboardController::class, 'sort'])->name('dashboard.sort');
    route::get('/logout', [DashboardController::class, 'logout'])->name('logout');

    route::get('/album', [AlbumController::class, 'index'])->name('album');
    route::post('/album/post', [AlbumController::class, 'post'])->name('album.post');

    route::get('/foto',[FotoController::class, 'index'])->name('foto');
    route::post('/foto/post',[FotoController::class, 'post'])->name('foto.post');
    route::delete('/foto/{id}',[FotoController::class, 'destroy'])->name('foto.destroy');
    route::post('/like/{id}', [FotoController::class,'like'])->name('like');

    route::get('komentar/{id}', [KomentarController::class, 'index'])->name('komentar');
    route::post('komentar/{id}', [KomentarController::class, 'post'])->name('komentar.post');
});
