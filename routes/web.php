<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
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


Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('/admin/dashboard/create-user', [AdminController::class, 'create'])->name('create.user');
Route::post('/admin/dashboard/store-user', [AdminController::class, 'store'])->name('store.user');


Route::get('/admin/dashboard/deposit', [AdminController::class, 'depositForm'])->name('deposit.form');
Route::post('/admin/dashboard/deposit/store', [AdminController::class, 'depositStore'])->name('deposit.store');

Route::get('/admin/dashboard/withdraw', [AdminController::class, 'withdrawForm'])->name('withdraw.form');
Route::post('/admin/dashboard/withdraw/store', [AdminController::class, 'withdrawStore'])->name('withdraw.store');

////


Route::get('/login', [UserController::class, 'create'])->name('login')->middleware('alreadyloggedin');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/login/store', [UserController::class, 'store'])->name('store');
Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('dashboard')->middleware('authcheck');





