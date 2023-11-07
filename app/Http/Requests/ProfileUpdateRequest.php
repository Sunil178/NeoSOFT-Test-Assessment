<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $is_recruiter = request()->user()->isRecruiter();
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'company' => [Rule::requiredIf($is_recruiter), 'nullable', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'years' => ['nullable', 'numeric', 'min:0'],
            'months' => ['nullable', 'numeric', 'min:0'],
            'skills' => [ 'nullable', 'array' ],
            'resume' => ['nullable', 'mimes:jpeg,jpg,png,gif,svg,bmp,pdf', 'size:5120'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'company.required' => 'Company name is required for recruiters',
            'resume.mimes' => 'Only image and PDFs are allowed',
            'resume.size' => 'File size must be less than 5MB',
        ];
    }
}
