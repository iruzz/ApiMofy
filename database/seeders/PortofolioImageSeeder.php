<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PortofolioImage;

class PortofolioImageSeeder extends Seeder
{
    public function run(): void
    {
        PortofolioImage::create([
            'portofolio_id' => 1,
            'image' => 'portofolio/misal.jpg',
        ]);
    }
}
