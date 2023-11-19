<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Category::factory()->create([
            'cate_Name' => 'Sách Ngoại Ngữ'
        ]);
        \App\Models\Category::factory()->create([
            'cate_Name' => 'Sách IT'
        ]);
        \App\Models\Category::factory()->create([
            'cate_Name' => 'Sách Luyện Thi'
        ]);
        \App\Models\Category::factory()->create([
            'cate_Name' => 'Sách Văn Hóa - Địa Lý - Du Lịch'
        ]);



        \App\Models\User::factory()->create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('1'),
            'role' => '1',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'nhanvien',
            'username' => 'nhanvien',
            'email' => 'nhanvien@admin.com',
            'password' => bcrypt('1'),
            'role' => '2',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'nguoidung',
            'username' => 'nguoidung',
            'email' => 'nguoidung@gmail.com',
            'password' => bcrypt('1'),
            'role' => '3',
        ]);
    }
}
