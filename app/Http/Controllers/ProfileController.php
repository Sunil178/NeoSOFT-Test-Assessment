<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Candidate;
use App\Models\CandidateSkill;
use App\Models\Skill;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $skills = Skill::all();
        $candidate = Candidate::where('user_id', $user->id)->firstOrNew();
        return view('profile.edit', [
            'user' => $user,
            'candidate' => $candidate,
            'skills' => $skills,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $candidate = Candidate::where('user_id', $user->id)->firstOrNew();
        $candidate->user_id = $user->id;
        $candidate->years = $request->years;
        $candidate->months = $request->months;
        $candidate->title = $request->title;

        if ($request->hasFile('resume')) {
            deleteDocument($candidate->resume);
            $candidate->resume = storeDocument($request->file('resume'), 'public/resumes');    
        }
        $candidate->save();

        // Store and edit skills - start
        if (isset($request->skills) || $request->skills_og != '[]') {
            $skills_og = json_decode($request->skills_og, true);
            $candidate_skill_deleted_ids = array_diff($skills_og, (array)$request->skills);
            $candidate_skill_ids = array_diff((array)$request->skills, $skills_og);

            foreach ($candidate_skill_deleted_ids as $candidate_skill_deleted_id) {
                CandidateSkill::where(['candidate_id' => $candidate->id, 'skill_id' => $candidate_skill_deleted_id])->delete();
            }

            if (!is_null($request->skills)) {
                foreach ($candidate_skill_ids as $candidate_skill_id) {
                    CandidateSkill::firstOrCreate(['candidate_id' => $candidate->id, 'skill_id' => $candidate_skill_id]);
                }
            }
        }
        // Store and edit skills - end

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        deleteDocument($user->candidate->resume);
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
