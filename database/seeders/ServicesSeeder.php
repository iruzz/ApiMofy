<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Services;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           Services::create([
            'title' => 'Website UMKM',
            'deskripsi' => 'Website modern dan responsif untuk usaha kecil menengah. Desain menarik, SEO optimized, terintegrasi WhatsApp.'
        ]);
    }
}
