<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat akun Super Admin utama
        // must_change_password = false karena Super Admin sudah langsung
        // menetapkan password-nya sendiri sejak awal
        \App\Models\User::create([
            'name'                 => 'Super Admin',
            'email'               => 'admin@rs-elisabeth.com',
            'password'            => \Illuminate\Support\Facades\Hash::make('admin@rs2025'),
            'role'                => 'super_admin',
            'must_change_password' => false,
        ]);

        // Contoh akun Staf dengan password default '123456'
        // (Akan menerima notifikasi peringatan saat login pertama kali)
        \App\Models\User::create([
            'name'                 => 'Staf Humas',
            'email'               => 'humas@rs-elisabeth.com',
            'password'            => \Illuminate\Support\Facades\Hash::make('123456'),
            'role'                => 'staff',
            'must_change_password' => true,
        ]);
    }
}
