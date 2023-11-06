<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Job') }}
        </h2>
    </x-slot>

    <div class="py-12 px-3">
        <div class="mb-6">
            <label class="block">
                <span class="text-white underline">Title:</span>
                <span class="block text-white mt-1 w-72 p-2.5">
                    {{$job->title}}
                </span>
            </label>
        </div>
        <div class="mb-6">
            <label class="block">
                <span class="text-white underline">Description:</span>
                <span class="block text-white mt-1 w-72 p-2.5">
                    {{$job->description}}
                </span>
            </label>
        </div>
        <div class="mb-6">
            <label class="block">
                <span class="text-white underline">Skills:</span>
                <span class="block text-white mt-1 w-72 p-2.5">
                    {{implode(', ', $job->skill_names)}}
                </span>
            </label>
        </div>
        <div class="mb-6">
            <label class="block">
                <span class="text-white underline">Experience:</span>
                <span class="block text-white mt-1 w-72 p-2.5">
                    {{ $job->years . ' years ' . $job->months . ' months' }}
                </span>
            </label>
        </div>
        @isCandidate
        @if(!isset($applied_job))
            <div class="mb-6">
                <x-primary-button data-modal-target="job-apply-modal" data-modal-toggle="job-apply-modal" type="button" id="apply-job" class="text-white bg-blue-600 rounded text-sm px-5 py-2.5">
                    {{ __('Apply') }}
                </x-primary-button>
                <x-job-apply-modal :job_id="$job->id" />
            </div>
        @endif
        @endisCandidate
    </div>
</x-app-layout>
