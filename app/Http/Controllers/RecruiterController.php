<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Skill;
use App\Models\JobSkill;
use App\Models\CandidateJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;

class RecruiterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $applications = CandidateJob::select('job_id', DB::raw('COUNT(user_id) as applications'))
                                    ->groupBy('job_id');
        $jobs = Job::leftJoinSub($applications, 'candidate_jobs', function (JoinClause $join) {
                        $join->on('jobs.id', '=', 'candidate_jobs.job_id');
                    })->where('added_by', $user_id)->get();
        return view('recruiter.index', [ 'jobs' => $jobs ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $job = new Job();
        $skills = Skill::all();
        return view('recruiter.create', [ 'skills' => $skills, 'job' => $job ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => [ 'required', 'string' ],
            'description' => [ 'required', 'string' ],
            'skills' => [ 'required', 'array' ],
            'skills.*' => [ 'required', 'numeric' ],
            'years' => [ 'required', 'numeric', 'min:0' ],
            'months' => [ 'required', 'numeric', 'min:0' ],
        ], [
            'skills.array' => 'Invalid skills',
            'skills.*.numeric' => 'Invalid skills',
            'years.numeric' => 'Invalid experience',
            'months.numeric' => 'Invalid experience',
        ]);

        $job = new Job();
        $job->title = $request->title;
        $job->description = $request->description;
        $job->years = $request->years;
        $job->months = $request->months;
        $job->added_by = $request->user()->id;
        $job->is_saved = $job->save();

        // Store skills - start
        if (isset($request->skills)) {
            foreach ($request->skills as $skill_id) {
                JobSkill::create(['job_id' => $job->id, 'skill_id' => $skill_id]);
            }
        }
        // Store skills - end

        if ($job->is_saved)
            return redirect()->route('job.index')->withSuccess('Job post created sucessfully');

        return back()->withInput()->withErrors('Something went wrong');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view('recruiter.view', ['job' => $job]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        $skills = Skill::all();
        return view('recruiter.edit', [ 'skills' => $skills, 'job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => [ 'required', 'string' ],
            'description' => [ 'required', 'string' ],
            'skills' => [ 'required', 'array' ],
            'skills.*' => [ 'required', 'numeric' ],
            'years' => [ 'required', 'numeric', 'min:0' ],
            'months' => [ 'required', 'numeric', 'min:0' ],
        ], [
            'skills.array' => 'Invalid skills',
            'skills.*.numeric' => 'Invalid skills',
            'years.numeric' => 'Invalid experience',
            'months.numeric' => 'Invalid experience',
        ]);

        $job->title = $request->title;
        $job->description = $request->description;
        $job->years = $request->years;
        $job->months = $request->months;
        $job->added_by = $request->user()->id;
        $job->is_saved = $job->save();

        // Edit skills - start
        if (isset($request->skills) || $request->skills_og != '[]') {
            $skills_og = json_decode($request->skills_og, true);                        // get the previous original skills
            $job_skill_deleted_ids = array_diff($skills_og, (array)$request->skills);   // get the deleted skills
            $job_skill_ids = array_diff((array)$request->skills, $skills_og);           // get the added skills

            // First delete all the removed skills
            foreach ($job_skill_deleted_ids as $job_skill_deleted_id) {
                JobSkill::where(['job_id' => $job->id, 'skill_id' => $job_skill_deleted_id])->delete();
            }

            // Add new skills
            if (!is_null($request->skills)) {
                foreach ($job_skill_ids as $job_skill_id) {
                    JobSkill::firstOrCreate(['job_id' => $job->id, 'skill_id' => $job_skill_id]);
                }
            }
        }
        // Edit skills - end

        if ($job->is_saved)
            return redirect()->route('job.index')->withSuccess('Job post updated sucessfully');

        return back()->withInput()->withErrors('Something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
         if ($job->delete())
            return back()->withSuccess('Job post deleted successfully');

        return back()->withErrors('Something went wrong');
    }

    public function users(Job $job) {
        if ($job->added_by != request()->user()->id) {
            return redirect(401);
        }
        $candidate_jobs = CandidateJob::with([ 'user', 'user.candidate' ])
                                    ->where('job_id', $job->id)
                                    ->get();
        return view('recruiter.users', [ 'candidate_jobs' => $candidate_jobs ]);
    }

    public function user(CandidateJob $candidate_job, User $user) {
        $job = Job::join('candidate_jobs', 'candidate_jobs.job_id', 'jobs.id')
                ->where('candidate_jobs.id', $candidate_job->id)
                ->where('candidate_jobs.user_id', $user->id)
                ->where('jobs.added_by', request()->user()->id)
                ->first();
        if (!$job) {
            return redirect(401);
        }
        return view('recruiter.user', [ 'user' => $user, 'candidate_job' => $candidate_job ]);
    }
}
