<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $transactions = json_decode(File::get(database_path('initial_data/transactions.json')));

        foreach ($transactions->transactions as $index => $transaction) {
            $iteration = $index + 1;

            $transformTransactionsData[] = [
                'id' => $iteration,
                'paid_amount' => $transaction?->paidAmount,
                'currency' => $transaction?->Currency,
                'parent_email' => $transaction?->parentEmail,
                'status_code' => $transaction?->statusCode,
                'payment_date' => $transaction?->paymentDate,
                'parent_identification' => $transaction?->parentIdentification,
                'created_at' => now(),
                'user_id' => User::query()->inRandomOrder()->value('id')
            ];
        }

        Transaction::insert($transformTransactionsData);
    }
}
