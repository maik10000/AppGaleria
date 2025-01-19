<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\UserController;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::controller(AuthController::class)->prefix('auth')->middleware('auth:api')->group(function () {
    
    Route::post('me','getProfile')->name('user.profile');
    Route::post('logout','logout')->name('logout');
    Route::post('refresh','refresh')->name('refresh');

});

Route::controller(AuthController::class)->group(function () {

    Route::post('register', 'register')->name('user.register');
    Route::get('login','login')->name('login'); //controlar el acceso por get
    Route::post('login','login')->name('login');
});


Route::controller(PhotoController::class)->prefix('auth/img')->middleware('auth:api')->group(function(){

    Route::post('upload-photo','store')->name('photo.upload');
    Route::post('update-photo','update')->name('photo.update');
    Route::post('delete-photo','destroy')->name('photo.delete');
    Route::get('getPhotos','show')->name('photo.get');
  
});

Route::controller(UserController::class)->prefix('auth')->middleware('auth:api')->group(function(){
        
    Route::put('user/edit','update')->name('user.update');
    Route::delete('user/delete','destroy')->name('user.destroy');
    Route::post('user/reset-password','resetPassw')->name('reset-passw');
    
});

Route::controller(StorageController::class)->prefix('auth/img')->middleware('auth:api')->group(function(){

    Route::get('storage/images/{path}/{filename}','showAuth')->name('storage.local');   

});
