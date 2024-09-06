<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ListItemsFavController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\PostApiController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// JWT Or any Auth :
Route::post('register',[UserApiController::class , 'register'] );
Route::post('login',[UserApiController::class , 'loginUser'] );


//List CRUD
Route::post('new-list',[ListItemsFavController::class , 'newListUser']);
Route::post('edit-list/{id}',[ListItemsFavController::class , 'editListUser']);
Route::post('item-list',[ListItemsFavController::class , 'addItemToListUser']);
Route::post('items',[ListItemsFavController::class , 'addItemArrayToListUser']);
Route::post('delete-list',[ListItemsFavController::class , 'deleteTheList']);

//get Data
Route::get('posts',[PostApiController::class , 'allPosts']);
Route::get('mylist',[PostApiController::class , 'allMyList']);