<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::factory()->create([
            'name' => $name = 'Bachelor of Arts in English Language Studies (ABELS)',
            'slug' => Str::slug($name),
        ]);

        Department::factory()->create([
            'name' => $name = 'Bachelor of Science in Accountancy (BSA)',
            'slug' => Str::slug($name),
        ]);

        Department::factory()->create([
            'name' => $name = 'Bachelor of Science in Accounting Information System (BSAIS)',
            'slug' => Str::slug($name),
        ]);

        Department::factory()->create([
            'name' => $name = 'Bachelor of Science in Entrepreneurship (BSE)',
            'slug' => Str::slug($name),
        ]);

        Department::factory()->create([
            'name' => $name = 'Bachelor of Science in Information Technology (BSIT)',
            'slug' => Str::slug($name),
        ]);

        Department::factory()->create([
            'name' => $name = 'Bachelor of Science in Public Administration (BSPA)',
            'slug' => Str::slug($name),
        ]);

        Department::factory()->create([
            'name' => $name = 'Bachelor of Science in Social Work (BSSW)',
            'slug' => Str::slug($name),
        ]);

        Department::factory()->create([
            'name' => $name = 'Bachelor of Technical Vocational Teachers Education (BTVTE)',
            'slug' => Str::slug($name),
        ]);
    }
}
