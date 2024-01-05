<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::create([
        //     'name' => 'Admin2r',
        //     'email' => 'admin2@gmail.com',
        //     'password' => Hash::make('admin2'),
        //     'role' => 'admin',
        // ]);

        $data = [
            [
                'name' => 'guru_ps',
                'email' => 'guru_ps@gmail.com',
                'password' => Hash::make('guru_ps'),
                'role' => 'ps',
            ],
        ];

        User::insert($data);
    }
}
