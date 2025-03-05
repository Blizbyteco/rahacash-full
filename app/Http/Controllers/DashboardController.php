<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index() {
        $totalIncome = Transaction::where('type', 'income')->sum('amount');
        $totalOutcome = Transaction::where('type', 'outcome')->sum('amount');

        $startDate = now()->subDays(20)->startOfDay();
        $endDate = now()->addDays(10)->endOfDay();

        $transactions = Transaction::whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d');
            });

        $dates = [];
        $incomes = [];
        $outcomes = [];

        for ($i = 20; $i >= -10; $i--) {
            $date = now()->subDays($i)->format('Y-m-d'); 
            $dates[] = now()->subDays($i)->format('M-d'); 
            $incomes[] = isset($transactions[$date]) ? $transactions[$date]->where('type', 'income')->sum('amount') : 0;
            $outcomes[] = isset($transactions[$date]) ? $transactions[$date]->where('type', 'outcome')->sum('amount') : 0;
        }

        $data = [
            'income' => $totalIncome,
            'outcome' => $totalOutcome,
            'dates' => json_encode($dates),
            'incomes' => json_encode($incomes),
            'outcomes' => json_encode($outcomes),
        ];

        return view('dashboard.app', $data);
    }
}
