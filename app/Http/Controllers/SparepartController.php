<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SparepartController extends Controller
{
    public function index() {
        $spareparts = Sparepart::all();
        $data = [
            'spareparts' => $spareparts
        ];
        return view('sparepart.app', $data);
    }
    
    public function create() {
        return view('sparepart.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Sparepart::create($request->all());
        return redirect()->route('sparepart.index')->with('success', 'Sparepart berhasil ditambahkan.');
    }

    public function edit($id) { 
        $sparepart = Sparepart::findOrFail($id);
        $data = [
            'sparepart' => $sparepart
        ];
        return view('sparepart.edit', $data);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:1',
            'stock' => 'required|integer|min:0',
        ]);
    
        $sparepart = Sparepart::findOrFail($id);
        $sparepart->update($request->all());
    
        return redirect()->route('sparepart.index')->with('success', 'Sparepart berhasil diperbarui.');
    }

    public function destroy($id) {
        $sparepart = Sparepart::findOrFail($id);
        $sparepart->delete();
        
        return redirect()->route('sparepart.index')->with('success', 'Sparepart berhasil dihapus.');   
    }

    public function updateStock(Request $request){
        $validation = $request->validate([
            'sparepart_id' => 'required|exists:spareparts,id',
            'stock_amount' => 'required|integer|min:1',
            'stock_price' => 'required|integer|min:1',
        ]);

        $sparepart = Sparepart::findOrFail($request->sparepart_id);
        $sparepart->increment('stock', $request->stock_amount);

        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'type' => 'outcome',
            'amount' => $request->stock_price * $request->stock_amount,
            'description' => "Pembelian stok untuk {$sparepart->name}",
        ]);
    
        TransactionDetail::create([
            'transaction_id' => $transaction->id,
            'sparepart_id' => $sparepart->id,
            'type' => 'sparepart',
            'qty' => $request->stock_amount,
            'amount' => $request->stock_price * $request->stock_amount,
        ]);
    

        return response()->json(['message' => 'Stok berhasil diperbarui']);
    }

}
