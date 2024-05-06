<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AlbumFormRequest extends FormRequest
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
        $albumId = $this->route('album') ? $this->route('album')->id : null;
        if ($requestType === 'create') {
            $rules = [
                'year' => 'required|integer|unique:albums,year,' . $albumId,
                'images' => 'required|array',
                'images.*' => 'image|mimes:jpeg,jpg,png,webp,avif|max:2000'
            ];
        } else {
            $rules = [
                'images' => 'sometimes|array',
                'images.*' => 'image|mimes:jpeg,jpg,png,webp,avif|max:2000'
            ];
        }

        return $rules;
    }
}
