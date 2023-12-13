<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Customer\IndexController;
use App\Http\Controllers\InstrumentController;
use App\Http\Controllers\LogController;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group whichs
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// });






Route::get('/', [IndexController::class, 'landing']);
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});

// Route::get('/category/{categories}', [InstrumentController::class, 'instrumentCategory']);
Route::get('/category/{category}', [InstrumentController::class, 'instrumentCategory'])->name('instrument.category');

Route::get('/login', [AuthController::class , 'loginForm'])->name('login');
Route::post('/',[AuthController::class, 'login']);
Route::get('/register', [AuthController::class , 'registerForm']);
Route::post('/register', [AuthController::class , 'register'])->name('register');
Route::get('/verification/{user}/{token}', [AuthController::class, 'verification']);



Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth','verified'])->group (function(){

    Route::middleware('can:manage-all')->group(function () {

        Route::get('/dashboard', [AuthController::class, 'dashboard']);
        // Instruments Routes
        Route::resource('instruments', InstrumentController::class);
        // Categories Routes
        Route::resource('categories', CategoryController::class);

        Route::get('/users', [IndexController::class, 'allUser']);
        Route::get('/all-orders', [OrderController::class, 'index']);
        Route::get('/orders/edit', [OrderController::class, 'editOrder']);
        // Route::put('/orders/edit/{order}', [OrderController::class, 'updateOrder'])->name('orders.edit');
        Route::put('/orders/receive/{order}', [OrderController::class, 'receiveOrder'])->name('orders.receive');

        Route::get('/categories/result/search', [CategoryController::class, 'searchCategory'])->name('categories.search');
        Route::get('/instruments/result/search', [InstrumentController::class, 'searchInstrument'])->name('instruments.search');

        Route::get('/logs', [LogController::class, 'index']);
    });

    Route::middleware('can:customer')->group(function () {

        //create orders route
        Route::put('/orders/edit/{order}', [OrderController::class, 'updateOrder'])->name('orders.edit');
        Route::delete('/orders/{orders}', [OrderController::class, 'deleteOrder'])->name('orders.delete');
        Route::post('/orders/{instrument}', [OrderController::class, 'createOrder'])->name('orders.create');
        Route::get('/my_orders/{user}', [OrderController::class, 'userOrders'])->name('orders.user');

    });

});


