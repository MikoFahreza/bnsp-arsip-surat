<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::create([
            'name' => 'Pengumuman',
            'description' => 'Surat-surat yang terkait dengan pengumuman',
        ]);
        \App\Models\Category::create([
            'name' => 'Undangan',
            'description' => 'Undangan rapat, koordinasi, dlsb.',
        ]);
        \App\Models\Category::create([
            'name' => 'Nota Dinas',
            'description' => 'Surat nota dinas resmi',
        ]);
        \App\Models\Category::create([
            'name' => 'Pemberitahuan',
            'description' => 'Surat pemberitahuan kepada pihak terkait',
        ]);
    }
}
