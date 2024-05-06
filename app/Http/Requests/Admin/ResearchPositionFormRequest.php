<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ResearchPositionFormRequest extends FormRequest
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
            'title' => 'string|max:255',
            'description' => 'string',
            'requirements' => 'string',
            'location' => 'string|max:255',
            'duration' => 'string|max:255',
            'start_date' => 'string',
            'application_deadline' => '',
            'how_to_apply' => 'string',
            'contact_information' => 'string|max:255',
            'funding' => 'string|max:255',
        ];

        if ($this->getMethod() == 'POST') {
            foreach ($rules as $key => $rule) {
                $rules[$key] = 'required|' . $rule;
            }
        }

        return $rules;
    }
}
