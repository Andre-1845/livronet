<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'title' => 'sometimes|string|max:255',

            'author' => 'sometimes|string|max:255',

            'publisher' => 'nullable|string|max:255',

            'edition' => 'nullable|string|max:50',

            'school_grade' => 'nullable|string|max:100',

            'isbn' => 'nullable|string|max:50',

            'subject_id' => 'sometimes|exists:subjects,id',

            'price' => 'nullable|numeric|min:0',

            'description' => 'nullable|string|max:1000',

            'image' => 'nullable|image|max:2048',

            'accept_trade' => 'boolean',

            'accept_sale' => 'boolean',

            'accept_donation' => 'boolean',

            'is_available' => 'boolean',
        ];
    }
}
