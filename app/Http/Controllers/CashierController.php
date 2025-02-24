<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        $spareparts = Sparepart::all();
        $data = [
            'spareparts' => $spareparts
        ];
        return view('cashier.app', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_price' => 'nullable|integer|min:0',
            'service_description' => 'nullable|string|max:255',
            'sparepart_qtys' => 'nullable|array',
            'payment_method' => 'required|string',
            'total_amount' => 'required|integer|min:0',
        ]);

        $transaction = Transaction::create([
            'user_id' => 1,
            'type' => 'income',
            'amount' => $request->total_amount, 
            'description' => $request->service_description ?? 'Pembayaran sparepart',
            'payment' => $request->payment_method
        ]);

        if ($request->service_price > 0) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'type' => 'service',
                'qty' => 1,
                'amount' => $request->service_price,
            ]);
        }

        if ($request->has('sparepart_qtys')) {
            foreach ($request->sparepart_qtys as $sparepartId => $qty) {
                $sparepart = Sparepart::find($sparepartId);

                if($sparepart) {
                    if (!$sparepart->checkStock($qty)) {
                        return redirect()->back()->with('error', "Stok {$sparepart->name} tidak mencukupi!");
                    }

                    $sparepart->reduceStock($qty);

                    TransactionDetail::create([
                        'transaction_id' => $transaction->id,
                        'sparepart_id' => $sparepartId,
                        'type' => 'sparepart',
                        'qty' => $qty,
                        'amount' => Sparepart::find($sparepartId)->price * $qty,
                    ]);
                }
            }
        }

        return redirect('/')->with('success', 'Transaksi berhasil disimpan!');
    }
}
