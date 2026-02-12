<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BioDataController;

Route::get('/', [BioDataController::class, 'index'])->name('biodata.index');