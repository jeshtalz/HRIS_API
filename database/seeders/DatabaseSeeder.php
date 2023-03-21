<?php

namespace Database\Seeders;

use App\Models\Holiday;
use App\Models\Position;
use App\Models\QualificationStandard;
use App\Models\SalaryGrade;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Holiday::factory(10)->create();
        SalaryGrade::factory(33)->create();
        Position::factory(33)->create();
        QualificationStandard::factory(33)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
