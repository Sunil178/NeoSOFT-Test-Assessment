<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\CandidateJob;

class HomeController extends Controller
{
    public function dashboard()
    {
        $user = request()->user();
        if ($user->isRecruiter()) {
            return $this->recruiter($user);
        }
        return redirect()->route('candidate.jobs');
    }

    public function recruiter($user) {
        $jobs = Job::where('added_by', $user->id)->count();
        $candidate_jobs = CandidateJob::leftJoin('jobs', 'jobs.id', 'candidate_jobs.job_id')
                                    ->where('jobs.added_by', $user->id)
                                    ->count();
        return view('recruiter.dashboard', [ 'jobs' => $jobs, 'candidate_jobs' => $candidate_jobs ]);
    }
}
