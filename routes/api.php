<?php

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
    Route::get('/login', function () {
        if (!Auth::check()) {
            Auth::attempt(['email' => 'admin@test.com', 'password' => '123456789']);
        }
    
        return response(['user' => Auth::user()]);
    });

    Route::get('books/{id}', function ($id) {
        return response(['book' => Book::find($id)]);
    })->middleware('scope:show-book');

    Route::get('list', function () {
        return response(['books' => Auth::user()->books]);
    })->middleware('scope:show-list');

    Route::get('/user', function () {
        return response(['user' => Auth::user()]);
    });

    Route::put('/user/name/{name}', function ($name) {
        if(Auth::user()->update(['name' => $name])){
            return response(['updated_user' => Auth::user()]);
        }
    });

});

/*Route::middleware('auth:api')->get('/anime/{id}', function($id) {
    return response(['anime' => anime::find($id)]);
});

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
