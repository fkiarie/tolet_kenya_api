<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    return [
        'unit_number' => 'required|string|max:10',
        'unit_type' => 'required|in:bedsitter,studio,1_bedroom,2_bedroom,3_bedroom,shop,bungalow',
        'rent_amount' => 'required|numeric',
        'deposit_amount' => 'required|numeric',
        'description' => 'nullable|string',
        'floor_number' => 'nullable|integer',
    ];
}

}
