<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" id="profile-form" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->first_name)" required autofocus autocomplete="first_name" />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <div>
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)" required autocomplete="last_name" />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- For Recruiter only --}}
        @isRecruiter
            <div>
                <x-input-label for="company" :value="__('Company')" />
                <x-text-input id="company" name="company" type="text" class="mt-1 block w-full" :value="old('company', $user->company)" required autocomplete="company" />
                <x-input-error class="mt-2" :messages="$errors->get('company')" />
            </div>
        {{-- For Recruiter only --}}
        @else
        {{-- For Candidate only --}}
            <div>
                <label class="text-white">Experience</label>
                <div class="flex flex-wrap gap-2">
                    <div>
                        <x-input-label for="years" :value="__('Years')" />
                        <x-text-input id="years" name="years" type="text" class="mt-1 block w-full" :value="old('years', $candidate->years)" autocomplete="years" />
                        <x-input-error class="mt-2" :messages="$errors->get('years')" />
                    </div>
                    <div>
                        <x-input-label for="months" :value="__('months')" />
                        <x-text-input id="months" name="months" type="text" class="mt-1 block w-full" :value="old('months', $candidate->months)" autocomplete="months" />
                        <x-input-error class="mt-2" :messages="$errors->get('months')" />
                    </div>
                </div>
            </div>

            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $candidate->title)" autocomplete="title" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>

            <div>
                <label class="block">
                    <span class="text-white">Skills</span>
                    <input type="hidden" name="skills_og" value="{{ json_encode($candidate->skills) }}">
                    <select id="select-skills" name="skills[]" multiple placeholder="Select skills..."
                        autocomplete="off"
                        class="block @error('skills') border-red-500 @enderror w-96 rounded-sm cursor-pointer focus:outline-none">
                        @foreach ($skills as $skill)
                            <option
                                value="{{ $skill->id }}"
                                {{ !is_null($candidate->skills) && in_array($skill->id, old('skills', $candidate->skills)) ? 'selected' : '' }}
                            >
                            {{ $skill->name }}
                            </option>
                        @endforeach
                    </select>
                </label>
                <x-input-error :messages="$errors->get('skills')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="resume" :value="__('Resume')" class="mb-3"/>
                @isset($candidate->resume)
                    <x-link-button href="{{ asset($candidate->resume) }}" target="_blank" class="mt-4" >{{ __('View') }}</x-link-button>
                @endisset
                <input class="block mt-4 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="resume" name="resume" type="file" accept="image/*,application/pdf">
                <x-input-error class="mt-2" :messages="$errors->get('resume')" />
            </div>
    
        @endisRecruiter
        {{-- For Candidate only --}}

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
    new TomSelect('#select-skills');

    $(document).ready(function() {
        $.validator.addMethod("regex", function(value, element, regexp) {
                if (regexp.constructor != RegExp)
                    regexp = new RegExp(regexp);
                else if (regexp.global)
                    regexp.lastIndex = 0;
                return this.optional(element) || regexp.test(value);
            }, "Invalid regex");

        $.validator.addMethod("letters", function(value, element) {
            return this.optional(element) || value == value.match(/^[a-zA-Z\s]*$/);
        }, "Characters only");

        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size / 1024 / 1024 <= param)
        }, 'File size must be less than {0}');

        $('#profile-form').validate({
                rules: {
                    first_name: {
                        required: true,
                        letters: true,
                    },
                    last_name: {
                        required: true,
                        letters: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    username: {
                        required: true,
                        regex: /^[\w.]+$/i,
                    },
                    password: {
                        required: true,
                        minlength: 8,
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 8,
                        equalTo: "#password"
                    },
                    @isRecruiter
                    company: {
                        required: true,
                    },
                    @else
                    years: {
                        number: true,
                        min: 0,
                    },
                    months: {
                        number: true,
                        min: 0,
                    },
                    resume: {
                        accept: 'image/*,application/pdf',
                        filesize: 5,
                    },
                    @endisRecruiter
                },
                messages: {
                    username: {
                        regex: "Invalid username, can contain letters, numbers and underscore only"
                    },
                    @isCandidate
                    years: {
                        min: "Experience year should be 0 or more years"
                    },
                    months: {
                        min: "Experience month should be 0 or more months"
                    },
                    resume: {
                        accept: 'Only image and PDFs are allowed',
                        filesize: 'File size must be less than 5MB',
                    },
                    @endisCandidate
                }
            });
        });

</script>
