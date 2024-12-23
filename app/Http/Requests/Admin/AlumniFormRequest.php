<?php

namespace App\Http\Requests\Admin;

use App\Models\Alumni;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AlumniFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'profile_email' =>
            ['nullable', 'string', 'email', 'max:255', Rule::unique(Alumni::class)->ignore($this->user()->id)],
            'google_scholar' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'image' => 'nullable|mimes:jpeg,jpg,png,avif,webp|dimensions:min_width=100,ratio=1/1|max:1024',
            'current_position' => 'nullable|string|max:255',
        ];

        if ($this->getMethod() == 'POST') {
            $rules += [
                'name' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique(Alumni::class)->ignore($this->user()->id)],
            ];
        } else {
            $rules += [
                'name' => 'sometimes|required|string|max:255',
                'title' => 'sometimes|required|string|max:255',
                'type' => 'sometimes|required|string|max:255',
                'email' => ['sometimes', 'string', 'email', 'max:255', Rule::unique(Alumni::class)->ignore($this->user()->id)],
            ];
        }

        return $rules;
    }
}
