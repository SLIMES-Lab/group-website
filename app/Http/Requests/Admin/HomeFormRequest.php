<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HomeFormRequest extends FormRequest
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
        return [
            'heading' => 'string|max:150',
            'subheading' => 'string|max:150',
            'topics' => 'array',
            'homepage_image' => 'image|mimes:png,jpg,jpeg,webp,avif|dimensions:min_width=1920,min_height=1080',
            'papers' => 'string',
            'citations' => 'string',
            'group_members' => 'string',
            'john_image' => 'image|mimes:png,jpg,jpeg,webp,avif|dimensions:ratio=1/1|dimensions:min_width=500,min_height=500',
            'john_details' => 'string',
            'seo_title' => 'nullable|string|min:60|max:75',
            'seo_description' => 'nullable|string|min:60|max:155',
        ];
    }
}
