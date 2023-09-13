<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => '管理者',  // お好みの管理者名
            'email' => 'admin@gmail.com',  // 管理者のEメールアドレス
            'password' => Hash::make('admin1234'),  // パスワード (Hash::makeを使用してハッシュ化)
            'role' => 'admin',  // ロールとして'admin'を設定
        ]);
    }
}
