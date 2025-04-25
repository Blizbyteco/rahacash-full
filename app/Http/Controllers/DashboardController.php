<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get selected month and year
        $selectedMonth = $request->query('month', now()->format('m')); // Default: current month
        $selectedYear = $request->query('year', now()->format('Y'));   // Default: current year

        // Construct the start and end date based on selection
        $startDate = Carbon::createFromFormat('Y-m-d', "$selectedYear-$selectedMonth-01")->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();

        // Fetch transactions within the selected month
        $transactions = Transaction::whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->groupBy(function ($transaction) {
                return Carbon::parse($transaction->created_at)->format('Y-m-d');
            });

        $dates = [];
        $incomes = [];
        $outcomes = [];

        for ($i = 0; $i <= $endDate->diffInDays($startDate); $i++) {
            $date = $startDate->copy()->addDays($i)->format('Y-m-d');
            $dates[] = $startDate->copy()->addDays($i)->format('M-d');
            $incomes[] = isset($transactions[$date]) ? $transactions[$date]->where('type', 'income')->sum('amount') : 0;
            $outcomes[] = isset($transactions[$date]) ? $transactions[$date]->where('type', 'outcome')->sum('amount') : 0;
        }

        return view('dashboard.app', [
            'income' => Transaction::where('type', 'income')->sum('amount'),
            'outcome' => Transaction::where('type', 'outcome')->sum('amount'),
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear,
            'dates' => json_encode($dates),
            'incomes' => json_encode($incomes),
            'outcomes' => json_encode($outcomes),
        ]);
    }
}
