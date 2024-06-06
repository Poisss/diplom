<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function(){
    Route::prefix('/admin')->group(function(){
        Route::middleware('checkRole:admin')->group(function(){
            Route::get('/form',[FormController::class,'index'])->name('index');
            Route::get('/form/{form}',[FormController::class,'show'])->name('show');
            Route::post('/form',[FormController::class,'store'])->name('store');
            Route::get('/form/{form}/edit',[FormController::class,'edit'])->name('edit');
            Route::delete('/form/{form}/delete',[FormController::class,'destroy'])->name('destroy');
            Route::patch('/access/{form}/patch',[FormController::class,'patch'])->name('patch');//изменить

            Route::post('/page',[FormController::class,'storepage'])->name('storepage');
            Route::delete('/page/{page}/delete',[FormController::class,'destroypage'])->name('destroypage');

            Route::get('/image',[ImageController::class,'index'])->name('indeximage');
            Route::get('/image/create',[ImageController::class,'create'])->name('createimage');
            Route::post('/images',[ImageController::class,'store'])->name('storeimage');
            Route::delete('/image/delete/{image}',[ImageController::class,'destroy'])->name('destroyimage');

            Route::get('form/export/{form}',[FormController::class,'export'])->name('export');
        });
    });
    Route::prefix('/user')->group(function(){
        Route::get('/profile',[UserController::class,'profile'])->name('profile');
        Route::patch('/password/patch',[UserController::class,'passwordpatch'])->name('passwordpatch');
        Route::patch('/photo/patch',[UserController::class,'photopatch'])->name('photopatch');
    });
});

Route::get('/',[UserController::class,'home'])->name('home');

Route::get('/signin',[UserController::class,'signin'])->name('signin');
Route::post('/login',[UserController::class,'login'])->name('login');

Route::get('/signup',[UserController::class,'create'])->name('signup');
Route::post('/logup',[UserController::class,'store'])->name('logup');

Route::get('/logout',[UserController::class, 'logout'])->name('logout');

Route::get('/form',[FormController::class,'indexfrom'])->name('indexfrom');

Route::get('/form/{form}',[FormController::class,'showform'])->name('showform');
Route::post('/form',[FormController::class,'questionnaire'])->name('questionnaire');
Route::get('/form/{form}/success',[FormController::class,'successform'])->name('successform');



