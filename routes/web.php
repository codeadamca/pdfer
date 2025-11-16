<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PdfController;
use App\Http\Controllers\ImageController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/url-to-pdf', [PdfController::class, 'urlToPdf']);
Route::get('/url-to-image', [ImageController::class, 'urlToImage']);

