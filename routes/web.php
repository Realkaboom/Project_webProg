<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CartController;
use App\Models\barang;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\RequestController;

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

Route::controller(UserController::class)->middleware('guest')->group(function () {
    Route::get('/register-form', 'registerform')->name('register');
    Route::post('/registered', 'create')->name('registered');
    Route::get('/login', 'login')->name('login');
    Route::post('/logedin', 'logedin')->name('logedin');
});

Route::post('/logout', [UserController::class, 'Logout'])
    ->name('logout')
    ->middleware('auth');

Route::middleware([\App\Http\Middleware\Authenticate::class, \App\Http\Middleware\WorkerOnly::class])->group(function () {
    Route::controller(BarangController::class)->group(function () {
        Route::get('/viewuser', 'view')->name('viewall');
        Route::get('/barang-user', 'viewUserBarang')->name('user.barang');
    });
    Route::controller(RequestController::class)->group(function () {
        Route::get('/requests/create', 'create')->name('requests.create');
        Route::post('/requests', 'store')->name('requests.store');

        Route::get('/requests/my', 'myRequests')->name('requests.my');

    });
});

Route::middleware([\App\Http\Middleware\Authenticate::class, \App\Http\Middleware\AdminOnly::class])->group(function () {
    Route::controller(BarangController::class)->group(function () {
        Route::get('/viewadmin', 'viewadmin')->name('viewadmin');
    });

    Route::prefix('admin')->group(function () {
        Route::controller(BarangController::class)->group(function () {
            Route::get('/barang', 'viewcreatebarang')->name('viewbarang');
            Route::post('/barangcreated', 'createbarang')->name('create');
            Route::get('/editbarang/{id}', 'editform')->name('editform');
            Route::patch('/edited/{id}', 'edit')->name('edited');
            Route::delete('/delete/{id}', 'delete')->name('delete');
        });
        Route::controller(RequestController::class)->group(function () {
            Route::get('/requests', 'indexAdmin')->name('requests.index');
            Route::post('/requests/{id}/approve', 'approve')->name('requests.approve');
            Route::post('/requests/{id}/reject', 'reject')->name('requests.reject');
        });
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/categories', 'index')->name('categories.index');
            Route::get('/categories/create', 'create')->name('categories.create');
            Route::post('/categories', 'store')->name('categories.store');
            Route::get('/categories/{id}', 'show')->name('categories.show');
            Route::get('/categories/{id}/edit', 'edit')->name('categories.edit');
            Route::patch('/categories/{id}', 'update')->name('categories.update');
            Route::delete('/categories/{id}', 'destroy')->name('categories.destroy');
        });
        Route::controller(SupplierController::class)->group(function () {
            Route::get('/suppliers', 'index')->name('suppliers.index');
            Route::get('/suppliers/create', 'create')->name('suppliers.create');
            Route::post('/suppliers', 'store')->name('suppliers.store');
            Route::get('/suppliers/{id}', 'show')->name('suppliers.show');
            Route::get('/suppliers/{id}/edit', 'edit')->name('suppliers.edit');
            Route::patch('/suppliers/{id}', 'update')->name('suppliers.update');
            Route::delete('/suppliers/{id}', 'destroy')->name('suppliers.destroy');
        });
    });
});

