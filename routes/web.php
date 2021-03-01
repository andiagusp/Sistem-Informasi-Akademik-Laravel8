<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiteController;

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
// Route::get('/', function () {
//     return view('home');
// })->middleware('auth');

Route::get('/', [SiteController::class, 'home']);

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
    Route::get('/siswa/profile/{siswa}', [SiswaController::class, 'show']);
    Route::get('/siswa/edit/{siswa}', [SiswaController::class, 'edit']);
    Route::post('/siswa/create', [SiswaController::class, 'create']);
    Route::put('/siswa/{siswa}', [SiswaController::class, 'update']);
    Route::get('/siswa/delete/{siswa}', [SiswaController::class, 'destroy']);
    Route::post('/siswa/tambahnilai/{siswa}', [SiswaController::class, 'tambahNilai']);
    Route::delete('/siswa/deletenilai/{siswa}/{idmapel}', [SiswaController::class, 'deleteNilai']);

    #excel export
    Route::get('/siswa/exportexcel', [SiswaController::class, 'exportExcel']);


    #PDF export
    Route::get('/siswa/exportpdf', [SiswaController::class, 'exportPDF']);

});

# Route Group Siswa
Route::group(['middleware' => ['auth', 'checkRole:admin,siswa']], function() {

    # Dashboard Controller
    Route::get('/dashboard', [DashBoardController::class, 'index']);

});