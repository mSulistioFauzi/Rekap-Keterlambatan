<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RombelsController;
use App\Http\Controllers\RayonsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\LatesController;
use Illuminate\Support\Facades\Auth;

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



Route::middleware('IsGuest')->group(function () {
    Route::get('/', function() {
        return view('login');
    })->name('login');
    Route::get('/login', [UsersController::class, 'loginAuth'])->name('login.auth');
});

Route::get('/error-permission', function() {
    return view('errors.permission');
})->name('error.permission');

Route::middleware(['IsLogin'])->group(function() {
    Route::get('/logout', [UsersController::class, 'logout'])->name('logout');
    Route::get('/home', [UsersController::class, 'dashboard'] )->name('home');

    Route::middleware(['IsAdmin'])->group(function(){
        
        Route::prefix('rombel/')->name('rombel.')->group(function () {
            Route::get('/', [RombelsController::class, 'index'])->name('index');
            Route::get('/create', [RombelsController::class, 'create'])->name('create');
            Route::post('/store', [RombelsController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [RombelsController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [RombelsController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [RombelsController::class, 'delete'])->name('delete');
        });
        
        Route::prefix('rayon/')->name('rayon.')->group(function () {
            Route::get('/', [RayonsController::class, 'index'])->name('index');
            Route::get('/create', [RayonsController::class, 'create'])->name('create');
            Route::post('/store', [RayonsController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [RayonsController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [RayonsController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [RayonsController::class, 'delete'])->name('delete');
        });
        
        Route::prefix('user/')->name('user.')->group(function(){
            Route::get('/', [UsersController::class, 'index'])->name('index');
            Route::get('create', [UsersController::class, 'create'])->name('create');
            Route::post('store', [UsersController::class, 'store'])->name('store');
            Route::get('/{id}', [UsersController::class, 'edit'])->name('edit');
            Route::patch('/{id}', [UsersController::class, 'update'])->name('update');
            Route::delete('/{id}', [UsersController::class, 'destroy'])->name('delete');
        });
        
        Route::prefix('siswa/')->name('student.')->group(function(){
            Route::get('/', [StudentsController::class, 'index'])->name('index');
            Route::get('create', [StudentsController::class, 'create'])->name('create');
            Route::post('store', [StudentsController::class, 'store'])->name('store');
            Route::get('/{id}', [StudentsController::class, 'edit'])->name('edit');
            Route::patch('/{id}', [StudentsController::class, 'update'])->name('update');
            Route::delete('/{id}', [StudentsController::class, 'destroy'])->name('delete');
        });
        
        Route::prefix('lates/')->name('lates.')->group(function(){
            Route::get('/', [LatesController::class, 'index'])->name('index');
            Route::get('create', [LatesController::class, 'create'])->name('create');
            Route::post('store', [LatesController::class, 'store'])->name('store');
            Route::get('/{id}', [LatesController::class, 'edit'])->name('edit');
            Route::patch('/{id}', [LatesController::class, 'update'])->name('update');
            Route::delete('/{id}', [LatesController::class, 'destroy'])->name('delete');
            Route::get('detail/{student_id}', [LatesController::class, 'detail'])->name('detail');
            Route::get('download/{id}', [LatesController::class, 'downloadPDF'])->name('download');
            Route::get('export-excel', [LatesController::class, 'exportExcel'])->name('export-excel');

        });
    });

    Route::middleware(['IsGuru'])->group(function () {

        Route::prefix('/student')->name('ps.student.')->group(function(){
            Route::get('/data/{id}', [StudentsController::class, 'data'])->name('data');
        });

        Route::prefix('/latesPS')->name('ps.lates.')->group(function () {
            Route::get('/rekap', [LatesController::class, 'rekap'])->name('index');
            Route::get('searchPS', [LatesController::class, 'search1'])->name('search1');
            Route::get('/psdetail', [LatesController::class, 'psdetail'])->name('psdetail');
            Route::get('psdownload/{id}', [LatesController::class, 'psdownloadPDF'])->name('psdownload');
            Route::get('psexport-excel', [LatesController::class, 'psexportExcel'])->name('psexport-excel');
        });
    });

});
