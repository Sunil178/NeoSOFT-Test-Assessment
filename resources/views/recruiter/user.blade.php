<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View User') }}
        </h2>
    </x-slot>

    <div class="py-12 px-3">
        <div class="mb-6">
            <label class="block">
                <span class="text-white underline">Name:</span>
                <span class="block text-white mt-1 w-72 p-2.5">
                    {{$user->first_name . ' ' . $user->last_name}}
                </span>
            </label>
        </div>
        <div class="mb-6">
            <label class="block">
                <span class="text-white underline">Email:</span>
                <span class="block text-white mt-1 w-72 p-2.5">
                    {{$user->email}}
                </span>
            </label>
        </div>
        <div class="mb-6">
            <label class="block">
                <span class="text-white underline">Title:</span>
                <span class="block text-white mt-1 w-72 p-2.5">
                    {{$user->candidate->title}}
                </span>
            </label>
        </div>
        <div class="mb-6">
            <label class="block">
                <span class="text-white underline">Skills:</span>
                <span class="block text-white mt-1 w-full p-2.5">
                    {{implode(', ', $user->candidate->skill_names)}}
                </span>
            </label>
        </div>
        <div class="mb-6">
            <label class="block">
                <span class="text-white underline">Headline:</span>
                <span class="block text-white mt-1 w-full p-2.5">
                    {{$candidate_job->headline}}
                </span>
            </label>
        </div>
        <div class="mb-6">
            <label class="block">
                <span class="text-white underline">Cover Letter:</span>
                <span class="block text-white mt-1 w-full p-2.5">
                    {{$candidate_job->cover_letter}}
                </span>
            </label>
        </div>
        <div class="mb-6">
            <label class="block">
                <span class="text-white underline">Experience:</span>
                <span class="block text-white mt-1 w-full p-2.5">
                    {{ $user->candidate->years . ' years ' . $user->candidate->months . ' months' }}
                </span>
            </label>
        </div>
        <div class="mb-6">
            <label class="block">
                <span class="text-white underline">Resume:</span>
                <span class="block text-white mt-1 w-full p-2.5">
                    <x-link-button href="{{ asset($user->candidate->resume) }}" target="_blank" class="mt-4" >{{ __('View') }}</x-link-button>
                </span>
            </label>
        </div>
        @isCandidate
            @if(!isset($applied_job))
                <div class="mb-6">
                    <x-primary-button data-modal-target="job-apply-modal" data-modal-toggle="job-apply-modal" type="button" id="apply-job" class="text-white bg-blue-600 rounded text-sm px-5 py-2.5">
                        {{ __('Apply') }}
                    </x-primary-button>
                    <x-job-apply-modal :job_id="$user->id" />
                </div>
            @endif
        @endisCandidate
    </div>
</x-app-layout>
