<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transactions')->truncate();
        DB::table('transaction_details')->truncate();
        
        $users = DB::table('users')->pluck('id')->toArray();
        $spareparts = DB::table('spareparts')->get(['id', 'price']);
        
        $services = [
            'Ganti oli', 'Penggantian kampas rem', 'Rotasi ban', 'Pemeriksaan aki', 'Tuning mesin', 
            'Perbaikan transmisi', 'Penyetelan suspensi', 'Penggantian filter udara', 'Penyelarasan roda', 'Pembersihan sistem bahan bakar'
        ];

        $transactions = [];
        $transactionDetails = [];

        for ($i = 0; $i < 20; $i++) {
            $randomDate = Carbon::now()->subMonths(rand(1, 5))->subDays(rand(0, 30))->subHours(rand(0, 23))->subMinutes(rand(0, 59))->subSeconds(rand(0, 59));
            
            $transactionId = DB::table('transactions')->insertGetId([
                'user_id' => 2,
                'type' => 'income',
                'amount' => rand(50000, 500000),
                'description' => $services[array_rand($services)],
                'payment' => ['cash', 'trasnfer', 'qris'][array_rand(['cash', 'trasnfer', 'qris'])],
                'created_at' => $randomDate,
                'updated_at' => $randomDate,
            ]);

            for ($j = 0; $j < rand(1, 5); $j++) {
                $sparepart = $spareparts->random();
                $qty = rand(1, 5);
                
                $transactionDetails[] = [
                    'transaction_id' => $transactionId,
                    'sparepart_id' => $sparepart->id,
                    'type' => 'sparepart',
                    'qty' => $qty,
                    'amount' => $sparepart->price * $qty,
                    'created_at' => $randomDate,
                    'updated_at' => $randomDate,
                ];
            }
        }

        
        DB::table('transaction_details')->insert($transactionDetails);
    }
}


