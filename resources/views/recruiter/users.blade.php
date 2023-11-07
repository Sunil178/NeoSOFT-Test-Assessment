<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __($title ?? 'Job Applied Applicants') }}
        </h2>
    </x-slot>

    <x-error-alert class="mb-4" :status="$errors->any()" />
    <x-success-alert class="mb-4" />

    <div class="py-12 px-3">
        <div class="relative overflow-x-auto px-3">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Sr. No.</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Title</th>
                        <th scope="col" class="px-6 py-3">Skills</th>
                        <th scope="col" class="px-6 py-3">Experience</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($candidate_jobs as $candidate_job)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th class="px-6 py-4">{{ $loop->index + 1 }}</th>
                            <th class="px-6 py-4">{{ $candidate_job->user->first_name . ' ' . $candidate_job->user->last_name }}</th>
                            <th class="px-6 py-4">{{ $candidate_job->user->email }}</th>
                            <th class="px-6 py-4">{{ $candidate_job->user->candidate->title }}</th>
                            <th class="px-6 py-4">{{ implode(', ', $candidate_job->user->candidate->skill_names) }}</th>
                            <th class="px-6 py-4">{{ $candidate_job->user->candidate->years . ' years ' . $candidate_job->user->candidate->months . ' months' }}</th>
                            <th class="px-6 py-4">
                                <x-link-button href="{{ route('job.user', [ $candidate_job->id, $candidate_job->user->id ]) }}" class="mt-2" >{{ __('View') }}</x-link-button>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>        
    </div>
</x-app-layout>
