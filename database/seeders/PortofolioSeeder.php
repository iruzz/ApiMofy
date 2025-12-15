<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Portofolio;

class PortofolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Portofolio::create([
        'title' => 'Bakmi Ayam',
        'client' => 'PT TELKOM',
        'deskripsi' => 'hayyuk',
        'tanggal_projek' => '2025-08-17'
        ]);
    }
}
