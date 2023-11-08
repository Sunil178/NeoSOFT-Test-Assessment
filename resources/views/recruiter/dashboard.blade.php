<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex flex-wrap gap-3 items-center justify-center">
            <a href="{{route('job.index')}}" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 w-1/4">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $jobs }}</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">Total Jobs Created</p>
            </a>
            <a href="{{route('job.index')}}" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 w-1/4">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $candidate_jobs }}</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">Total Applications Received</p>
            </a>
        </div>
    </div>
</x-app-layout>
