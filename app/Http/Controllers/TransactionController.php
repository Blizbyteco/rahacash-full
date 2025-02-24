<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request) {
        $query = Transaction::with('user');
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay(); 
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $transactions = $query->paginate(10);
        
        $data = [
            'transactions' => $transactions
        ];

        return view('transaction.app', $data);
    }

    public function exportPDF(Request $request) {

        $query = Transaction::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
            $filename = "Laporan_Transaksi_{$request->start_date}_sampai_{$request->end_date}.pdf";
        } else {
            $filename = "Laporan_Seluruh_Transaksi.pdf";
        }
    
        $transactions = $query->get();
        $totalAmount = $transactions->sum('amount');
    
        $data = [
            'transactions' => $transactions,
            'total' => $totalAmount,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];
        
        $pdf = PDF::loadView('transaction.pdf', $data);
        return $pdf->download($filename);
    }   
}
