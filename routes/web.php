<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TempatTidurController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

// public auth pages
Route::get('/signin', [AuthController::class, 'showLoginForm'])->name('signin');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin.submit');
Route::post('/signout', [AuthController::class, 'logout'])->name('signout');

Route::middleware('auth')->group(function () {
    // dashboard pages
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // calender pages
    Route::get('/calendar', function () {
        return view('pages.calender', ['title' => 'Calendar']);
    })->name('calendar');

    // profile pages
    Route::get('/profile', function () {
        return view('pages.profile', ['title' => 'Profile']);
    })->name('profile');

    Route::get('/tempat-tidur', [TempatTidurController::class, 'index'])->name('tempat-tidur');
    Route::put('/tempat-tidur/{id}', [TempatTidurController::class, 'update'])->name('tempat-tidur.update');

    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan');
    Route::get('/pengaduan/download', [PengaduanController::class, 'downloadExcel'])->name('pengaduan.download');

    Route::get('/jadwal-dokter', [App\Http\Controllers\JadwalDokterController::class, 'index'])->name('jadwal-dokter');
    Route::post('/jadwal-dokter', [App\Http\Controllers\JadwalDokterController::class, 'store'])->name('jadwal-dokter.store');
    Route::put('/jadwal-dokter/{id}', [App\Http\Controllers\JadwalDokterController::class, 'update'])->name('jadwal-dokter.update');
    Route::delete('/jadwal-dokter/{id}', [App\Http\Controllers\JadwalDokterController::class, 'destroy'])->name('jadwal-dokter.destroy');

    Route::get('/manage-users', [UserController::class, 'index'])->name('manage-users');
    Route::post('/manage-users', [UserController::class, 'store'])->name('manage-users.store');
    Route::put('/manage-users/{id}', [UserController::class, 'update'])->name('manage-users.update');
    Route::delete('/manage-users/{id}', [UserController::class, 'destroy'])->name('manage-users.destroy');
    Route::post('/manage-users/{id}/reset-password', [UserController::class, 'resetPassword'])->name('manage-users.reset-password');

    // form pages
    Route::get('/form-elements', function () {
        return view('pages.form.form-elements', ['title' => 'Form Elements']);
    })->name('form-elements');

    // tables pages
    Route::get('/basic-tables', function () {
        return view('pages.tables.basic-tables', ['title' => 'Basic Tables']);
    })->name('basic-tables');

    // pages
    Route::get('/blank', function () {
        return view('pages.blank', ['title' => 'Blank']);
    })->name('blank');

    // error pages
    Route::get('/error-404', function () {
        return view('pages.errors.error-404', ['title' => 'Error 404']);
    })->name('error-404');

    // chart pages
    Route::get('/line-chart', function () {
        return view('pages.chart.line-chart', ['title' => 'Line Chart']);
    })->name('line-chart');

    Route::get('/bar-chart', function () {
        return view('pages.chart.bar-chart', ['title' => 'Bar Chart']);
    })->name('bar-chart');

    // ui elements pages
    Route::get('/alerts', function () {
        return view('pages.ui-elements.alerts', ['title' => 'Alerts']);
    })->name('alerts');

    Route::get('/avatars', function () {
        return view('pages.ui-elements.avatars', ['title' => 'Avatars']);
    })->name('avatars');

    Route::get('/badge', function () {
        return view('pages.ui-elements.badges', ['title' => 'Badges']);
    })->name('badges');

    Route::get('/buttons', function () {
        return view('pages.ui-elements.buttons', ['title' => 'Buttons']);
    })->name('buttons');

    Route::get('/image', function () {
        return view('pages.ui-elements.images', ['title' => 'Images']);
    })->name('images');

    Route::get('/videos', function () {
        return view('pages.ui-elements.videos', ['title' => 'Videos']);
    })->name('videos');
    Route::get('/password/change', [AuthController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/password/change', [AuthController::class, 'changePassword'])->name('password.update');
});






















