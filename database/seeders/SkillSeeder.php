<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamps = \Carbon\Carbon::now();
        Skill::insert([
            [ 'name' => 'PHP', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'Laravel', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'CodeIgniter', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'JavaScript', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'TypeScript', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'React.js', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'Angular', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'Python', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'Django', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'Machine Learning', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'Ruby', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'Rust', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'Java', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'Spring Boot', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'C', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'C++', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'C#', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => '.Net', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'Flutter', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'Swift', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'MySQL', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'Microsoft SQL Server', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'PostgreSQL', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'MongoDB', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'CockroachDB', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'Git', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'Linux', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
            [ 'name' => 'Docker', 'created_at' => $timestamps, 'updated_at' => $timestamps ],
        ]);
    }
}
