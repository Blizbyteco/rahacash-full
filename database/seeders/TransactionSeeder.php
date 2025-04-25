<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

        // Descriptions for income transactions (services)
        $incomeServices = [
            'Ganti oli', 'Penggantian kampas rem', 'Rotasi ban', 'Pemeriksaan aki', 'Tuning mesin',
            'Perbaikan transmisi', 'Penyetelan suspensi', 'Penggantian filter udara', 'Penyelarasan roda', 'Pembersihan sistem bahan bakar'
        ];

        // Descriptions for outcome transactions (expenses)
        $outcomeExpenses = [
            'Pembelian oli mesin', 'Pembelian kampas rem', 'Biaya servis kendaraan',
            'Pengadaan spare part', 'Pembelian filter udara', 'Penggantian aki',
            'Perawatan sistem bahan bakar', 'Pembelian transmisi baru'
        ];

        $transactionDetails = [];

        for ($i = 0; $i < 20; $i++) {
            $randomDate = Carbon::now()->subMonths(rand(1, 5))->subDays(rand(0, 30))
                ->subHours(rand(0, 23))->subMinutes(rand(0, 59))->subSeconds(rand(0, 59));

            // Randomly assign transaction as income or outcome
            $isIncome = rand(0, 1);
            $type = $isIncome ? 'income' : 'outcome';

            $description = $isIncome 
                ? $incomeServices[array_rand($incomeServices)] 
                : $outcomeExpenses[array_rand($outcomeExpenses)];

            $amount = $isIncome 
                ? rand(50000, 500000) 
                : rand(100000, 1000000);

            $transactionId = DB::table('transactions')->insertGetId([
                'user_id' => $users[array_rand($users)], // Random user
                'type' => $type,
                'amount' => $amount,
                'description' => $description,
                'payment' => ['cash', 'transfer', 'qris'][array_rand(['cash', 'transfer', 'qris'])],
                'created_at' => $randomDate,
                'updated_at' => $randomDate,
            ]);

            // If it's an outcome transaction, add spare parts as transaction details
            if (!$isIncome) {
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
        }

        DB::table('transaction_details')->insert($transactionDetails);
    }
}
