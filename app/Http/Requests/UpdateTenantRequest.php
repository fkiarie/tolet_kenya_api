<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTenantRequest extends FormRequest
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
        'user_id' => 'sometimes|exists:users,id',
        'unit_id' => 'nullable|exists:units,id',
        'id_number' => 'nullable|string|max:20',
        'emergency_contact_name' => 'nullable|string|max:255',
        'emergency_contact_phone' => 'nullable|string|max:20',
        'lease_start_date' => 'nullable|date',
        'lease_end_date' => 'nullable|date|after_or_equal:lease_start_date',
        'monthly_rent' => 'nullable|numeric',
        'deposit_paid' => 'nullable|numeric',
        'is_active' => 'boolean',
    ];
}

}
