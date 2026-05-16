<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\ChargeController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\MemberDashboardController;
use App\Http\Controllers\TeacherDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/locale/{locale}', [LocaleController::class, 'switch'])
    ->whereIn('locale', ['zh_CN', 'zh_TW', 'en'])
    ->name('locale.switch');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/founder', [HomeController::class, 'founder'])->name('founder');
Route::get('/services', [HomeController::class, 'servicesPage'])->name('services');
Route::get('/branches', [HomeController::class, 'branchesPage'])->name('branches');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
});

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('branches', BranchController::class)->except(['show']);
    Route::resource('services', ServiceController::class)->except(['show']);
    Route::resource('charges', ChargeController::class)->except(['show']);
    Route::resource('sections', SectionController::class)->except(['show']);
    Route::resource('schedules', ScheduleController::class)->except(['show']);
    Route::resource('users', UserController::class)->except(['show']);
});

// Teacher
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/', [TeacherDashboardController::class, 'index'])->name('dashboard');
});

// Member (student/client)
Route::middleware(['auth', 'role:student,client'])->prefix('member')->name('member.')->group(function () {
    Route::get('/', [MemberDashboardController::class, 'index'])->name('dashboard');
    Route::get('/browse', [BookingController::class, 'browse'])->name('browse');
    Route::post('/book/{schedule}', [BookingController::class, 'book'])->name('book');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
});
