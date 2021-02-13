<?php

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\adminController;
use App\Http\Controllers\BooksController;


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

Route::get('/', [BooksController::class, 'index']);

//API route
Route::get('/apiclients', function() {
    return view('api', ['clients' => Auth::user()->clients, 'tokens' => Auth::user()->tokens]);
})->middleware('auth')->name('api');

Route::get('list', [BooksController::class, 'booksList'])->name('list')->middleware('auth');
Route::get('cart', [BooksController::class, 'myCart'])->name('myCart')->middleware('auth');
Route::get('add', [BooksController::class, 'addBooks'])->name('addBooks')->middleware('role:admin');
Route::get('checkout', [BooksController::class, 'checkout'])->name('checkout')->middleware(['auth', 'referer']);
Route::get('book/{slug}', [BooksController::class, 'bookDetails'])->name('bookDetails')->middleware('auth');

//admin dashboard routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [adminController::class, 'index'])->name('admin');
    Route::get('orders', [adminController::class, 'orders'])->name('admin_orders');
    Route::get('books', [adminController::class, 'books'])->name('admin_books');
    Route::get('users', [adminController::class, 'users'])->name('admin_users');
    Route::get('newusers', [adminController::class, 'newusers'])->name('admin_newusers');
    Route::get('roles', [adminController::class, 'roles'])->name('admin_roles');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');