<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTradeRequest extends FormRequest
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
            'explorer_id_trader' => 'required|integer|exists:explorers,id',
            'explorer_id_buyer' => 'required|integer|exists:explorers,id',
            'item_id_trader' => 'required|integer|exists:items,id',
            'quantity_trader' => 'required|integer|min:1',
            'item_id_buyer' => 'required|integer|exists:items,id',
            'quantity_buyer' => 'required|integer|min:1'
        ];
    }
}
