<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\School;   

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        School::insert([
            ['name' => 'ĐH Bách Khoa', 'address' => 'Hà Nội'],
            ['name' => 'ĐH Công Nghệ', 'address' => 'Hà Nội'],
            ['name' => 'ĐH Kinh Tế', 'address' => 'Hà Nội'],
        ]);
    }
}
