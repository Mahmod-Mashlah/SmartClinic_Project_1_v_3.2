<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory(30)->create();
        \App\Models\Employee::factory(30)->create();
        \App\Models\Clinic::factory(30)->create();
        \App\Models\Doctor::factory(30)->create();
        \App\Models\Patiant::factory(30)->create();
        \App\Models\Secretary::factory(30)->create();
        \App\Models\Lap::factory(30)->create();
        \App\Models\Report::factory(30)->create();
        \App\Models\Treatment::factory(30)->create();
        \App\Models\Visit::factory(30)->create();
        \App\Models\Diagnosis::factory(30)->create();
        \App\Models\BookAdate::factory(30)->create();
        \App\Models\Examination::factory(30)->create();
        \App\Models\Internal_procedures::factory(30)->create();
        \App\Models\Prescription::factory(30)->create();
        \App\Models\Medicine::factory(60)->create();

    }

}
