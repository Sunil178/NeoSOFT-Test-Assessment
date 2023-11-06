<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Skill;
use App\Models\JobSkill;
use App\Models\CandidateJob;
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
        $this->inputValidate($request);
        $job = new Job();
        $job = $this->upsert($request, $job);

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
        $this->inputValidate($request, $job->id);
        $job = $this->upsert($request, $job);

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

    public function inputValidate(Request $request, $id = null)
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
            'years' => 'Invalid experience',
            'months' => 'Invalid experience',
        ]);
    }

    public function upsert(Request $request, $job)
    {
        $job->title = $request->title;
        $job->description = $request->description;
        $job->years = $request->years;
        $job->months = $request->months;
        $job->added_by = $request->user()->id;
        $job->is_saved = $job->save();

        // Store and edit skills - start
        if (isset($request->skills) || $request->skills_og != '[]') {
            $skills_og = json_decode($request->skills_og, true);
            $job_skill_deleted_ids = array_diff($skills_og, (array)$request->skills);
            $job_skill_ids = array_diff((array)$request->skills, $skills_og);

            foreach ($job_skill_deleted_ids as $job_skill_deleted_id) {
                JobSkill::where(['job_id' => $job->id, 'skill_id' => $job_skill_deleted_id])->delete();
            }

            if (!is_null($request->skills)) {
                foreach ($job_skill_ids as $job_skill_id) {
                    JobSkill::firstOrCreate(['job_id' => $job->id, 'skill_id' => $job_skill_id]);
                }
            }
        }
        // Store and edit skills - end

        return $job;
    }
}
