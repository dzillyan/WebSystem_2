<?php

use Illuminate\Support\Facades\Route;

// Problem 1: Student Profile Page
Route::get('/student/{id}/{name}', function ($id, $name) {
    return view('student', [
        'id'   => $id,
        'name' => $name,
    ]);
});

// Problem 2: Course Enrollment Page (year level is optional, defaults to "1st Year")
Route::get('/course/{course}/{year?}', function ($course, $year = '1st Year') {
    return view('course', [
        'course' => $course,
        'year'   => $year,
    ]);
});

// Problem 3: OJT Company Information Page (allowance is optional, defaults to "No")
Route::get('/ojt/{company}/{city}/{allowance?}', function ($company, $city, $allowance = 'No') {
    return view('ojt', [
        'company'   => $company,
        'city'      => $city,
        'allowance' => $allowance,
    ]);
});

// Problem 4: Event Registration Page (all parameters are required)
Route::get('/event/{event}/{participant}/{year}', function ($event, $participant, $year) {
    return view('event', [
        'event'       => $event,
        'participant' => $participant,
        'year'        => $year,
    ]);
});