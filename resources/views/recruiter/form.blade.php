<div class="mb-6">
    <label class="block">
        <span class="text-white">Title:</span>
        <x-text-input type="text" name="title" class="block mt-1 w-72 p-2.5" :value="old('title', $job->title)" required />
    </label>
    <x-input-error :messages="$errors->get('title')" class="mt-2" />
</div>
<div class="mb-6">
    <label class="block">
        <span class="text-white">Description:</span>
        <x-text-area name="description" class="block mt-1 w-1/2 h-52 p-2.5"
            required>{{ __(old('description', $job->description)) }}</x-text-area>
    </label>
    <x-input-error :messages="$errors->get('description')" class="mt-2" />
</div>
<div class="mb-6">
    <label class="block">
        <span class="text-white">Skills:</span>
        <input type="hidden" name="skills_og" value="{{ json_encode($job->skills) }}">
        <select id="select-skills" name="skills[]" multiple placeholder="Select skills..."
            autocomplete="off"
            class="block @error('skills') border-red-500 @enderror w-96 rounded-sm cursor-pointer focus:outline-none"
            required>
            @foreach ($skills as $skill)
                <option
                    value="{{ $skill->id }}"
                    {{ !is_null($job->skills) && in_array($skill->id, old('skills', $job->skills)) ? 'selected' : '' }}
                >
                {{ $skill->name }}
                </option>
            @endforeach
        </select>
    </label>
    <x-input-error :messages="$errors->get('skills')" class="mt-2" />
</div>

<div class="mb-6">
    <span class="text-white block mb-3">Experience:</span>
    <label>
        <span class="text-white mr-3">Years</span>
        <input type="text" name="years"
            class="@error('years') border-red-500 @enderror text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-28 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            value="{{ old('years', $job->years) }}" required>
    </label>
    <x-input-error :messages="$errors->get('years')" class="mt-2" />
    <label>
        <span class="text-white ml-3 mr-3">Months</span>
        <input type="text" name="months"
            class="@error('months') border-red-500 @enderror text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-28 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            value="{{ old('months', $job->months) }}" required>
    </label>
    <x-input-error :messages="$errors->get('months')" class="mt-2" />
</div>

<script>
    new TomSelect('#select-skills');
</script>
