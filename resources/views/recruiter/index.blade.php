<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posted Jobs') }}
        </h2>
    </x-slot>

    <div class="py-12 px-3">
        <div class="relative overflow-x-auto px-3">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Sr. No.</th>
                        <th scope="col" class="px-6 py-3">Title</th>
                        <th scope="col" class="px-6 py-3">Description</th>
                        <th scope="col" class="px-6 py-3">Skills</th>
                        <th scope="col" class="px-6 py-3">Experience</th>
                        <th scope="col" class="px-6 py-3">Applications</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $job)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th class="px-6 py-4">{{ $loop->index + 1 }}</th>
                            <th class="px-6 py-4">{{ $job->title }}</th>
                            <th class="px-6 py-4">{{ $job->description }}</th>
                            <th class="px-6 py-4">{{ implode(',', $job->skill_names) }}</th>
                            <th class="px-6 py-4">{{ $job->years . ' years ' . $job->months . ' months' }}</th>
                            <th class="px-6 py-4">{{ 0 }}</th>
                            <th class="px-6 py-4">Edit</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>        
    </div>
</x-app-layout>
