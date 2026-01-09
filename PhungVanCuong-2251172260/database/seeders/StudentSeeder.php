<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\School;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $schools = School::all();

        foreach ($schools as $school) {
            for ($i = 1; $i <= 20; $i++) {
                Student::create([
                    'school_id' => $school->id,
                    'full_name' => "Sinh viên $i",
                    'student_id' => "SV{$school->id}$i",
                    'email' => "sv{$school->id}$i@gmail.com",
                    'phone' => "0987654$i"
                ]);
            }
        }
    }
}
