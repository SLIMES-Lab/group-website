<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CollaboratorFormRequest extends FormRequest
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

            'total_projects' => 'nullable|integer',
            'image' => 'nullable|mimes:jpeg,jpg,png,avif,webp|dimensions:min_width=100,ratio=1/1|max:1024',
            'email' => 'nullable|string|email|max:255',
            'google_scholar' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
        ];

        if ($this->getMethod() == 'POST') {
            $rules += [
                'name' => 'required|string|max:255',
                'current_position' => 'required|string|max:255',
            ];
        } else {
            $rules += [
                'name' => 'sometimes|required|string|max:255',
                'current_position' => 'sometimes|required|string|max:255',
            ];
        }

        return $rules;
    }
}
