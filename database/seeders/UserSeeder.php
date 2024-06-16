<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
               // Tạo 50 bản ghi mẫu cho bảng users
               User::factory()->count(50)->create();
    }
}
