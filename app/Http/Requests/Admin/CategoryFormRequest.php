<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
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
    public function rules()
    {
        $requestType = $this->input('request_type');

        if ($requestType === 'create') {

            $rules = [
                'name' => 'required|unique:categories|string|max:200',
            ];
        } else {
            $rules = [
                'name' => 'required|string|max:200',
            ];
        }
        ;

        return $rules;
    }
}
