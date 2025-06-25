<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUnitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Adjust this based on your authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    return [
        'unit_number' => 'sometimes|string|max:10',
        'unit_type' => 'sometimes|in:bedsitter,studio,1_bedroom,2_bedroom,3_bedroom,shop,bungalow',
        'rent_amount' => 'sometimes|numeric',
        'deposit_amount' => 'sometimes|numeric',
        'description' => 'nullable|string',
        'floor_number' => 'nullable|integer',
        'is_occupied' => 'nullable|boolean',
        'is_active' => 'nullable|boolean',
    ];
}

}
