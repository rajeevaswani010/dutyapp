<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\UserController;

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
    // return view('welcome');
    return redirect()->route('dashboard');
});

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    // Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

Route::resource('mission', MissionController::class);
Route::post('mission/add', [MissionController::class,'add']);
Route::get('/getMissions', [MissionController::class,'getMissions']);


Route::resource('users', UserController::class);
Route::post('/assignusertomissions', [UserController::class,'assignUserToMissions']);
Route::post('/unassignuserfrommissions', [UserController::class,'unAssignUserFromMissions']);
Route::get('/getUsers', [UserController::class,'getUsers']);


Route::get('/deposit', [App\Http\Controllers\DepositController::class,'deposit'])->name('deposit');
Route::post('/doDeposit', [App\Http\Controllers\DepositController::class,'doDeposit'])->name('doDeposit');

Route::get('/mark-as-read', [App\Http\Controllers\DepositController::class,'markAsRead'])->name('mark-as-read');


