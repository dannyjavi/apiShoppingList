<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TaskController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('products/{product}',[ProductController::class,'show'])->name('api.v1.products.show');
Route::get('products',[ProductController::class,'index'])->name('api.v1.products.index');
Route::post('products',[ProductController::class,'store'])->middleware('guest')->name('api.v1.products.store');

Route::put('products/{product}',[ProductController::class,'update'])->middleware('guest')->name('api.v1.products.update');
Route::patch('products/{product}',[ProductController::class,'update'])->middleware('guest')->name('api.v1.products.update');

Route::delete('products/{product}',[ProductController::class,'delete'])->middleware('guest')->name('api.v1.products.delete');



Route::get('tasks', [TaskController::class, 'index'])->name('api.v1.tasks.index');

Route::get('tasks/{task}', [TaskController::class, 'show'])->name('api.v1.tasks.show');

Route::post('tasks', [TaskController::class,'store'])->name('api.v1.tasks.store');

Route::patch('tasks/{task}', [TaskController::class, 'update'])->name('api.v1.tasks.update');

Route::put('tasks/{task}', [TaskController::class, 'update'])->name('api.v1.tasks.update');

Route::delete('tasks/{task}', [TaskController::class, 'delete'])->middleware('guest')->name('api.v1.tasks.delete');

