<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('books', BookController::class);

/*
GET /books               -> index
GET /books/create        -> create form
POST /books              -> store new book
GET /books/{id}/edit     -> edit form
PUT/PATCH /books/{id}    -> update
DELETE /books/{id}       -> delete
*/