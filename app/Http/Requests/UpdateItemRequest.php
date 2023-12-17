<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category' => ['required', 'integer', 'min: 0'],
            'name' => ['required', 'max:50'],
            'price' => ['nullable', 'integer', 'min: 0'],
            'cost' => ['nullable', 'integer', 'min: 0'],
            'memo' => ['max:255'],
        ];
    }
}
