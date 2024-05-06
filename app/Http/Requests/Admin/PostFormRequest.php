<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return T_REQUIRE_ONCE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $requestType = $this->input('request_type');
        $postId = $this->route('post_id');

        if ($requestType === 'create') {

            $rules = [
                'title' => 'required|unique:posts,title|string|max:100',
                'subtitle' => 'nullable|string|max:155',
                'image' => 'required|mimes:jpeg,jpg,png,avif,webp|dimensions:min_width=300',
                'description' => 'required',
                'tags' => 'required',
                'meta_title' => 'required|string|max:100',
                'meta_description' => 'required|string|max:155',
                'publish_date' => 'required',
                'user_id' => 'nullable|integer|exists:users,id',
            ];
        } else {
            $rules = [
                'title' => 'required|string|max:100|unique:posts,title,' . $postId,
                'subtitle' => 'nullable|string|max:155',
                'image' => 'mimes:jpeg,jpg,png,avif,webp|dimensions:min_width=300',
                'description' => 'required',
                'tags' => 'required',
                'meta_title' => 'required|string|max:155',
                'meta_description' => 'required|string',
                'publish_date' => 'required',
                'user_id' => 'nullable|integer|exists:users,id',
            ];
        }
        ;

        return $rules;

    }
}
