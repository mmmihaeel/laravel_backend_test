<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\UserController; // Add this

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::get('products/{product}/comments', [CommentController::class, 'index']);
    Route::post('products/{product}/comments', [CommentController::class, 'store']);
    Route::put('comments/{comment}', [CommentController::class, 'update']);
    Route::delete('comments/{comment}', [CommentController::class, 'destroy']);
    Route::apiResource('purchases', PurchaseController::class)->only(['index', 'store', 'show']);
    Route::apiResource('users', UserController::class);  // Add this
});
