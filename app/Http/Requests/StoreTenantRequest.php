<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTenantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'unit_id' => 'required|exists:units,id',
            'id_number' => 'nullable|string|max:20',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'lease_start_date' => 'nullable|date',
            'lease_end_date' => 'nullable|date|after_or_equal:lease_start_date',
            'monthly_rent' => 'nullable|numeric',
            'deposit_paid' => 'nullable|numeric',
            'is_active' => 'boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
// This request validates the data for creating a new tenant, ensuring all required fields are present and correctly formatted. It also includes validation for an optional photo upload, ensuring it is an image file with a maximum