<?php

namespace App\Http\Controllers;

use App\Models\Sale;

class DashboardController extends Controller
{
    public function index()
    {
        $salesData = Sale::selectRaw("
                SUM(amount) as total,
                strftime('%m', sale_date) as month
            ")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthNames = [
            '01' => 'January',
            '02' => 'February',
            '03' => 'March',
            '04' => 'April',
            '05' => 'May',
            '06' => 'June',
            '07' => 'July',
            '08' => 'August',
            '09' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December',
        ];

        $labels = $salesData->pluck('month')->map(function ($month) use ($monthNames) {
            return $monthNames[$month];
        });

        $data = $salesData->pluck('total');

        return view('dashboard', compact('labels', 'data'));
    }
}