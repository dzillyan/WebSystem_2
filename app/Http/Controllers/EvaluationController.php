<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Handle GET (show form) and POST (process + display results).
     * Single method for the single /evaluation route.
     */
    public function evaluate(Request $request)
    {
        // GET request — just show the blank form
        if ($request->isMethod('get')) {
            return view('evaluation');
        }

        // POST request — validate, compute, return results
        $request->validate([
            'student_name' => 'required|string|max:100',
            'prelim'       => 'required|numeric|min:0|max:100',
            'midterm'      => 'required|numeric|min:0|max:100',
            'final'        => 'required|numeric|min:0|max:100',
        ]);

        $prelim  = (float) $request->prelim;
        $midterm = (float) $request->midterm;
        $final   = (float) $request->final;

        // Compute average
        $average = ($prelim + $midterm + $final) / 3;

        // Letter grade
        $letterGrade = match (true) {
            $average >= 90 => 'A',
            $average >= 80 => 'B',
            $average >= 70 => 'C',
            $average >= 60 => 'D',
            default        => 'F',
        };

        // Remarks
        $remarks = $average >= 75 ? 'Passed' : 'Failed';

        // Award
        $award = match (true) {
            $average >= 98 => 'With Highest Honors',
            $average >= 95 => 'With High Honors',
            $average >= 90 => 'With Honors',
            default        => 'No Award',
        };

        return view('evaluation', compact(
            'prelim', 'midterm', 'final',
            'average', 'letterGrade', 'remarks', 'award'
        ))->with('student_name', $request->student_name)
          ->with('submitted', true);
    }
}