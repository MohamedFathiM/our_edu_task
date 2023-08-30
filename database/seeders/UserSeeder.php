<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = json_decode(File::get(database_path('initial_data/users.json')));

        foreach ($users->users as $index => $user) {
            $iteration = $index + 1;

            $transformUsersData[] = [
                'id' => $iteration,
                'name' => "user$iteration",
                'email' => $user?->email,
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'balance' => $user?->balance,
                'currency' => $user?->currency,
                'created_at' => Carbon::createFromFormat('d/m/Y', $user->created_at),
                'uuid' => $user?->id,
                'created_at' => now()
            ];
        }

        User::insert($transformUsersData);
    }
}
