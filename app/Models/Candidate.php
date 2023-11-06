<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected function getSkillsAttribute()
    {
        return CandidateSkill::where('candidate_id', $this->id)->pluck('skill_id')->toArray();
    }
}
