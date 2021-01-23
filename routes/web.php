<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

# Home root
Route::get('/', function () {
    return view('home');
})->middleware('auth');

# Auth Controller
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/postlogin', [AuthController::class, 'postlogin']);

# Route Group Admin
Route::group(['middleware' => ['auth', 'checkRole:admin']], function() {

    # Dashboard Controller
    Route::get('/dashboard', [DashboardController::class, 'index']);

    # Siswa Controller
    Route::get('/siswa', [SiswaController::class, 'index']);
    Route::get('/siswa/profile/{id}', [SiswaController::class, 'show']);
    Route::get('/siswa/edit/{id}', [SiswaController::class, 'edit']);
    Route::post('/siswa/create', [SiswaController::class, 'create']);
    Route::put('/siswa/{id}', [SiswaController::class, 'update']);
    Route::delete('/siswa/{id}', [SiswaController::class, 'destroy']);

});

# Route Group Siswa
Route::group(['middleware' => ['auth', 'checkRole:admin,siswa']], function() {

    # Dashboard Controller
    Route::get('/dashboard', [DashBoardController::class, 'index']);

});