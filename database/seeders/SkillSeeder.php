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
        Skill::create([ 'name' => 'PHP' ]);
        Skill::create([ 'name' => 'Laravel' ]);
        Skill::create([ 'name' => 'CodeIgniter' ]);
        Skill::create([ 'name' => 'JavaScript' ]);
        Skill::create([ 'name' => 'TypeScript' ]);
        Skill::create([ 'name' => 'React.js' ]);
        Skill::create([ 'name' => 'Angular' ]);
        Skill::create([ 'name' => 'Python' ]);
        Skill::create([ 'name' => 'Django' ]);
        Skill::create([ 'name' => 'Machine Learning' ]);
        Skill::create([ 'name' => 'Ruby' ]);
        Skill::create([ 'name' => 'Rust' ]);
        Skill::create([ 'name' => 'Java' ]);
        Skill::create([ 'name' => 'Spring Boot' ]);
        Skill::create([ 'name' => 'C' ]);
        Skill::create([ 'name' => 'C++' ]);
        Skill::create([ 'name' => 'C#' ]);
        Skill::create([ 'name' => '.Net' ]);
        Skill::create([ 'name' => 'Flutter' ]);
        Skill::create([ 'name' => 'Swift' ]);
        Skill::create([ 'name' => 'MySQL' ]);
        Skill::create([ 'name' => 'Microsoft SQL Server' ]);
        Skill::create([ 'name' => 'PostgreSQL' ]);
        Skill::create([ 'name' => 'MongoDB' ]);
        Skill::create([ 'name' => 'CockroachDB' ]);
        Skill::create([ 'name' => 'Git' ]);
        Skill::create([ 'name' => 'Linux' ]);
        Skill::create([ 'name' => 'Docker' ]);
    }
}
