<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('chatbot');
})->name('chatbot');

Route::get('/database',  [App\Http\Controllers\DatabaseController::class, 'page'])->name('chatbot');

Route::post('/ask', [App\Http\Controllers\AiApiController::class, 'ask']);
