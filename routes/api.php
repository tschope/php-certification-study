<?php

use App\Http\Controllers\Api\QuizController;
use Illuminate\Support\Facades\Route;

Route::prefix('quiz')->group(function () {
    Route::post('start', [QuizController::class, 'start']);
    Route::post('{quiz}/answer', [QuizController::class, 'answer']);
    Route::post('{quiz}/finish', [QuizController::class, 'finish']);
    Route::get('{quiz}/review', [QuizController::class, 'review']);
});
