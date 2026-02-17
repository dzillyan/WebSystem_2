<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvaluationController;

Route::any('/evaluation', [EvaluationController::class, 'evaluate'])
    ->name('evaluation');