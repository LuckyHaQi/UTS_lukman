<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pelanggan')->insert([
            [
                'nama' => 'Alvino',
                'email' => 'Alvino73@gmail.com',
                'no_hp' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Luqman Ananta',
                'email' => 'luqmananta45@gmail.com',
                'no_hp' => '08990337151',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
