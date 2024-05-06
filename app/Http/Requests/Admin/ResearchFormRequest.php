<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ResearchFormRequest extends FormRequest
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
        $requestType = $this->input('request_type');
        $areaId = $this->route('area_id');

        if ($requestType === 'create') {

            $rules = [
                'title' => 'required|unique:posts,title|string|max:100',
                'cover_photo' => 'required|mimes:jpeg,jpg,png,avif,webp|dimensions:min_width=300|max:1048',
                'description' => 'required',
                'item_type' => 'required',
                'meta_title' => 'string|max:100',
                'meta_description' => 'nullable|string|max:155',
            ];
        } else {
            $rules = [
                'title' => 'required|string|max:100|unique:posts,title,' . $areaId,
                'image' => 'mimes:jpeg,jpg,png,avif,webp|dimensions:min_width=300|max:1048',
                'description' => 'required',
                'item_type' => 'required',
                'meta_title' => 'string|max:155',
                'meta_description' => 'nullable|string',
            ];
        }
        return $rules;
    }
}
