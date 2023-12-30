<?php

namespace App\Http\Requests;

use App\Http\Requests\SaleItemValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
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
            'items.*.id' => ['required', function ($attribute, $value, $fail) {
                if (!is_int($value) | $value < 1) {
                    $fail('The ' . $attribute . ' is invalid.');
                }
            }],
            'date' => ['required', 'date'],
            'temperature' => ['nullable', 'integer'],
            'weather' => ['nullable', 'integer'],
            'items' => ['required'],
            'items.*.quantity' => ['required', function ($attribute, $value, $fail) {
                if (!is_int($value) | $value < 1) {
                    $fail('The ' . $attribute . ' is invalid.');
                }
            }],
            'items.*.cost' => ['nullable', function ($attribute, $value, $fail) {
                if (!is_int($value) | $value < 1) {
                    $fail('The ' . $attribute . ' is invalid.');
                }
            }],
            'items.*.price' => ['nullable', function ($attribute, $value, $fail) {
                if (!is_int($value) | $value < 1) {
                    $fail('The ' . $attribute . ' is invalid.');
                }
            }]
        ];
    }
}
