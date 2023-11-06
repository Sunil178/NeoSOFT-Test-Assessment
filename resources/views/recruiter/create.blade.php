<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('New Job') }}
        </h2>
    </x-slot>

    <div class="py-12 px-3">
        <form method="POST" id="job-form" action="{{ route('job.store') }}" class="sm:px-6 lg:px-8">
            @csrf
            @include('recruiter.form')
            <x-primary-button class="text-white bg-blue-600 rounded text-sm px-5 py-2.5">
                {{ __('Submit') }}
            </x-primary-button>

        </form>
    </div>
<script>
    $(document).ready(function() {
        $('#job-form').validate({
                rules: {
                    title: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    'skills[]': {
                        required: true,
                    },
                    years: {
                        required: true,
                        number: true,
                        minlength: 0,
                    },
                    months: {
                        required: true,
                        number: true,
                        minlength: 0,
                    },
                },
                messages: {
                    "skills[]": {
                        required: "Any one skills are required",
                    },
                },
            });
        });
</script>
</x-app-layout>
