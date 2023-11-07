<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CandidateJob;
use App\Models\Job;
use Illuminate\Support\Facades\DB;

class CandidateController extends Controller
{
    /**
     * Display a listing of all jobs.
     */
    public function jobs()
    {
        $jobs = Job::select('jobs.*')
                    ->leftJoin('candidate_jobs', 'candidate_jobs.job_id', 'jobs.id')
                    ->where('candidate_jobs.user_id', '!=', request()->user()->id)
                    ->orWhereNull('candidate_jobs.job_id')
                    ->get();
        return view('recruiter.index', [ 'jobs' => $jobs, 'title' => 'Jobs Available' ]);
    }

    /**
     * Display the specified job.
     */
    public function job(string $id)
    {
        $job = Job::findOrNew($id);
        $applied_job = CandidateJob::where([
                            'user_id' => request()->user()->id,
                            'job_id' => $id,
                        ])->first();
        return view('recruiter.view', [ 'job' => $job, 'applied_job' => $applied_job]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function applyJob(Request $request)
    {
        $request->validate([
            'job_id' => [ 'required', 'numeric' ],
            'headline' => [ 'required', 'string' ],
            'cover_letter' => [ 'required', 'string' ],
        ]);
        $user_id = $request->user()->id;
        $candidate_job = CandidateJob::where([
                            'user_id' => $user_id,
                            'job_id' => $request->job_id,
                        ])->first();
        if ($candidate_job) {
            return back()->withInput()->withErrors(['status' => 'Provided job is already applied']);
        }
        CandidateJob::create([
            'user_id' => $user_id,
            'job_id' => $request->job_id,
            'headline' => $request->headline,
            'cover_letter' => $request->cover_letter,
        ]);
        return redirect()->route('candidate.applied')->withSuccess('Job applied successfully');
    }

    /**
     * Show the list of applied resource.
     */
    public function jobsApplied()
    {
        $jobs = Job::select('jobs.*', DB::raw('candidate_jobs.created_at AS applied_on'))
                    ->join('candidate_jobs', 'candidate_jobs.job_id', 'jobs.id')
                    ->where('user_id', request()->user()->id)
                    ->get();
        return view('recruiter.index', [ 'jobs' => $jobs, 'title' => 'Applied Jobs' ]);
    }
}
