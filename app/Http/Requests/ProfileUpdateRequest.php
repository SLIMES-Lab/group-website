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
        return [
            'name' => ['string', 'max:255'],
            'email' => ['string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'type' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'dimensions:ratio=1/1', 'mimes:jpg,jpeg,png,svg,webp', 'max:1024'],
            'position' => ['nullable', 'string', 'max:255'],
            'research_title' => ['nullable', 'string'],
            'starting_year' => ['nullable', 'integer', 'digits:4'],
            'biography' => ['nullable', 'string'],
            'website' => ['nullable', 'string', 'max:255'],
            'linkedin' => ['nullable', 'string', 'max:255'],
            'google_scholar' => ['nullable', 'string', 'max:255'],
            'researchgate' => ['nullable', 'string', 'max:255'],
            'github' => ['nullable', 'string', 'max:255'],
            'twitter' => ['nullable', 'string', 'max:255'],
            'hobbies.*' => ['nullable', 'string', 'max:255'],
        ];
    }
}
