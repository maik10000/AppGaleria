<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\UserController;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->middleware('auth:api')->group(function(){
    
    Route::controller(AuthController::class)->group(function(){
    
        Route::post('register','register')->name('user.register');
        
    });

});


Route::controller(PhotoController::class)->group(function(){

    Route::post('upload-photo','store')->name('photo.upload');
    Route::post('update-photo','update')->name('photo.update');
    Route::delete('delete-photo','destroy')->name('photo.delete');

});

Route::controller(UserController::class)->group(function(){
        
    Route::put('user/edit','update')->name('user.update');
    Route::delete('user/delete','destroy')->name('user.destroy');
    
});

