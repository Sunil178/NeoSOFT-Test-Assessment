<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Hey, you got a candidate for the job title ' . $title) }}
    </div>

    <div class="mt-4">
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
                <span class="text-white underline">View Applicant:</span>
                <span class="block text-white mt-1 w-72 p-2.5">
                    <x-link-button href="{{ route('job.user', [ $candidate_job_id, $user->id ]) }}" target="_blank" class="mt-4" >{{ __('View') }}</x-link-button>
                </span>
            </label>
        </div>
    </div>
</x-guest-layout>
