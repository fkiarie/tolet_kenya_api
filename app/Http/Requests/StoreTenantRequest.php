<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTenantRequest extends FormRequest
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
        'user_id' => 'required|exists:users,id',
        'unit_id' => 'nullable|exists:units,id',
        'id_number' => 'required|string|max:20',
        'emergency_contact_name' => 'required|string|max:255',
        'emergency_contact_phone' => 'required|string|max:20',
        'lease_start_date' => 'required|date',
        'lease_end_date' => 'nullable|date|after_or_equal:lease_start_date',
        'monthly_rent' => 'required|numeric',
        'deposit_paid' => 'required|numeric',
        'is_active' => 'boolean',
    ];
}

}
