<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\CloudinarySyncController;

Route::post('/media/store', [MediaController::class, 'store']);
Route::get('/media', [MediaController::class, 'index']);

Route::post('/enquiry', [EnquiryController::class, 'store']);

Route::get('/sync-cloudinary-images', [CloudinarySyncController::class, 'sync']);


Route::get('/test-deploy', function () {
    return response()->json(['message' => 'Deployment works!']);
});
