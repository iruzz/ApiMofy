<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Settings::create([
            'site_title' => 'Mofy',
            'address' => 'Nginden Semolo',
            'email_contact' => 'rabbaniruzz45@gmail.com',
            'li' => 'mofy comp',
            'instagram' => 'mofy.io',
            'facebook' => 'mofy'
        ]);
    }
}
