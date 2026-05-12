<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PdfController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\HtmlController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/url-to-pdf', [PdfController::class, 'urlToPdf']);
Route::get('/url-to-image', [ImageController::class, 'urlToImage']);
Route::get('/url-to-html', [HtmlController::class, 'urlToHtml']);

