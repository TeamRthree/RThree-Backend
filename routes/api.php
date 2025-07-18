<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnquiryController;

Route::post('/enquiry', [EnquiryController::class, 'store']);

