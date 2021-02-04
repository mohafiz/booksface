<?php

use App\Models\anime;
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
            Auth::attempt(['email' => 'mohhafiz001@gmail.com', 'password' => 'salihmohamedahmed']);
        }
    
        return response(['user' => Auth::user()]);
    });

    Route::get('anime/{id}', function ($id) {
        return response(['anime' => anime::find($id)]);
    })->middleware('scope:show-anime');

    Route::get('list', function () {
        return response(['animes' => Auth::user()->animes]);
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
