<?php

use App\Models\Post;
use \App\Http\Controllers\PostController;
use \App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


//Show ALl Posts
Route::get('/',[PostController::class,'index']);
//SHow create form
Route::get('/posts/create',[PostController::class,'create'])->middleware('auth');
//store Data form
Route::post('/posts',[PostController::class,'store'])->middleware('auth');
//SHow Edit Form
Route::get('posts/{post}/edit',[PostController::class,'edit'])->middleware('auth');
//Update Data Edit
Route::put('/posts/{post}',[PostController::class,'update'])->middleware('auth');
//Delete the data
Route::delete('/posts/{post}',[PostController::class,'destroy'])->middleware('auth');
//Manage Posts
Route::get('/posts/manage',[PostController::class,'manage'])->middleware('auth');
//show Single Post
Route::get('/posts/{post}',[PostController::class,'show']);


//User Register/create Form
Route::get('/register',[UserController::class,'create'])->middleware('guest');
//Create New Users
Route::post('/users',[UserController::class,'store']);
//logout User
Route::post('/logout',[UserController::class,'logout'])->middleware('auth');
//Login User form
Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');
//Login authenticate user
Route::post('/users/authenticate',[UserController::class,'authenticate']);
