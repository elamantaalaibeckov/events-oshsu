<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Если пользователь уже есть, не создаём дубликат.
        User::firstOrCreate(
            ['email' => 'student@oshsu.kg'],
            [
                'name' => 'Student',
                'password' => Hash::make('student12345'),
                'role' => 'student',
            ]
        );

        // Создаём админа для доступа к админ-панели.
        User::firstOrCreate(
            ['email' => 'admin@oshsu.kg'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin12345'),
                'role' => 'admin',
            ]
        );
    }
}
