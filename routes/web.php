<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PdfController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/url-to-pdf', [PdfController::class, 'urlToPdf']);

