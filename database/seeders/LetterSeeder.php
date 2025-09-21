<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Letter;

class LetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Letter::create([
            'nomor_surat' => '2022/PD3/TU/001',
            'kategori' => 'Pengumuman',
            'title' => 'Nota Dinas WFH',
            'description' => 'Surat pengumuman Work From Home untuk perangkat desa.',
            'date' => '2023-06-21',
            'file_path' => 'letters/contoh1.pdf',
        ]);
        Letter::create([
            'nomor_surat' => '2022/PD2/TU/022',
            'kategori' => 'Undangan',
            'title' => 'Undangan Halal Bi Halal',
            'description' => 'Surat undangan acara Halal Bi Halal di desa Karangduren.',
            'date' => '2023-04-21',
            'file_path' => 'letters/contoh2.pdf',
        ]);
    }
}
