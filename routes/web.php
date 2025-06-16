<?php

use App\Http\Controllers\ResumeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ResumeController::class, 'index']);
Route::post('/download', [ResumeController::class, 'download']);
