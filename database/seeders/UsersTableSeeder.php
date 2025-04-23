<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username'     => 'Test User',                      // ユーザー名
            'email'    => 'test@example.com',          // メールアドレス
            'password' => Hash::make('secret_password'), // 暗号化したパスワード
        ]);
    }
}
