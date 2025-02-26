<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $rules = 'required|unique:posts,title';
        if ($this->method() != 'POST') {
            $rules = 'required|unique:posts,title,'. $this->post->id;
        }
        return [
            'title' => $rules,
            'subtitle' => 'required',
            'content' => 'required',
            'image' => ($this->method() == 'POST') ? 'required' : 'nullable',
            'category_id' => 'required',
            'tags' => 'required',
        ];
    }
}
