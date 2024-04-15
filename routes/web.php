<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
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

Route::get('/', function () {

    return view('dashboard',[
        "title"=>"Dashboard"
    ]);
});

Route::resource('kategori',CategoryController::class)
->except('show','destroy','create')->middleware('auth');

route::resource('pelanggan',CustomerController::class)->except('destroy')->middleware('auth');
route::resource('produk',ProductController::class)->middleware('auth');
route::resource('pengguna',UserController::class)->except('destroy','create','show','update','edit')->middleware('auth');
route::get('login',[LoginController::class,'loginView'])->name('login');
route::post('login',[LoginController::class,'authenticate']);
route::post('logout',[LoginController::class,'logout'])->middleware('auth');   