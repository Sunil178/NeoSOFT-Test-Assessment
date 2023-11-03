<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected function getSkillsAttribute()
    {
        return JobSkill::where('job_id', $this->id)->pluck('skill_id')->toArray();
    }

    protected function getSkillNamesAttribute()
    {
        return JobSkill::join('skills', 'skills.id', 'job_skills.skill_id')
                        ->where('job_skills.job_id', $this->id)
                        ->pluck('skills.name')
                        ->toArray();
    }
}
