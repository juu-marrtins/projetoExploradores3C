<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'value' => 'required',
            'explorer_id' => 'required|exists:explorers,id',
            'latitude' => 'required|max:15|string',
            'longitude' => 'required|max:15|string',
            'quantity' => 'required|integer|min:1'
        ];
    }
}
