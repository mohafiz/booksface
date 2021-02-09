<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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

//add admin
Route::get('/addadmin', function () {
    $user = User::find(2);
    $user->assignRole('admin');
});

//API route
Route::get('/apiclients', function() {
    return view('api', ['clients' => Auth::user()->clients, 'tokens' => Auth::user()->tokens]);
})->middleware('auth')->name('api');

Route::get('list', [BooksController::class, 'booksList'])->name('list')->middleware('auth');
Route::get('cart', [BooksController::class, 'myCart'])->name('myCart')->middleware('auth');
Route::get('add', [BooksController::class, 'addBooks'])->name('addBooks')->middleware('role:admin');
Route::get('checkout', [BooksController::class, 'checkout'])->name('checkout')->middleware(['auth', 'referer']);
Route::get('book/{slug}', [BooksController::class, 'bookDetails'])->name('bookDetails')->middleware('auth');

Route::get('admin', [BooksController::class, 'admin'])->name('admin')->middleware(['auth','role:admin']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');